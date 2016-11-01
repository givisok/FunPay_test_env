<?php
namespace SmsParser\Parsers;

use SmsParser\Contracts\SmsConfirmation;
use SmsParser\Exception\SmsParseException;

class YandexMoneySmsParser
{
    protected $yandexSmsConfirmation;

    public function __construct(SmsConfirmation $yandexSms)
    {
        $this->yandexSmsConfirmation = $yandexSms;
    }

    public function parse(string $text) : SmsConfirmation
    {
        preg_match_all('/(?<account>[0-9]{11,})|(?<sum_with_currency>[0-9,]+\D+\.)|(?<code>[0-9]+)/', $text, $matches);

        list($sum, $currency) = $this->prepareSum($this->getValue($matches['sum_with_currency']));
        $account = $this->getValue($matches['account']);
        $code = $this->getValue($matches['code']);

        if (empty($sum) || empty($currency) || empty($account) || empty($code)) {
            throw new SmsParseException('Cannot find one of lexeme in sms');
        }

        $this->yandexSmsConfirmation->setSum($sum);
        $this->yandexSmsConfirmation->setConfirmationCode($code);
        $this->yandexSmsConfirmation->setCurrency($currency);
        $this->yandexSmsConfirmation->setAccountNumber($account);

        return $this->yandexSmsConfirmation;
    }

    /**
     * @param array $matches
     * @return mixed
     */
    protected function getValue(array $matches)
    {
        return array_shift(array_filter($matches));
    }

    /**
     * @param string $sumWithCurrency
     * @return array
     * @throws SmsParseException
     */
    protected function prepareSum(string $sumWithCurrency) : array
    {
        $result = preg_match_all('/[0-9,]+|.*\./', $sumWithCurrency, $matches);
        if ($result != 2) {
            throw new SmsParseException('Cannot find sum or currency lexeme in sms');
        }
        $sum = floatval(str_replace(',', '.', str_replace('.', '', $matches[0][0])));

        return [$sum, trim($matches[0][1])];
    }
}