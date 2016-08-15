<?php

namespace PasswordGen;

use PasswordGen\PasswordGenInterface;
use PasswordGen\GeneratePassword;

/*==============================================================================
 Password generator class

 This requires random_int to be installed, which is native to PHP 7.0.0
 The polyfill for random_int which is installed as a dependency for this
 class (https://github.com/paragonie/random_compat)
==============================================================================*/
class PasswordGen implements PasswordGenInterface {
    /*--------------------------------------
     Use the GeneratePassword and
     ArrayKeySearch traits
    --------------------------------------*/
    use GeneratePassword, ArrayKeySearch;

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

    /*--------------------------------------
     Setup of the length, keyspace and
     characterSets variables
    --------------------------------------*/
    private $length = self::DEFAULTLENGTH;
    private $keyspace = '';
    private $characterSets = [
        'l' => 'abcdefghijklmnopqrstuvwxyz',
        'u' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'n' => '1234567890',
        's' => '!@#$%&*?,./|[]{}()',
        'w' => ' '
    ];

    /**
     * Set the length of the password, checking if it's an integer and
     * higher than the minimum required length
     *
     * @param  int              $length     Length of the generated password
     * @return PasswordGen      $this       The current instance of PasswordGen
     */
    public function setLength($length = self::DEFAULTLENGTH){
        /*--------------------------------------
         Test if the $length varibale is an
         integer and larger than the minimum
         length allowed and reset the length
         if these conditions are met, otherwise
         use the defaults
        --------------------------------------*/
        if(gettype($length) === 'integer' && $length > self::MINIMUMLENGTH){
            $this->length = $length;
        }

        return $this;
    }

    /**
     * Set the keyspace of the password generator using the character groups
     *
     * @param  string           $sets       Sets to be used for generator
     * @return PasswordGen      $this       The current instance of PasswordGen
     */
    public function setKeyspace($sets = self::DEFAULTSETS){
        /*--------------------------------------
         Test if the $sets variable is a string
         and if any of the characters in it
         are in the $characterSets array's keys
        --------------------------------------*/
        if(
            gettype($sets) === 'string'
                &&
            $this->arrayKeySearch($sets, $this->characterSets)
        ){
            /*--------------------------------------
             Split the sets string on every
             character and loop through them
            --------------------------------------*/
            foreach (str_split($sets) as $set) {
                $this->keyspace .= $this->characterSets[$set];
            }
        } else {
            foreach (str_split(self::DEFAULTSETS) as $set) {
                $this->keyspace .= $this->characterSets[$set];
            }
        }

        return $this;
    }

    /**
     * Alias for generatePassword
     *
     * @return string           $password   The generated password
     */
    public function password(){
        $this->setKeyspace(self::DEFAULTSETS);
        return $this->generatePassword($this->keyspace, $this->length);
    }
}
