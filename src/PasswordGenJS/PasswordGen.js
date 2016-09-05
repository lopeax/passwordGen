/*==============================================================================
 Password generator class

 This is a javascript version of my PasswordGen PHP library accessible here:
 https://github.com/lopeax/passwordGen

 This is written in ES2015 so requires a transpiler such as babel to compile

 This does not rely on any outside libraries apart from the window.crypto
 object, and has browser support for at least IE11+
 =============================================================================*/
class PasswordGen {
    /**
     * Create a new PasswordGen instance and setting the default character
     * groups to be used by this class
     */
    constructor() {
        /*--------------------------------------
         Setup of the length and keyspace
         variables
         --------------------------------------*/
        this.length = this.DEFAULTLENGTH;
        this.keyspace = '';

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
     * Getter for MAXIMUMRANDOMINTEGER class variable for the maximum limit of
     * random integer
     *
     * @return number                           The maximum random integer
     */
    get MAXIMUMRANDOMINTEGER() {
        return 256;
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

    /**
     * Getter for WHITESPACE set used in generating the keyspace
     *
     * @return string                           All whitespace characters used
     */
    get CHARACTERSETS() {
        return {
            'l': this.LOWERCASELETTERS,
            'u': this.UPPERCASELETTERS,
            'n': this.NUMBERS,
            's': this.SPECIALCHARACTERS,
            'w': this.WHITESPACE
        };
    }

    /*--------------------------------------
     END CONSTANTS
     --------------------------------------*/

    /**
     * Return an error message if a variable is too large
     *
     * @param  variable         string          The variable that's too large
     * @return string                           The error message
     */
    errorTooLarge(variable) {
        return `Sorry the ${variable} is too large\n` +
            `The maximum size is ${this.MAXIMUMRANDOMINTEGER}\n` +
            `The default ${variable} is currently being used`;
    }

    /**
     * Return an error message if a variable is too long
     *
     * @param  variable         string          The variable that's too long
     * @return string                           The error message
     */
    errorTooLong(variable) {
        return `Sorry the ${variable} is too long\n` +
            `The maximum length is ${this.MAXIMUMRANDOMINTEGER} characters\n` +
            `The default ${variable} is currently being used`;
    }

    /**
     * Test if any elements of an array exist as keys in another array
     *
     * @param  needles          array           The needles to search for
     * @param  haystack         array           The haystack to search
     * @return boolean                          Whether any needles exist as
     *                                          array keys in the haystack
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
    randomInteger(min = 0, max = this.MAXIMUMRANDOMINTEGER) {
        try {
            if(max < this.MAXIMUMRANDOMINTEGER){
                let crypto = window.crypto || window.msCrypto;
                let byteArray = new Uint8Array(1);
                crypto.getRandomValues(byteArray);

                let range = max - min + 1;
                let max_range = this.MAXIMUMRANDOMINTEGER;
                if (byteArray[0] >= Math.floor(max_range / range) * range) {
                    return this.randomInteger(min, max);
                }
                return min + (byteArray[0] % range);
            } else {
                throw this.errorTooLarge('maximum');
            }
        } catch(e) {
            console.log(e);
        }
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
            if(keyspace.length < this.MAXIMUMRANDOMINTEGER){
                this.keyspace = keyspace;
            } else {
                console.log(this.errorTooLong('keyspace'));
            }
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
         are in the CHARACTERSETS array's keys
         --------------------------------------*/
        if (
            typeof sets === 'string'
            &&
            this.arrayKeySearch(sets, this.CHARACTERSETS)
        ) {
            /*--------------------------------------
             Split the sets string on every
             character and loop through them
             --------------------------------------*/
            for (let set in sets.split('')) {
                this.keyspace += this.CHARACTERSETS[sets[set]];
            }
        } else {
            for (let set in this.DEFAULTSETS.split('')) {
                this.keyspace += this.CHARACTERSETS[this.DEFAULTSETS[set]];
            }
        }

        if(this.keyspace.length > this.MAXIMUMRANDOMINTEGER){
            console.log(this.errorTooLong('keyspace'));
            this.generateKeyspace();
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