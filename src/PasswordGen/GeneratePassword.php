<?php

namespace PasswordGen;

/*==============================================================================
 Trait for generating the password
==============================================================================*/
trait GeneratePassword {
    /**
     * Generate the password
     *
     * @param  string   $keyspace   The keyspace to generate the password from
     * @param  int      $length     The length of the generated password
     * @return string   $password   The generated password
     */
    private function generatePassword($keyspace, $length){
        $password = '';
        $max = mb_strlen($keyspace, '8bit') - 1;

        for ($i=0; $i < $length; $i++) {
            $password .= $keyspace[random_int(0, $max)];
        }

        return $password;
    }
}
