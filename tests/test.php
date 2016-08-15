<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PasswordGen\PasswordGen;
$passwordGen = new PasswordGen();

echo $passwordGen->password();
echo '<br />';
echo $passwordGen->setLength(24)->password();
echo '<br />';
echo PasswordGen::DEFAULTLENGTH;
