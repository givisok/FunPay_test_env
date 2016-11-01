<?php
namespace SmsParser\Contracts;

interface SmsConfirmation
{
    public function getSum():float;

    public function setSum(float $sum);

    public function getConfirmationCode() : string;

    public function setConfirmationCode(string $confirmationCode);

    public function getCurrency() : string;

    public function setCurrency(string $currency);

    public function getAccountNumber() : int;

    public function setAccountNumber(string $accountNumber);
}