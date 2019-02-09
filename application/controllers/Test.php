<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  Name Class      : Test Controller
 *  Purpose         : Testing all Library
 *  Author          : Yogi Siswanto
 *  Email           : yogisiswanto.c2@gmail.com
 *  Date Created    : 29th January 2019
 *  Language        : PHP >= 7
 */


 /*
---------------------------------------------------------------------
|                       Testing Documentation                       |
---------------------------------------------------------------------
| If you want to use this RC6 algorihtm in your Website Development,|
| you can put this class into your library.                         |
|                                                                   |
| After you put this class into your website library, you can load  |
| and access this class on your controller                          |
|                                                                   |
| The usage of this RC6 Algorithm class is below                    |
|                                                                   |
| 1. You must generate your key into keyScheduling method           |
|                                                                   |
|               $this->rc6->keySchedule($yourKey);                  |
|	                                                                |
|                                                                   |
| 2. Put your plaintext and your keyScheduling into Encryption      |
|    method                                                         |
|                                                                   |
|       $this->rc6->encrypt($yourPlaintext, $keySchedule);          |
|	                                                                |
|                                                                   |
| 3. If you want to decrypt the cipher text, you can Put your       |
|    ciphertext and keyScheduling into Decryption method            |
|                                                                   |
|       $this->rc6->decrypt($yourCiphertext, $keySchedule);         |
|	                                                                |
---------------------------------------------------------------------
*/

