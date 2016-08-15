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
     Use the GeneratePassword trait
    --------------------------------------*/
    use GeneratePassword;

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
     * Alias for generatePassword
     *
     * @return string   $password   The generated password
     */
    public function password(){
        return $this->generatePassword($this->keyspace, $this->length);
    }
}
