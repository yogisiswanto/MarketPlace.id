<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  Name Class      : Lcg
 *  Purpose         : Make Random Generator
 *  Author          : Yogi Siswanto
 *  Email           : yogisiswanto.c2@gmail.com
 *  Date Created    : 24th October 2018
 *  Language        : PHP >= 5
 *  Base            : This classes design base on Linear Congruental Generator made by Derrick Henry Lehmer in 1951
 */

 
 /*
---------------------------------------------------------------------
|            Linear Congruential Generator Documentation            |
---------------------------------------------------------------------
| If you want to use this Linear Congruential Generator, just put   |
| this class into your library.                                     |
|                                                                   |
| After you put this class into your website library, you can load  |
| and access this class on your controller                          |
|                                                                   |
| The usage of this Linear Congruential Generator class is simple,  |
| just put your seed into random method of LCG                      |
|                                                                   |
|                $this->lcg->random($yourSeed);                     |
|                                                                   |
---------------------------------------------------------------------
*/

class Lcg {

    public function __constructor()
    {
        $CI =& get_instance();
    }

    // function for generating random number
    public function random($seed)
    {
        $a = 7;
        $x0 = $seed;
        $b = 0;
        $M = 9999991;

        $X = ($a * $x0 + $b) % $M;

        // Please open comment tag below, in case for debuging or testing purpose
        /*

        $data = array(
            'X' => $X, 
            'Hexadecimal' => implode(" ", str_split(dechex($X), 2))." ",
        );
        
        // show data from array
        debug($data);
        
        // return array
        return $data;

        //and open comment tag below
        */

        // return the result from LCG process
        return $X;
    }
}