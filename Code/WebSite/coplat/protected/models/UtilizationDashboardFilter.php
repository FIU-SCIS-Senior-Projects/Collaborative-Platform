<?php
class DimensionType
{
    const Date =1;
    const Year =2;
    const MonthOfTheYear = 3;    
    
    
    public static function getDimensions()
    {
     return  array(DimensionType::Date  =>DimensionType::getDescriptionByDateDimension(DimensionType::Date),
                   DimensionType::MonthOfTheYear  =>DimensionType::getDescriptionByDateDimension(DimensionType::MonthOfTheYear),
                   DimensionType::Year  =>DimensionType::getDescriptionByDateDimension(DimensionType::Year));
    }
    
    public static function getDescriptionByDateDimension($dimensionType)
     {
       switch ($dimensionType)
       {
           case DimensionType::Date:
                   $dimensionDesc = "date";   
               break;            
           case DimensionType::MonthOfTheYear:
                   $dimensionDesc = "month"; 
               break;           
           case DimensionType::Year:
                  $dimensionDesc = "year"; 
               break;
           default:
               throw new CException("Invalid dimension");
       }
       return $dimensionDesc;
     }
     
     public static function getDateFormatByDimension($dimensionType)
     {
         switch ($dimensionType)
       {
           case DimensionType::Date:
                   $dimensionFormat = "dd MMM yyyy";   
               break;            
           case DimensionType::MonthOfTheYear:
                   $dimensionFormat = "MMM yyyy"; 
               break;           
           case DimensionType::Year:
                  $dimensionFormat = "yyyy"; 
               break;
           default:
               throw new CException("Invalid dimension");
       }
       return $dimensionFormat;
     }
    
           
    
}


class UtilizationDashboardFilter extends CFormModel
{
    //New ticket dashboard
    public $newTicketsCurrentDimension;
    public $newTicketsFromDate;
    public $newTicketsToDate;
    public $newTicketsDomainID;
    public $newTicketsSubDomainID;
    
    
    public function rules()
    {
        return array(
            array('newTicketsCurrentDimension, newTicketsFromDate, newTicketsToDate', 'required'),
            array('newTicketsDomainID, newTicketsSubDomainID', 'numerical', 'integerOnly'=>true),
            array('newTicketsFromDate, newTicketsToDate', 'date')                     
        );
    }
    
    public function attributeLabels()
    {
		return array(
			'newTicketsFromDate' => 'From',
			'newTicketsToDate' => 'To',
            'newTicketsDomainID' => 'Domain',
            'newTicketsSubDomainID'=>'Sub Domain'   );
    }
    
    public static function initializeFilters()
    {
            $date = new DateTime();
		    date_sub($date, new DateInterval("P1Y"));
            
            //Initialize the filter model
            $ultilizationFilter = new UtilizationDashboardFilter();
            $ultilizationFilter->newTicketsCurrentDimension = DimensionType::MonthOfTheYear;
            $ultilizationFilter->newTicketsToDate = date('m/d/Y');// date("m/d/y");
		    $ultilizationFilter->newTicketsFromDate =  $date->format('m/d/Y');
            return $ultilizationFilter;
        }
        
    public function retrieveDashboardData(&$newEvents)
    {
        //New event data

      $this->retrieveEventsData($newEventData);
       
   /*   $fromDate = new DateTime($this->newTicketsFromDate);
       $toDate = new DateTime($this->newTicketsToDate);
       
       $dateInterval;
       switch ($this->newTicketsCurrentDimension)
       {
           case DimensionType::Date:
              $dateInterval =  new DateInterval("P1D");
               break;            
           case DimensionType::MonthOfTheYear:
              $dateInterval =  new DateInterval("P1M");
              DateUtils::resetDateToFirstDayOfTheMonth($fromDate); 
              break;           
           case DimensionType::Year:
               $dateInterval =  new DateInterval("P1Y");
               DateUtils::resetDateToFirstDayOfTheYear($fromDate); 
               break;
           default:
               throw new CException("Invalid dimension");
       }   
       
       $dateFormated = "";
       $currentIndex = 0;
       
       if (count($newEventData)> $currentIndex)
       {
            $currentReading = $newEventData[0]; 
       }           
     
       while ($fromDate <= $toDate)
       { 
          $countPart = 0; 
          DateUtils::getDateParts($fromDate,  $year,$month, $day);
          
          if (isset($currentReading))
          {
            $currentReadingYear =  ArrayUtils::getValueOrDefault($currentReading, "Year",1);
            $currentReadingMonth = ArrayUtils::getValueOrDefault($currentReading, "Month", 1);
            $currentReadingDay =   ArrayUtils::getValueOrDefault($currentReading, "Day" ,1); 
            
            if ($year == $currentReadingYear && $month == $currentReadingMonth && $day == $currentReadingDay)
            {
               $countPart =  ArrayUtils::getValueOrDefault($currentReading, "EventCount",0);
               $currentIndex++;
               if (count($newEventData)> $currentIndex)
               {
                   $currentReading = $newEventData[0]; 
               }else
               {
                   $currentReading = NULL;                   
               }               
            }
            
          }       
                   
          $dateFormated = $dateFormated.sprintf('[new Date(%s, %s, %s), %s],',$year,$month - 1,$day,$countPart);
         
           
          $fromDate->add($dateInterval);
       }
        $newEvents = "[".$dateFormated."]" ;// "[[new Date(2015, 2, 1),1],[new Date(2015, 3, 1),1]]";// json_encode($monthData);
      */
    }
    
    
     private function retrieveEventsData(&$newEventsData)
    {
        $command =  Yii::app()->db->createCommand();
                  
       switch ($this->newTicketsCurrentDimension)
       {
         case DimensionType::Date:
               $command->select(array("COUNT(1) AS EventCount, DAY(event_recorded_date) AS Day, MONTH(event_recorded_date) AS Month, YEAR(event_recorded_date)AS Year"));  
               $command->group('DATE(ticket_events.event_recorded_date)');
           
               break;            
           case DimensionType::MonthOfTheYear:
               $command->select(array("COUNT(1) AS EventCount, MONTH(event_recorded_date) AS Month, YEAR(event_recorded_date) AS Year")); 
               $command->group('YEAR(ticket_events.event_recorded_date), MONTH(ticket_events.event_recorded_date)');
             
               break;           
           case DimensionType::Year:
               $command->select(array("COUNT(1) AS EventCount, YEAR(event_recorded_date) AS Year")); 
               $command->group('YEAR(ticket_events.event_recorded_date)');
           
     
               break;
           default:
               throw new CException("Invalid dimension");
       }
       $command->from("ticket_events");
       $command->join('ticket', 'ticket.id = ticket_events.ticket_id');
       $command->where("ticket_events.event_type_id = ".EventType::Event_New);
       $command->andWhere("ticket_events.event_recorded_date between '".DateUtils::getSQLDateStringFromDateStr($this->newTicketsFromDate).
                                                                       "' AND '".DateUtils::getSQLDateStringFromDateStr($this->newTicketsToDate)."'");
        
       if (isset($this->newTicketsDomainID) && $this->newTicketsDomainID >0)
       {
            $command->andWhere("ticket.domain_id = ".$this->newTicketsDomainID);
       }
       
       if (isset($this->newTicketsSubDomainID) && $this->newTicketsSubDomainID >0)
       {
            $command->andWhere("ticket.subdomain_id = ".$this->newTicketsSubDomainID);
       }
       
      
       
       $newEventsData = $command->queryAll(); 
    }
       
    

     
     
}

