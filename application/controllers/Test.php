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


	// public function otp($totalExecutionTime)
	public function otp()
	{
        // start running test
		// $this->benchmark->mark('code_start');

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
        // $this->benchmark->mark('code_end');

        // execution time
        // $execution = $this->benchmark->elapsed_time('code_start', 'code_end');

        //initialization array
        // $data = array(
        //     'Otp Count'         => $otpCount, 
        //     'Seed'              => $seed,
        //     'Key'               => $key,
        //     'Plaintext'         => $this->date->getDateTime($plaintext),
            // 'KeyScheduling'     => $keyScheduling,
            // 'CipherText'        => $cipherText,
            // 'Otp'               => $otp,
            // 'Execution Time'    => $execution,
        // );
		
		// debug($data);

		
		return $otp;
		// echo "\t";
		// echo $execution."<br/>";

		// return $execution;
	}

    // this function is for testing execution time
	public function running()
	{
		
		$data = array(
			'seed' => '3585281', 
			'otp_count' => '3',
		);

		$this->session->set_userdata($data);

		// $totalExecutionTime = null;

		// this code below is for running test generate OTP untill 3 minutes or 180 seconds
		// Please open comment tag below, in case for debuging or testing purpose
       ///*

		// set_time_limit(180);

		// while ($totalExecutionTime < 180) {
		
		// 	$totalExecutionTime = $totalExecutionTime + $this->otp($totalExecutionTime);

		// }

		//and open comment tag below
        //*/

		// this code below is for generate OTP once time
		// $this->otp($totalExecutionTime);


		$this->otp();
	}


	public function exhaustiveAttack()
	{
		$randomOTP = array();

		for ($i=0; $i < 30; $i++) { 

			echo $i."------------------<br/>";
			
			for ($j=0; $j < 30; $j++) { 
				
				echo $randomOTP[$i][$j] = mt_rand(100000, 999999)."<br/>";
			}
		}

		$randomOTP[15][15] = 583748;
		// debug($randomOTP);
		$i = 0;
		$j = 0;
		$counter = 1;
		$otp = null;
		$status = 0;

		// for ($n=1; $n < 4; $n++) { 

		// 	if ($n == 1) {
				
		// 		$otp = 583748;
			
		// 	}elseif ($n == 2) {
				
		// 		$otp = 928233;

		// 	}elseif ($n == 3) {
				
		// 		$otp = 172396;
		// 	}

		// 	$status = 0;
			
		// 	while ($i < 30 && $status == 0) {
			
		// 		while ($j < 30 && $status == 0) {
					
		// 			if ($randomOTP[$i][$j] != $otp) {
						
		// 				echo $status."=====================<br/>";
		// 				echo $randomOTP[$i][$j]." ".$otp."=====================<br/>";
		// 				$status = 1;
		// 			}
		// 		}
				
		// 	}
	
		// }
		
		$execution = null;

		for ($n=1; $n < 4; $n++) { 
			
			if ($n == 1) {
				
				$otp = 583748;
			
			}elseif ($n == 2) {
				
				$otp = 928233;

			}elseif ($n == 3) {
				
				$otp = 172396;
			}

			for ($i=0; $i < 30; $i++) { 
			
				for ($j=0; $j < 30; $j++) { 

					// start running test
					$this->benchmark->mark('code_start');
					
					if ($randomOTP[$i][$j] == $otp) {
						
						echo $counter."=====================<br/>";
						$counter++;
					}

					// end of running test
					$this->benchmark->mark('code_end');

					// execution time
					$execution = $execution + $this->benchmark->elapsed_time('code_start', 'code_end');
					echo $execution."=====================<br/>";
					
				}
			}
		}		
	}

	public function ea()
	{
		//initialization array and variable
		$OTPforExhaustive = array();
		$status = null;
		$counter = null;
		$otp = null;

		// start execution time
		$this->benchmark->mark('code_start');

		for ($i = 0; $i < 1000000 ; $i++) {

			if($i < 100000){

				$OTPforExhaustive[$i] = str_pad($i, 6, 0, STR_PAD_LEFT);	
			
			}else{

				$OTPforExhaustive[$i] = $i;
			}
		}
		// end of execution time
		$this->benchmark->mark('code_end');

		// execution time
		echo "Waktu Eksekusi = ".$this->benchmark->elapsed_time('code_start', 'code_end');
		echo "<br/>";

		// looping for exhaustive attack
		// looping is working when $counter under 3 and $status is null
		while ($counter < 3 && $status == null) {
			
			// condition when $counter is 1, OTP will fill with 583748
			if ($counter == 1) {
				
				$otp = 583748;
			
			// condition when $counter is 2, OTP will fill with 928233
			}elseif ($counter == 2) {
				
				$otp = 928233;

			// condition when $counter is 3, OTP will fill with 172396			
			}elseif ($counter == 3) {
				
				$otp = 172396;
			}

			// get random index for $OTPforExhaustive
			$randomIndex = mt_rand(0, 999999);

			// condition when $OTPforExhaustive is same with $otp
			if ($OTPforExhaustive[$randomIndex] == $otp) {
				
				$status++;
				echo $otp." - ".$status."=====================<br/>";
			
			// condition when $OTPforExhaustive is not same with $otp
			}else{

				$counter++;
			}

			echo "Random Index = ".$randomIndex."<br/>";
		}
		
		echo "Jumlah Exhaustive Sukses = ".$status."<br/>";

		debug($OTPforExhaustive);
	}

	public function trialAndError()
	{
		$seed = null;
		$original = array();
		$guess = array();
		$hitung = 0;
		$hitungBerhasil = 0;

		for ($i=0; $i < 30; $i++) {

			set_time_limit(180);

			$forSeed = random_int(0, 99999999);

			if ($forSeed < 10000000) {
				
				$seed = "0812".str_pad($forSeed, 8, 0, STR_PAD_LEFT);

			}else{
				
				$seed = "0812".$forSeed;
			}

			$counter = 1;
			$status = null;

			$data = array(
				'seed' => $seed, 
				'otp_count' => $counter,
			);

			$this->session->set_userdata($data);

			while ($counter <= 3 || $status == 1) {

				$otp = $this->otp();
				$forOtpTest = random_int(100000, 999999);

				if ($forOtpTest < 100000) {
				
					$otpTest = str_pad($forOtpTest, 6, 0, STR_PAD_LEFT);
	
				}else{
					
					$otpTest = $forOtpTest;
				}

				if (gmp_intval($otp) == $otpTest) {
					
					$status = 1;
					$hitungBerhasil++;
				
				}else{

					$status = 0;
				}

				$original[$hitung] = $otp;
				$guess[$hitung] = $otpTest;
				echo $counter*($i+1)." - ".$otp." - ".$otpTest." - ".$status." - ".$seed."</br>";

				$counter++;
				$hitung++;
				
			}	
		}


		echo "Keberhasilan Serangan = ".$hitungBerhasil."<br/>";
		echo "==============ORIGINAL==============<br/>";
		for ($i=0; $i < 90; $i++) { 
			
			echo str_pad($original[$i], 6, 0, STR_PAD_RIGHT)."<br/>";
		}

		echo "==============TEBAKAN==============<br/>";

		for ($i=0; $i < 90; $i++) { 
			
			echo $guess[$i]."<br/>";
		}
	}

	public function exhaustive()
	{
		$seed = null;
		$original = array();
		$otpTest = array();
		$guess = array();
		$hitung = 0;
		$hitungBerhasil = 0;
		$counterOTPTest = 0;

		for ($i=0; $i < 1000000; $i++) { 
			
			if ($i < 100000) {
			
				$otpTest[$i] = str_pad($i, 6, 0, STR_PAD_LEFT);

			}else{
				
				$otpTest[$i] = $i;
			}

		}


		for ($i=0; $i < 30; $i++) {

			set_time_limit(180);

			$forSeed = random_int(0, 99999999);

			if ($forSeed < 10000000) {
				
				$seed = "0812".str_pad($forSeed, 8, 0, STR_PAD_LEFT);

			}else{
				
				$seed = "0812".$forSeed;
			}

			$counter = 1;
			$status = null;

			$data = array(
				'seed' => $seed, 
				'otp_count' => $counter,
			);

			$this->session->set_userdata($data);

			while ($counter <= 3 || $status == 1) {

				$otp = $this->otp();
				

				if (gmp_intval($otp) == $otpTest[$counterOTPTest]) {
					
					$status = 1;
					$hitungBerhasil++;
				
				}else{

					$status = 0;
				}

				$original[$hitung] = $otp;
				$guess[$hitung] = $otpTest[$counterOTPTest];
				echo $counter*($i+1)." - ".$otp." - ".$otpTest[$counterOTPTest]." - ".$status." - ".$seed."</br>";

				$counter++;
				$hitung++;
				
			}	
		}


		echo "Keberhasilan Serangan = ".$hitungBerhasil."<br/>";
		echo "==============ORIGINAL==============<br/>";
		for ($i=0; $i < 90; $i++) { 
			
			echo str_pad($original[$i], 6, 0, STR_PAD_RIGHT)."<br/>";
		}

		echo "==============TEBAKAN==============<br/>";

		for ($i=0; $i < 90; $i++) { 
			
			echo $guess[$i]."<br/>";
		}
	}
}