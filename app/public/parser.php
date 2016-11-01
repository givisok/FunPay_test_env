<?php
require __DIR__ . '/../vendor/autoload.php';

$parser = new SmsParser\Parsers\YandexMoneySmsParser(new SmsParser\Handlers\YandexSmsConfirmation());

$text = 'Пароль: 8714
Спишется 1507,54р.
Перевод на счет 410011435701025';


var_dump($parser->parse($text));

$text = 'Пароль: 8714 Спишется 1507р. Перевод на счет 410011435701025';

var_dump($parser->parse($text));

//$text = 'Пароль: 8714 Спишется 1507 рубл. Перевод на счет 410011435701025';
$text = 'Пароль: 8714 Спишется 1507,424 EUR. Перевод на счет 410011435701025';

var_dump($parser->parse($text));

$text = 'Переводнасчет410011435701025Спишется1507EUR.Пароль:8714';

var_dump($parser->parse($text));