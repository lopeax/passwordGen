/*==============================================================================
 Password generator class

 This is a javascript version of my PasswordGen PHP library accessible here:
 https://github.com/lopeax/passwordGen

 This is written in ES2015 so requires a transpiler such as babel to compile
 ==============================================================================*/
class PasswordGen {
    /**
     * Create a new PasswordGen instance and setting the default character
     * groups to be used by this class
     */
    constructor() {
        /*--------------------------------------
         Setup of the length, keyspace and
         characterSets variables
         --------------------------------------*/
        this.length = this.DEFAULTLENGTH;
        this.keyspace = '';
        this.characterSets = {
            'l': this.LOWERCASELETTERS,
            'u': this.UPPERCASELETTERS,
            'n': this.NUMBERS,
            's': this.SPECIALCHARACTERS,
            'w': this.WHITESPACE
        };

        /*--------------------------------------
         Setup the keyspace
         --------------------------------------*/
        this.generateKeyspace();
    }

    /*--------------------------------------
     START CONSTANTS

     Define all the class 'constants' in
     this way because ES2015 classes do not
     support class constants
     --------------------------------------*/

    /**
     * Getter for MINIMUMLENGTH class variable for the minimum length of
     * the password generated
     *
     * @return number                           The minimum password length
     */
    get MINIMUMLENGTH() {
        return 8;
    }

    /**
     * Getter for DEFAULTLENGTH class variable used to generate the default
     * password length
     *
     * @return number                           The default password length
     */
    get DEFAULTLENGTH() {
        return 16;
    }

    /**
     * Getter for DEFAULTSETS class variable used to generate the keyspace
     *
     * @return string                           The default sets
     */
    get DEFAULTSETS() {
        return 'luns';
    }

    /**
     * Getter for LOWERCASELETTERS set used in generating the keyspace
     *
     * @return string                           All lower case letters
     */
    get LOWERCASELETTERS() {
        return 'abcdefghijklmnopqrstuvwxyz';
    }

    /**
     * Getter for UPPERCASELETTERS set used in generating the keyspace
     *
     * @return string                           All upper case letters
     */
    get UPPERCASELETTERS() {
        return 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }

    /**
     * Getter for NUMBERS set used in generating the keyspace
     *
     * @return string                           All single digits
     */
    get NUMBERS() {
        return '1234567890';
    }

    /**
     * Getter for SPECIALCHARACTERS set used in generating the keyspace
     *
     * @return string                           All special characters used
     */
    get SPECIALCHARACTERS() {
        return '!@#$%&*?,./|[]{}()';
    }

    /**
     * Getter for WHITESPACE set used in generating the keyspace
     *
     * @return string                           All whitespace characters used
     */
    get WHITESPACE() {
        return ' ';
    }

    /*--------------------------------------
     END CONSTANTS
     --------------------------------------*/


    /**
     * Test if any elements of an array exist as keys in another array
     *
     * @param  needles          array           The needles to search for in the
     *                                          haystack
     * @param  haystack         array           The haystack for the needles to
     *                                          search
     * @return boolean                          Whether any items of the needles
     *                                          array exist as keys in the haystack
     */
    arrayKeySearch(needles, haystack) {
        let i = 0, length = needles.length;
        while (i < length) {
            for (let item in haystack) {
                if (needles[i] == item) {
                    return true;
                }
            }
            i++;
        }
        return false;
    }


    /**
     * Generate a cryptographically strong random number between two values
     *
     * @param  min              number          The minimum number
     * @param  max              number          The maximum number
     * @return integer
     */
    randomInteger(min, max) {
        let byteArray = new Uint8Array(1);
        let crypto = window.crypto || window.msCrypto;
        crypto.getRandomValues(byteArray);

        let range = max - min + 1;
        let max_range = 256;
        if (byteArray[0] >= Math.floor(max_range / range) * range) {
            return this.randomInteger(min, max);
        }
        return min + (byteArray[0] % range);
    }

    /**
     * Set the length of the password, checking if it's an integer and
     * higher than the minimum required length
     *
     * @param  value            integer     Length of the generated password
     * @return PasswordGen      this        The current instance of PasswordGen
     */
    setLength(value = 0) {
        if (value === parseInt(value) && value >= this.MINIMUMLENGTH) {
            this.length = value;
        }
        return this;
    }

    /**
     * Set the keyspace of the password generator, checking if it's set and not
     * an empty string
     *
     * @param  keyspace         string      Sets to be used for generator
     * @return PasswordGen      this        The current instance of PasswordGen
     */
    setKeyspace(keyspace = '') {
        if (typeof keyspace === 'string' && keyspace != '') {
            this.keyspace = keyspace;
        }
        return this;
    }

    /**
     * Generate the keyspace of the password generator using the character
     * groups
     *
     * @param  sets             string      Sets to be used for generator
     * @return PasswordGen      this        The current instance of PasswordGen
     */
    generateKeyspace(sets = this.DEFAULTSETS) {
        this.keyspace = '';

        /*--------------------------------------
         Test if the sets variable is a string
         and if any of the characters in it
         are in the characterSets array's keys
         --------------------------------------*/
        if (
            typeof sets === 'string'
            &&
            this.arrayKeySearch(sets, this.characterSets)
        ) {
            /*--------------------------------------
             Split the sets string on every
             character and loop through them
             --------------------------------------*/
            for (let set in sets.split('')) {
                this.keyspace += this.characterSets[sets[set]];
            }
        } else {
            for (let set in this.DEFAULTSETS.split('')) {
                this.keyspace += this.characterSets[this.DEFAULTSETS[set]];
            }
        }

        return this;
    }

    /**
     * Generate the password by selecting a random character from
     * the keyspace generated
     *
     * @return string           password    The generated password
     */
    generatePassword() {
        let password = '';
        for (let i = 0; i < this.length; i++) {
            password += this.keyspace.split('')[
                this.randomInteger(0, this.keyspace.length - 1)
                ];
        }
        return password;
    }

    /**
     * Getter for password
     *
     * @return string                       The generated password
     */
    get password() {
        return this.generatePassword();
    }
}