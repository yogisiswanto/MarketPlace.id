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

class User {

    private $id = null;
    private $fullName = null;
    private $userName = null;
    private $gender = null;
    private $email = null;
    private $password = null;
    private $phoneNumber = null;
    private $loginStatus = null;
    private $status = null;
    private $keyEncryption = null;
    private $ciphertext = null;
    private $activationCode = null;


    public function __constructor()
    {
        $CI =& get_instance();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setLoginStatus($loginStatus)
    {
        $this->loginStatus = $loginStatus;
    }

    public function getLoginStatus()
    {
        return $this->loginStatus;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setKeyEncryption($keyEncryption)
    {
        $this->keyEncryption = $keyEncryption;
    }

    public function getKeyEncryption()
    {
        return $this->keyEncryption;
    }

    public function setCiphertext($ciphertext)
    {
        $this->ciphertext = $ciphertext;
    }

    public function getCiphertext()
    {
        return $this->ciphertext;
    }

    public function setActivationCode($activationCode)
    {
        $this->activationCode = $activationCode;
    }

    public function getActivationCode()
    {
        return $this->activationCode;
    }

}