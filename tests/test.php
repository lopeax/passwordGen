<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PasswordGen\PasswordGen;
$passwordGen = new PasswordGen();

echo $passwordGen->password();
echo PHP_EOL;
echo $passwordGen->setLength(24)->password();