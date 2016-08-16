<?php

namespace PasswordGen;

use PasswordGen\PasswordGenInterface;
use PasswordGen\GeneratePassword;
use PasswordGen\ArrayKeySearch;

/*==============================================================================
 Password generator class

 This requires random_int to be installed, which is native to PHP 7.0.0
 There is a polyfill for random_int which is installed as a dependency for this
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
        'l' => self::LOWERCASELETTERS,
        'u' => self::UPPERCASELETTERS,
        'n' => self::NUMBERS,
        's' => self::SPECIALCHARACTERS,
        'w' => self::WHITESPACE
    ];

    /**
     * Create a new PasswordGen instance and setting the default character
     * groups to be used by this class
     */
    function __construct(){
        $this->setKeyspace(self::DEFAULTSETS);
    }

    /**
     * Set the length of the password, checking if it's an integer and
     * higher than the minimum required length
     *
     * @param  int              $length     Length of the generated password
     * @return PasswordGen      $this       The current instance of PasswordGen
     */
    public function setLength($length = self::DEFAULTLENGTH){
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
         Reset the keyspace
        --------------------------------------*/
        $this->keyspace = '';

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
     * Alias for generatePassword using the current keyspace and length
     *
     * @return string           $password   The generated password
     */
    public function password(){
        return $this->generatePassword($this->keyspace, $this->length);
    }
}
