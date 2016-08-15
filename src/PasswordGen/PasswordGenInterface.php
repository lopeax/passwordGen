<?php

namespace PasswordGen;

/*==============================================================================
 Interface for PasswordGen
==============================================================================*/
interface PasswordGenInterface {
    /**
     * Set the length of the password, checking if it's an integer and
     * higher than the minimum required length
     *
     * @param  int              $length     Length of the generated password
     * @return PasswordGen      $this       The current instance of PasswordGen
     */
    public function setLength($length);

    /**
     * Set the keyspace of the password generator using the character groups
     *
     * @param  string           $sets       Sets to be used for generator
     * @return PasswordGen      $this       The current instance of PasswordGen
     */
    public function setKeyspace($sets);

    /**
     * Alias for generatePassword
     *
     * @return string           $password   The generated password
     */
    public function password();
}
