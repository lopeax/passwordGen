<?php

namespace PasswordGen;

/*==============================================================================
 Interface for PasswordGen
==============================================================================*/
interface PasswordGenInterface {
    /*--------------------------------------
     The minimum required length for
     password generation
    --------------------------------------*/
    const MINIMUMLENGTH = 8;

    /*--------------------------------------
     The default password length
    --------------------------------------*/
    const DEFAULTLENGTH = 16;

    /*--------------------------------------
     The default sets to be used
    --------------------------------------*/
    const DEFAULTSETS = 'luns';

    /*--------------------------------------
     The groups of characters used by
     this class to generate the keyspace
    --------------------------------------*/
    const LOWERCASELETTERS = 'abcdefghijklmnopqrstuvwxyz';
    const UPPERCASELETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const NUMBERS = '1234567890';
    const SPECIALCHARACTERS = '!@#$%&*?,./|[]{}()';
    const WHITESPACE = ' ';

    public function setLength($length);
    public function setKeyspace($useSets);
    public function password();
}
