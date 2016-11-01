<?php
namespace SmsParser\Tests\PHP;

use SmsParser\Exception\SmsParseException;
use SmsParser\Handlers\YandexSmsConfirmation;
use SmsParser\Parsers\YandexMoneySmsParser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    protected $service;
    
    public function setUp()
    {
        parent::setUp();
        $this->service = new YandexMoneySmsParser(new YandexSmsConfirmation());
    }

    /**
     * Test parse right sms text
     */
    public function testRun()
    {
        $testData = [
            [
                'text'           => 'Пароль: 8714
                                            Спишется 1507,54р.
                                            Перевод на счет 410011435701025',
                'sum'            => 1507.54,
                'currency'       => 'р.',
                'account_number' => 410011435701025,
                'code'           => '8714'],
            [
                'text'           => 'Пароль: 5554 Спишется 1507EUR. Перевод на счет 410011434301025',
                'sum'            => 1507,
                'currency'       => 'EUR.',
                'code'           => '5554',
                'account_number' => 410011434301025
            ],
            [
                'text'           => ' Перевод на счет 410011434301025 Пароль: 5554 Спишется 1507   EUR.',
                'sum'            => 1507,
                'currency'       => 'EUR.',
                'code'           => '5554',
                'account_number' => 410011434301025
            ],
            [
                'text'           => ' ЩЕТ 410011434301025 Пароль джигурды: 5554 Украдет 1507,422   EUR.',
                'sum'            => 1507.422,
                'currency'       => 'EUR.',
                'code'           => '5554',
                'account_number' => 410011434301025
            ],
            //если увеличат пароль и кол-во цифр в счете
            [
                'text'           => 'Перевод на счет 4100114343010252 Пароль: 12345678 Спишется 1507$.',
                'sum'            => 1507,
                'currency'       => '$.',
                'code'           => '12345678',
                'account_number' => 4100114343010252
            ],

        ];

        foreach ($testData as $inputData) {
            $result = $this->service->parse($inputData['text']);
            $this->assertEquals($inputData['sum'], $result->getSum(), 'Wrong sum');
            $this->assertEquals($inputData['currency'], $result->getCurrency(), 'Wrong currency');
            $this->assertEquals($inputData['account_number'], $result->getAccountNumber(), 'Wrong account number');
            $this->assertEquals($inputData['code'], $result->getConfirmationCode(), 'Wrong code');
        }
    }

    /**
     * Test if sms test is not correct
     */
    public function testWrongSMS()
    {
        $testData = [

                'Пароль: 8714 Спишется 1507,54р.',
                'Перевод на счет 410011434301025 Спишется 1507   EUR.',
                'Пароль: 5554 Перевод на счет 410011434301025',
                ''
        ];

        foreach ($testData as $inputData) {
            $this->expectException(SmsParseException::class);
           $this->service->parse($inputData);
        }
    }
}