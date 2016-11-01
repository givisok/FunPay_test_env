<?php
namespace SmsParser\Contracts;

interface SmsParser
{
    public function parse(string $text) : SmsConfirmation;
}
