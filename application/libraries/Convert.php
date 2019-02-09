<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  Name Class      : Convert
 *  Purpose         : Converting hexadecimal to string and conversely
 *  Author          : Yogi Siswanto
 *  Email           : yogisiswanto.c2@gmail.com
 *  Date Created    : 3rd February 2019
 *  Language        : PHP >= 5
 */

/*
---------------------------------------------------------------------
|                   Convert Documentation                           |
---------------------------------------------------------------------
| If you want to converting from hexadecimal to string and          |
| conversely, just put this class into your library.                |
|                                                                   |
| After you put this class into your website library, you can load  |
| and access this class on your controller                          |
|                                                                   |
| If you want to converting from hexadecimal to string, just put    |
| your hexadecimal to hexadecimalToString method                    |
|                                                                   |
|     $this->convert->hexadecimalToString($yourHexadecimal)         |
|                                                                   |
| If you want to converting from string to hexadecimal, just put    |
| your hexadecimal to stringToHexadecimal method                    |
|                                                                   |
|       $this->convert->stringToHexadecimal($yourString)            |
---------------------------------------------------------------------
*/

// Converting class
class Convert {
    
    public function __constructor()
    {
        $CI =& get_instance();
    }

    // method for converting hexadecimal to string
    public function hexadecimalToString($x) { 
        
        $hexadecimal = null; 

        foreach(explode("\n",trim(chunk_split($x,2))) as $h) $hexadecimal.=chr(hexdec($h)); 
        
		return $s; 
	} 
     
    // method for converting string to hexadecimal
	public function stringToHexadecimal($x) { 
        
        $string = null; 

        foreach(str_split($x) as $c) $string.=sprintf("%02X",ord($c)); 
        
		return $string; 
	} 
}
