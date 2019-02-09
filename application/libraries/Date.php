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
|                                                                   |
| To get interval time, just put start time to timeInterval method  |
|                                                                   |
|               $this->date->timeInterval($startTime);              |
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

    // method for getting interval time
    public function timeInterval($start)
	{
        // inisialization result
        $result = null;

        // inisialization end time
        $end = $this->get();
        
        // making time from start and end time
		$datetime1 = date_create($start);
		$datetime2 = date_create($end);
        
        // geting interval time
		$interval = date_diff($datetime1, $datetime2);
        
        // geting minute from interval
        $time = $interval->format('%i');
        
        // condition when start time is less than end time and interval less than 3 minute
        if ($datetime1 < $datetime2 && $time < 3) {
        
            $result = true;

        // condition when start time is greater than end time or interval greater than 3 minute        
		}else {
            
            $result = false;
        }
        
        // return result
        return $result;
	}
}