<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  Name Class      : Date
 *  Purpose         : Make 6 Digit OTP
 *  Author          : Yogi Siswanto
 *  Email           : yogisiswanto.c2@gmail.com
 *  Date Created    : 1st November 2018
 *  Language        : PHP >= 7
 *  Base            : This classes is getting current time
 */

 
 /*
---------------------------------------------------------------------
|                            Date                                   |
---------------------------------------------------------------------
| If you want to use this Date, just put this class into your       |
| library.                                                          |
|                                                                   |
| After you put this class into your website library, you can load  |
| and access this class on your controller                          |
|                                                                   |
| The usage of this Date class is simple, just call get method      |
|                                                                   |
|                      $this->date->get();                          |
|                                                                   |
---------------------------------------------------------------------
*/

class Date {

    public function __constructor()
    {
        $CI =& get_instance();
    }

    // method for getting current Date and Time in GMT+7 Jakarta
    public function get()
    {
        //setting default time zone
        date_default_timezone_set("Asia/Jakarta");

        // get date value without delimiter
        $date = date('YmdHis');

        // return date value
        return $date;
    }

    // method convertion date from YYYY-mm-dd to YYYYmmdd
    // public function getBirthDay($birthDay)
    // {
    //     // convertion
    //     $date = date("Ymd", strtotime($birthDay));

    //     // return date value
    //     return $date;
    // }

    // public function calculate($start)
    // {   

    //     $dateStart = date_create($start);

    //     //setting default time zone
    //     date_default_timezone_set("Asia/Jakarta");

    //     // get date value without delimiter
    //     $dateEnd = date('YmdHis');

    
    //     $calculate = date_diff($dateStart, $dateEnd);


    // }

}