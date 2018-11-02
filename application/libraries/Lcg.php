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
        $X = (7 * $seed + 0) % 9999991;
        return $X;
    }
}