<?php

namespace SmsParser\Handlers;
use SmsParser\Contracts\SmsConfirmation;

class YandexSmsConfirmation implements SmsConfirmation
{
    /**
     * @var float
     */
    protected $sum;

    /**
     * @var string
     */
    protected $confirmationCode;

    /**
     * @var int
     */
    protected $accountNumber;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @return mixed
     */
    public function getSum() : float
    {
        return $this->sum;
    }

    /**
     * @param mixed $sum
     */
    public function setSum(float $sum)
    {
        $this->sum = $sum;
    }

    /**
     * @return mixed
     */
    public function getConfirmationCode() : string
    {
        return $this->confirmationCode;
    }

    /**
     * @param mixed $confirmationCode
     */
    public function setConfirmationCode(string $confirmationCode)
    {
        $this->confirmationCode = $confirmationCode;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber() : int
    {
        return $this->accountNumber;
    }

    /**
     * @param mixed $accountNumber
     */
    public function setAccountNumber(string $accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    public function getCurrency() : string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency)
    {
        return $this->currency = $currency;
    }
}