class Test extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->model('User_Model');
		$this->load->library('Lcg');
		$this->load->library("Rc6");
		$this->load->library("Hotp");
		$this->load->library("Date");
		$this->load->library("Sms");
		$this->load->library("Avalancheeffect");
		$this->load->library("Convert");
    }
    
    // this function is for testing LCG
	public function lcg()
	{
        // inisialization variable
        $seed = '081299999999';

        $lcg = $this->lcg->random($seed);
        
        debug($lcg);
    }

	// this function is for testing RC6
	public function rc6()
	{
        // variable inisialization
        $key = 8289400;
        $plaintext = 20010101010101;

		// getting keyScheduling from key
		$keyScheduling = $this->rc6->keySchedule($key);

		// encryption plaintext using RC6 algorithm and keyScheduling
        $cipherText = $this->rc6->encrypt($plaintext, $keyScheduling);
        
        // decryption plaintext using RC6 algorithm and keyScheduling
		$decryption = $this->rc6->decrypt($cipherText, $keyScheduling);

        // converting ciphertext to hexadecimal
		$hexadecimal = $this->convert->stringToHexadecimal($cipherText);

		// converting hexadecimal to ciphertext
		$string = $this->convert->hexadecimalToString($hexadecimal);
		
		// getting keyschedule without array index
		// for ($i=0; $i < count($keyScheduling); $i++) { 
			
		// 	echo $keyScheduling[$i]."<br/>";
		// }

		$data = array(
            'Key'                       => $key,
            'Plaintext' 		        => $plaintext,
            'KeyScheduling' 	        => $keyScheduling, 
            'Encryption' 		        => $cipherText,
            'Decryption' 		        => $decryption,
			'Hexadesimal Ciphertext'    => $hexadecimal,
			'String'					=> $string,
        );

		debug($data);
	}

    // this function is for testing Avalanche Effect
	function avalancheEffect()
	{
        // variable inisialization
        $key = 8289400;
        $plaintext = 20010101010101;
		$hexadecimal = null;
		$modifiedhexadecimal = null;

		/**
		 * First Sceme
		 * Avalanche Effect with differents key and same plaintext
		 */
        
        // put the opening comment tag section below this commentar
        
        // modidified key
		$modifiedKey = $this->avalancheeffect->changeBit($key);
		
		//initial encryption
		$keyScheduling = $this->rc6->keySchedule($key);
		$cipherText = $this->rc6->encrypt($plaintext, $keyScheduling);

		//modified encryption
		$modifiedKeyScheduling = $this->rc6->keySchedule($modifiedKey);
		$modifiedCipherText = $this->rc6->encrypt($plaintext, $modifiedKeyScheduling);

		//avalanche effect result
		$this->avalancheeffect->calculate($cipherText, $modifiedCipherText);

        // converting ciphertext to hexadecimal
        $hexadecimal = $this->convert->stringToHexadecimal($cipherText);
        
        // converting mofied ciphertext to hexadecimal
		$modifiedhexadecimal = $this->convert->stringToHexadecimal($modifiedCipherText);

		//initialization arry
		$data = array(
			'Key'                   => $key,
			'Modified Key'          => $modifiedKey,
			'Plaintext'             => $plaintext,
			'CipherText'            => $cipherText,
			'Modified CipherText'   => $modifiedCipherText,
			'hexadecimal'           => $hexadecimal,
			'modifiedhexadecimal'   => $modifiedhexadecimal,
		);
	
        // and put the closing comment tag section below this commentar



		/**
		 * Second Sceme
		 * Avalanche Effect with same key and differents plaintext
		 */

        // put the opening comment tag section below this commentar
        
        // Please copy paste this opening comment tag below to each sceme, in case for debuging or testing purpose
        /*

        // modified plaintext
		$modifiedPlaintext = $this->avalancheeffect->changeBit($plaintext);

		//initial encryption
		$keyScheduling = $this->rc6->keySchedule($key);
		$cipherText = $this->rc6->encrypt($plaintext, $keyScheduling);

		//modified encryption
		$modifiedCipherText = $this->rc6->encrypt($modifiedPlaintext, $keyScheduling);

		//avalanche effect result
		$this->avalancheeffect->calculate($cipherText, $modifiedCipherText);

        //  converting ciphertext to hexadecimal
        $hexadecimal = $this->rc6->convertStringToHexa($cipherText);
        
        // converting mofied ciphertext to hexadecimal
		$modifiedhexadecimal = $this->rc6->convertStringToHexa($modifiedCipherText);

		//initialization array
		$data = array(
			'Key'                   => $key,
			'Plaintext'             => $plaintext,
			'Modified Plaintext'    => $modifiedPlaintext,
			'CipherText'            => $cipherText,
			'Modified CipherText'   => $modifiedCipherText,
			'hexadecimal'           => $hexadecimal,
			'modifiedhexadecimal'   => $modifiedhexadecimal,
        );
        
        // put the opening comment tag section below this commentar

        //Closing comment tag
        */

		debug($data);
	}

    // this function is for testing HOTP
	public function hotp()
	{
		// variable inisialization
        $key = '8289400';
        $plaintext = '20010101010101';
        $otpCount = 1;

		// getting keyScheduling from key
		$keyScheduling = $this->rc6->keySchedule($key);

		// encryption plaintext using RC6 algorithm and keyScheduling
		$cipherText = $this->rc6->encrypt($plaintext, $keyScheduling);

		// make 6 digit otp using HOTP method
        $otp = $this->hotp->make($cipherText, $otpCount);
        
        //initialization array
        $data = array(
            'Otp Count'         => $otpCount, 
            'Key'               => $key,
            'Plaintext'         => $plaintext,
            'KeyScheduling'     => $keyScheduling,
            'CipherText'        => $cipherText,
            'Otp'               => $otp,
        );
		
		debug($data);
	}


	public function otp($totalExecutionTime)
	{
        // start running test
		$this->benchmark->mark('code_start');

		// using user phone number as seed
		$seed = $this->session->seed;

		// generate key for encryption using LCG
		$key = $this->lcg->random($seed);

		// update seed with new value from lcg
		$this->session->set_userdata('seed', $key);

		// getting plaintext from date (YYYYmmddHis)
		$plaintext = $this->date->get();

		// getting keyScheduling from key
		$keyScheduling = $this->rc6->keySchedule($key);

		// encryption plaintext using RC6 algorithm and keyScheduling
		$cipherText = $this->rc6->encrypt($plaintext, $keyScheduling);

		// getting current OTP generation
		$otpCount = $this->session->otp_count;

		// make 6 digit otp using HOTP method
		$otp = $this->hotp->make($cipherText, $otpCount);

		// counting otp generation
		$nextGenerationOtp = $otpCount + 1;

		// updating otp generation
		$this->session->set_userdata('otp_count', $nextGenerationOtp);

        // end of running test
        $this->benchmark->mark('code_end');

        // execution time
        $execution = $this->benchmark->elapsed_time('code_start', 'code_end');

        //initialization array
        $data = array(
            'Otp Count'         => $otpCount, 
            'Seed'              => $seed,
            'Key'               => $key,
            'Plaintext'         => $plaintext,
            'KeyScheduling'     => $keyScheduling,
            'CipherText'        => $cipherText,
            'Otp'               => $otp,
            'Execution Time'    => $execution,
        );
		
		// debug($data);

		
		echo $otp;
		echo "\t";
		echo $execution."<br/>";

		return $execution;
	}

    // this function is for testing execution time
	public function running()
	{
		
		$data = array(
			'seed' => '081211111111', 
			'otp_count' => '1',
		);

		$this->session->set_userdata($data);

		$totalExecutionTime = null;

		// this code below is for running test generate OTP untill 3 minutes or 180 seconds
		// Please open comment tag below, in case for debuging or testing purpose
       ///*

		set_time_limit(180);

		while ($totalExecutionTime < 180) {
		
			$totalExecutionTime = $totalExecutionTime + $this->otp($totalExecutionTime);

		}

		//and open comment tag below
        //*/

		// this code below is for generate OTP once time
		// $this->otp($totalExecutionTime);
	}
}