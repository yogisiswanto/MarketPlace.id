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
|                       Date Documentation                          |
---------------------------------------------------------------------
| If you want to use this Date, just put this class into your       |
| library.                                                          |
|                                                                   |
| After you put this class into your website library, you can load  |
| and access this class on your controller                          |
|                                                                   |
| To get Date Time without delimiter, just call get method          |
|                                                                   |
|                      $this->date->get();                          |
|                                                                   |
| To get Date Time with delimiter, just call getDateTime method     |
|                                                                   |
|                  $this->date->getDateTIme();                      |
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

    // method convertion date from YYYYmmddhhiiss to YYYY-mm-dd hh:ii:ss
    public function getDateTime($dateTime)
    {
        // convertion
        $date = date("Y-m-d H:i:s", strtotime($dateTime));

        // return date value
        return $date;
    }

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