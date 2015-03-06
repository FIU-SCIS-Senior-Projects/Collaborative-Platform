<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DateUtils
 *
 * @author aalfonso
 */
class DateUtils extends CComponent {
    
    public static function resetDateToFirstDayOfTheMonth(&$dateReset)
    {
        $date =  getdate($dateReset->getTimestamp());
        $dateReset->setDate($date["year"], $date["mon"], 1);
    }
    
    public static function resetDateToFirstDayOfTheYear(&$dateReset)
    {
        $date =  getdate($dateReset->getTimestamp());
        $dateReset->setDate($date["year"], 1, 1);        
    }
    
    public static function getDateParts($dateTime, &$year,&$month, &$day)
    {
       $date =  getdate($dateTime->getTimestamp()); 
       $year = $date["year"];
       $month = $date["mon"];
       $day = $date["mday"];       
    }
    
}
