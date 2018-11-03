<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  Name Class      : Sms
 *  Purpose         : Sending SMS Gateway
 *  Author          : Yogi Siswanto
 *  Email           : yogisiswanto.c2@gmail.com
 *  Date Created    : 3rd November 2018
 *  Language        : PHP >= 5
 *  Base            : This classes design for sending SMS using SMS API Gateway from Zenziva.id

 
 /*
---------------------------------------------------------------------
|                         SMS API Documentation                     |
---------------------------------------------------------------------
| If you want to use SMS API Gateway from Zenziva.id, just put      |
| this class into your library.                                     |
|                                                                   |
| After you put this class into your website library, you can load  |
| and access this class on your controller                          |
|                                                                   |
| The usage of this SMS API class is simple, just put your          |
| phone number target and OTP code into send method                 |
|                                                                   |
|            $this->sms->send($targetPhoneNumber, $otp);            |
|                                                                   |
---------------------------------------------------------------------
*/

class Sms {

    public function __constructor()
    {
        $CI =& get_instance();
    }

    public function send($phoneNumber, $otp)
    {
        $userkey = "645bq2"; //userkey lihat di zenziva
		$passkey = "xu97p9jfnp"; // set passkey di zenziva
		$telepon = $phoneNumber;
		$message = "Terimakasih pelanggan yang terhormat, ini adalah layanan kode verifikasi dari marketPlace.id. Silahkan masukan kode $otp kedalam website kami. Terimakasih ";
		$url = "https://reguler.zenziva.net/apps/smsapi.php";
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $url);
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
		curl_setopt($curlHandle, CURLOPT_POST, 1);
		$results = curl_exec($curlHandle);
		curl_close($curlHandle);

		$XMLdata = new SimpleXMLElement($results);
		$status = $XMLdata->message[0]->text;
		return $status;
    }

}