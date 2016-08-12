<?php

namespace PasswordGen;

/*==============================================================================
 Password generator class

 This requires random_int to be installed, which is native to PHP 7.0.0
 The polyfull for random_int which is installed as a dependency for this
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
     * character groups to be used by this class
     *
     * @return void
     */
    function __construct($length = self::DEFAULTLENGTH, $useSets = 'luns'){
        $this->length = $this->setLength($length);
        $this->keyspace = $this->setKeyspace($useSets);
    }

    /**
     * Set the length of the password, checking if it's an integer and
     * higher than the minimum required length
     *
     * @param  int $length
     * @return int $length
     */
    private function setLength($length){
        if(gettype($length) === 'integer' && $length > self::MINIMUMLENGTH){
            return $length;
        } else {
            return self::DEFAULTLENGTH;
        }
    }

    /**
     * Set the keyspace of the password generator using the character groups
     *
     * @param  string $useSets
     * @return string $keyspace
     */
    private function setKeyspace($useSets){
        $keyspace = '';

        if($useSets !== ''){
            if(strpos($useSets, 'l') !== false){
                $keyspace .= self::LOWERCASELETTERS;
            }

            if(strpos($useSets, 'u') !== false){
                $keyspace .= self::UPPERCASELETTERS;
            }

            if(strpos($useSets, 'n') !== false){
                $keyspace .= self::NUMBERS;
            }

            if(strpos($useSets, 's') !== false){
                $keyspace .= self::SPECIALCHARACTERS;
            }

            if(strpos($useSets, 'w') !== false){
                $keyspace .= self::WHITESPACE;
            }
        } else {
            $keyspace .= self::LOWERCASELETTERS;
            $keyspace .= self::UPPERCASELETTERS;
            $keyspace .= self::NUMBERS;
            $keyspace .= self::SPECIALCHARACTERS;
        }

        return $keyspace;
    }

    /**
     * Generate the password
     *
     * @return string $password
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
