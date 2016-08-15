<?php

namespace PasswordGen;

/*==============================================================================
 Password generator class

 This requires random_int to be installed, which is native to PHP 7.0.0
 The polyfill for random_int which is installed as a dependency for this
 class (https://github.com/paragonie/random_compat)
==============================================================================*/
class PasswordGen {
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
     Setup of the keyspace and length vars
    --------------------------------------*/
    private $keyspace;
    private $length;

    /**
     * Create a new PasswordGen instance and setting the length and
     * character groups to be used by this class via defaults
     */
    function __construct(){
        $this->setLength(self::DEFAULTLENGTH);
        $this->setKeyspace(self::DEFAULTSETS);
    }

    /**
     * Set the length of the password, checking if it's an integer and
     * higher than the minimum required length
     *
     * @param  int      $length     Length of the generated password
     * @return PasswordGen
     */
    public function setLength($length = self::DEFAULTLENGTH){
        if(gettype($length) === 'integer' && $length > self::MINIMUMLENGTH){
            $this->length = $length;
        } else {
            $this->length = self::DEFAULTLENGTH;
        }

        return $this;
    }

    /**
     * Set the keyspace of the password generator using the character groups
     *
     * @param  string   $useSets    Sets to be used for generator
     * @return PasswordGen
     */
    public function setKeyspace($useSets = 'luns'){
        $this->keyspace = '';

        if($useSets !== ''){
            if(strpos($useSets, 'l') !== false){
                $this->keyspace .= self::LOWERCASELETTERS;
            }

            if(strpos($useSets, 'u') !== false){
                $this->keyspace .= self::UPPERCASELETTERS;
            }

            if(strpos($useSets, 'n') !== false){
                $this->keyspace .= self::NUMBERS;
            }

            if(strpos($useSets, 's') !== false){
                $this->keyspace .= self::SPECIALCHARACTERS;
            }

            if(strpos($useSets, 'w') !== false){
                $this->keyspace .= self::WHITESPACE;
            }
        } else {
            $this->keyspace .= self::LOWERCASELETTERS;
            $this->keyspace .= self::UPPERCASELETTERS;
            $this->keyspace .= self::NUMBERS;
            $this->keyspace .= self::SPECIALCHARACTERS;
        }

        return $this;
    }

    /**
     * Generate the password
     *
     * @return string   $password   The generated password
     */
    private function generatePassword(){
        $password = '';
        $max = mb_strlen($this->keyspace, '8bit') - 1;

        for ($i=0; $i < $this->length; $i++) {
            $password .= $this->keyspace[random_int(0, $max)];
        }

        return $password;
    }

    /**
     * Return the password
     *
     * @return string $password
     */
    public function password(){
        return $this->generatePassword();
    }
}
