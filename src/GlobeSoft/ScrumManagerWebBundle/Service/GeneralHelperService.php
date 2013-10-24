<?php

namespace GlobeSoft\ScrumManagerWebBundle\Service;


class GeneralHelperService {

    /**
     * Generate a random string, with a specific length.
     * @param int $length The length of the random string.
     * @return string The string that was returned from the method call.
     */
    public static function generateRandomString($length = 10) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = '';

        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }

        return $str;
    }
}