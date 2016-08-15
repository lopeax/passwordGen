<?php

namespace PasswordGen;

/*==============================================================================
 Trait for searching if any items from an array exist as keys in another
==============================================================================*/
trait ArrayKeySearch {
    /**
     * Test if any elements of an array exist as keys in another array
     *
     * @param  array    $keyspace   The needles to search for in the haystack
     * @param  array    $length     The haystack for the needles to search
     * @return boolean  $exists     Whether any items of the needles array exist
     *                              as keys in the haystack
     */
    public function arrayKeySearch($needles, $haystack){
        $i = 0; $length = count($needles);
        while ($i < $length) {
            if(array_key_exists($needles[$i], $haystack)){
                return true;
            }
            $i++;
        }
        return false;
    }
}
