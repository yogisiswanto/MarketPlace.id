<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  Name Class      : Hotp
 *  Purpose         : Make 6 Digit OTP
 *  Author          : Yogi Siswanto
 *  Email           : yogisiswanto.c2@gmail.com
 *  Date Created    : 1st November 2018
 *  Language        : PHP >= 7
 *  Base            : This classes design base on HOTP made by RFC4226 (https://tools.ietf.org/html/rfc4226#section-5.4)
 */

 
 /*
---------------------------------------------------------------------
|                              HOTP                                 |
---------------------------------------------------------------------
| If you want to use this HOTP, just put this class into your       |
| library.                                                          |
|                                                                   |
| After you put this class into your website library, you can load  |
| and access this class on your controller                          |
|                                                                   |
| The usage of this HOTP class is simple, just put  your ciphertext |
| and otpCounter into make method                                   |
|                                                                   |
|       $this->hotp->make($yourCipherText, $otpCounter);            |
|                                                                   |
---------------------------------------------------------------------
*/

class Hotp {

    public function __constructor()
    {
        $CI =& get_instance();
    }

    // method for making 6 digit OTP
    public function make($cipherText, $otpCounter)
    {
        $data = array();
        
        //Modulo Constanta
        $modulo = "1000000";
        
        //getting message digest value from HMAC using SHA1 algortithm
        $hash   =   hash_hmac("sha1", $otpCounter, $cipherText);

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
        $data['code'] = gmp_mod($choosenHexadecimalToDecimal, $modulo);

        // $otp = $choosenHexadecimalToDecimal % $modulo;
        // $array = array();
        // $array['hash'] = $hash;
        // $array['indexOffset'] = $indexOffset;
        // $array['choosenOffset'] = $choosenOffset;
        // $array['choosenHexadecimal'] = $choosenHexadecimal;
        // $array['choosenHexadecimalToDecimal'] = $choosenHexadecimalToDecimal;
        // $array['otp'] = $otp;
        // return $array;
        $data['HMAC'] = $hash;
        // return value of OTP
        return $data;

    }
}