<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  Name Class      : Dt
 *  Purpose         : Make 6 Digit OTP
 *  Author          : Yogi Siswanto
 *  Email           : yogisiswanto.c2@gmail.com
 *  Date Created    : 1st November 2018
 *  Language        : PHP >= 7
 *  Base            : This classes design base on Dynamic Truncation made by RFC4226 (https://tools.ietf.org/html/rfc4226#section-5.4)
 */

 
 /*
---------------------------------------------------------------------
|            Linear Congruential Generator Documentation            |
---------------------------------------------------------------------
| If you want to use this Dynamic Truncation, just put this class   |
| into your library.                                                |
|                                                                   |
| After you put this class into your website library, you can load  |
| and access this class on your controller                          |
|                                                                   |
| The usage of this Dynamic Truncation class is simple, just put    |
| your hash into make method                                        |
|                                                                   |
|                $this->dt->make($yourhash);                        |
|                                                                   |
---------------------------------------------------------------------
*/

class Dt {

    public function __constructor()
    {
        $CI =& get_instance();
    }

    // method for making 6 digit OTP
    public function make($hash)
    {
        //Modulo Constanta
        $modulo = "1000000";

        //get index offset
        $indexOffset = strlen($hash)-1;

        //get offset hexadecimal
        $choosenOffset = substr($hash, $indexOffset);

        //convert offset hexadecimal to decimal
        $offset = hexdec($choosenOffset);

        //get choosen hexadecimal from offset index
        $choosenHexadecimal = substr($hash, $offset * 2, 8);

        //convert choosen hexadecimal to decimal
        $choosenHexadecimalToDecimal = hexdec($choosenHexadecimal);

        //choosen decimal mod by modulo
        $otp = gmp_mod($choosenHexadecimalToDecimal, $modulo);

        // $otp = $choosenHexadecimalToDecimal % $modulo;
        // $array = array();
        // $array['hash'] = $hash;
        // $array['indexOffset'] = $indexOffset;
        // $array['choosenOffset'] = $choosenOffset;
        // $array['choosenHexadecimal'] = $choosenHexadecimal;
        // $array['choosenHexadecimalToDecimal'] = $choosenHexadecimalToDecimal;
        // $array['otp'] = $otp;
        // return $array;

        // return value of OTP
        return $otp;

    }
}