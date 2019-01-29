<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  Name Class      : Avalancheeffect
 *  Purpose         : For measurement Avalanche Effect of cryptofgraphy algorithm
 *  Author          : Yogi Siswanto
 *  Email           : yogisiswanto.c2@gmail.com
 *  Date Created    : 24th October 2018
 *  Language        : PHP >= 5
 */

/*
---------------------------------------------------------------------
|                   Avalanche Effect Documentation                  |
---------------------------------------------------------------------
| If you want to use this Avalanche Effect, just put this class     |
| into your library.                                                |
|                                                                   |
| After you put this class into your website library, you can load  |
| and access this class on your controller                          |
|                                                                   |
| The usage of this Avalanche Effect class is simple, just put your |
| ciphertext1 and ciphertext2 into avalancheeffect method           |
|                                                                   |
|$this->avalancheEffect->avalancheEffect($cipherText1, $cipherText2)|
|                                                                   |
|  For changing bit, just put your key or plaintext into changeBit  |
|  method                                                           |
|                                                                   |
|      $this->avalancheEffect->changeBit($keyOrPlaintext)           |
---------------------------------------------------------------------
*/

// avalancheEffect class
class Avalancheeffect {
    
    public function __constructor()
    {
        $CI =& get_instance();
    }

    
    // function for measurement avalancheEffect of cryptofgraphy algorithm
    public function calculate($cipherText1, $cipherText2){
        
        // variable instantiation
        $counter = 0;
        $totalBit = 8 * strlen($cipherText1);

        echo '<br/>Result :<br/>';

        // iteration from cipherText length
        for ($i=0; $i < strlen($cipherText1); $i++) { 
            
            // converting character from cipherText into decimal ASCII
            $charToDecimal = ord($cipherText1[$i]);
            $charToDecimal2 = ord($cipherText2[$i]);

            // converting decimal into binary
            $decimalToBin = decbin($charToDecimal);
            $decimalToBin2 = decbin($charToDecimal2);

            // adding 0 infront of decimal to become 8 bits
            $eightBit = str_pad($decimalToBin, 8, 0, STR_PAD_LEFT);
            $eightBit2 = str_pad($decimalToBin2, 8, 0, STR_PAD_LEFT);

            // iteration for checking value bits
            for($j = 0; $j < 8; $j++){

                // when bit is not equal, counter increase
                if ($eightBit[$j] != $eightBit2[$j]) {
                
                    $counter++;
                }
            }

            // showing each char and each bit
            echo 'char from cipher text 1 = ' . $cipherText1[$i] . '   bit = '. $eightBit . '<br/>';
            echo 'char from cipher text 2 = ' . $cipherText2[$i] . '   bit = '. $eightBit2 . '<br/>';
            echo '-----------<br/>';
        }

        // showing the output of avalancheEffect
        echo 'Total bit different = ' . $counter . '<br/>';
        echo 'Total bit = ' . $totalBit . '<br/>';
        echo 'Avalanche Effect = '. ($counter / $totalBit) * 100 . '%';
    }

    // function for change bit of key or plaintext
    function changeBit($number)
	{        
        //take the last value of number
        $initialLastInteger = $number % 10;
        
        //change the initial value into ASCII
        $initialDecimal = ord($initialLastInteger);
        
        //change ASCII value into binnary
        $initialBinnary = decbin($initialDecimal);
        
        //calculate length of byte
		$length = strlen($initialBinnary)-1;

        //condition when the last bit from initialBinnary is 1, then the last bit will change to 0 by XOR-ing with 1
		if ($initialBinnary[$length] == 1) {
			
			// $binnary[$length] = 0;
			$number = $number ^ 1;

        //condition when the last bit from initialBinnary is 0, then the last bit will change to 1 by XOR-ing with 1
		}else{

			$number = $number ^ 1;
        }

        // Please open comment tag below, in case for debuging or testing purpose
        /*
        
        //take the last value of modified number
        $modifiedLastInteger = $number % 10;
    
        //change the last modified number value into ASCII 
        $modifiedDecimal = ord($modifiedLastInteger);
        
        //change ASCII value into binnary
        $modifiedBinnary = decbin($modifiedDecimal);

        //array initiazation
        $data = array(
            'initialLastInteger'    => $initialLastInteger,
            'modifiedLastInteger'   => $modifiedLastInteger,
            'initialDecimal'        => $initialDecimal,
            'modifiedDecimal'       => $modifiedDecimal,
            'initialBinnary'        => $initialBinnary,
            'modifiedBinnary'       => $modifiedBinnary,
            'number'                => $number
        );

        // debug($data);

        //and open comment tag below
        */

        // return the change key or plaintext
        return $number;
    }
}
