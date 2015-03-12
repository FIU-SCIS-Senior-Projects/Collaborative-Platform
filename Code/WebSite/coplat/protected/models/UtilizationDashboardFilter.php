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
                   $dimensionDesc = "day";   
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


class ReportType
{
    const None = 0;
    const TicketsCreated =1;
    const TicketsClosed =2;
        
    public static function getReportTypeDescription($reportType)
    {
       $res = "";
       switch ($reportType)
       {
           case ReportType::TicketsCreated:
                   $res = "Tickets created";   
               break;            
           case ReportType::TicketsClosed:
                   $res = "Tickets closed"; 
               break;           
           default:
               throw new CException("Invalid report type");
       }       
       return $res;
    }
    
    public static function getReportTypes()
    {
             
        
        return  array( ReportType::None => " ",
                       ReportType::TicketsCreated  =>ReportType::getReportTypeDescription(ReportType::TicketsCreated),
                       ReportType::TicketsClosed =>ReportType::getReportTypeDescription( ReportType::TicketsClosed));
        
    }
}

class UtilizationDashboardFilter extends CFormModel
{
    
    public $reportTypeId;
    public $dim2ID;
    public $fromDate;
    public $toDate;
    public $agregatedDomainID;
    public $exclusiveDomainID;
    public $subdomainID;
    

   public function rules()
    {
        return array(
            array('reportTypeId, dim2ID', 'required'),
            array('reportTypeId, dim2ID, agregatedDomainID, exclusiveDomainID, subdomainID', 'numerical', 'integerOnly'=>true),
            array('fromDate, toDate', 'date')                     
        );
    }
    
    public function attributeLabels()
    {
		return array(
			'fromDate' => 'From',
			'toDate' => 'To',
                        'agregatedDomainID' => 'Domain (Aggregated)',
                        'exclusiveDomainID'=>'Domain (Exclusive)',
                        'subdomainID' => 'Sub Domain',			
                        'reportTypeId' => 'Report Type',
                        'dim2ID' => 'By');
    }
    
  /*  public static function initializeFilters()
    {
            $date = new DateTime();
		    date_sub($date, new DateInterval("P1Y"));
            
            //Initialize the filter model
            $ultilizationFilter = new UtilizationDashboardFilter();
            $ultilizationFilter->newTicketsCurrentDimension = DimensionType::MonthOfTheYear;
            $ultilizationFilter->newTicketsToDate = date('m/d/Y');// date("m/d/y");
	    $ultilizationFilter->newTicketsFromDate =  $date->format('m/d/Y');
            
            $ultilizationFilter->closedTicketsCurrentDimension = DimensionType::MonthOfTheYear;
            $ultilizationFilter->closedTicketsToDate = date('m/d/Y');// date("m/d/y");
	    $ultilizationFilter->closedTicketsFromDate =  $date->format('m/d/Y');
            
            
            
            return $ultilizationFilter;
        }*/
        
        
    //New tickets    
    public function retrieveNewTicketsDashboardData()
    {
        //New event data
      $newEventData =  $this->retrieveNewEventsData();
       
      $fromDate = new DateTime($this->newTicketsFromDate);
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
                   $currentReading = $newEventData[$currentIndex]; 
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

        return $newEvents;
    }
        
    private function retrieveNewEventsData()
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
      // echo $command->text;
       
       return $command->queryAll(); 
    }
    //End New tickets  
    
    
    //Closed tickets
    public function retrieveClosedTicketsDashboardData()
    {
        //New event data
      $closedEventData =  $this->retrieveClosedEventsData();
       
      $fromDate = new DateTime($this->closedTicketsFromDate);
      $toDate = new DateTime($this->closedTicketsToDate);
       
       $dateInterval;
       switch ($this->closedTicketsCurrentDimension)
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
       
       if (count($closedEventData)> $currentIndex)
       {
            $currentReading = $closedEventData[0]; 
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
               if (count($closedEventData)> $currentIndex)
               {
                   $currentReading = $closedEventData[$currentIndex]; 
               }else
               {
                   $currentReading = NULL;                   
               }               
            }
            
          }       
                   
          $dateFormated = $dateFormated.sprintf('[new Date(%s, %s, %s), %s],',$year,$month - 1,$day,$countPart);
         
           
          $fromDate->add($dateInterval);
       }
        $closedEvents = "[".$dateFormated."]" ;// "[[new Date(2015, 2, 1),1],[new Date(2015, 3, 1),1]]";// json_encode($monthData);

        return $closedEvents;
    }
      
    private function retrieveClosedEventsData()
    {
      $command =  Yii::app()->db->createCommand();
                  
      switch ($this->closedTicketsCurrentDimension)
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
       //status changed and closed
       $command->where("ticket_events.event_type_id = ".EventType::Event_Status_Changed);
       $command->where("ticket_events.new_value = 'Close'");
       $command->andWhere("ticket_events.event_recorded_date between '".DateUtils::getSQLDateStringFromDateStr($this->closedTicketsFromDate).
                                                                       "' AND '".DateUtils::getSQLDateStringFromDateStr($this->closedTicketsToDate)."'");
        
       if (isset($this->closedTicketsDomainID) && $this->closedTicketsDomainID >0)
       {
            $command->andWhere("ticket.domain_id = ".$this->closedTicketsDomainID);
       }
       
       if (isset($this->closedTicketsSubDomainID) && $this->closedTicketsSubDomainID >0)
       {
            $command->andWhere("ticket.subdomain_id = ".$this->closedTicketsSubDomainID);
       }
      // echo $command->text;
       
       return $command->queryAll(); 
    
    }
    //End Closed tickets

     
     
}

