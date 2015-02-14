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
    
    
    
    public static function moveColumnsByIndex($intSourceIndex,$intDestIndex,&$arrColumns)
    {
        
        If ($intSourceIndex < $intDestIndex)
        {
            
            //'Moving fordward
            //small validation first
            If ($intDestIndex < count($arrColumns))
            {
                //jump straght to the Source Index and get its value
                $tmpSourceValue = $arrColumns[$intSourceIndex];
                $intCurrentItemIndex = $intSourceIndex;

                //begin the shift process
                While ($intCurrentItemIndex < count($arrColumns) &&  $intCurrentItemIndex < $intDestIndex)
                {
                    $arrColumns[$intCurrentItemIndex] = $arrColumns[$intCurrentItemIndex + 1]; //shift the item to the left
                    $intCurrentItemIndex ++;
                }
                //At this point the source will be ready to be placed
                $arrColumns[$intCurrentItemIndex] = $tmpSourceValue;
            }
        }elseif ($intSourceIndex > $intDestIndex)
        {
            //Moving backward
            //small validation first
            If ($intDestIndex >= 0)
            {
                $tmpSourceValue  = $arrColumns[$intSourceIndex];
                $intCurrentItemIndex = $intSourceIndex;

                While ($intCurrentItemIndex > 0 && $intCurrentItemIndex > $intDestIndex)
                {
                    $arrColumns[$intCurrentItemIndex] = $arrColumns[$intCurrentItemIndex - 1]; //shift the item to the left
                    $intCurrentItemIndex--;
                }
                
                
                //At this point the soure will be ready to be placed
                $arrColumns[$intCurrentItemIndex] = $tmpSourceValue;
            }      
        }
    }
}
