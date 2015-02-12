<?php

/**
 * ReportUtils short summary.
 *
 * ReportUtils description.
 *
 * @version 1.0
 * @author aalfonso
 */
class ReportUtils extends CComponent
{
    public static function dateformat($date)
    {
        $date=date('m-d-Y',strtotime($date));   
        return $date;
    }
    
    public static function getZeroOneToYesNo($value)
    {
        $res = "Yes";
        
        if ($value == 0)
            $res = "No";
        
        return $res;
        
    }

        
    
    
}
