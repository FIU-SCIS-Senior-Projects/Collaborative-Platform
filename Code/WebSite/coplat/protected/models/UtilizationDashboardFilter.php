<?php
class DimensionType
{
    const Date =1;
    const Year =2;
    const MonthOfTheYear = 3;  
    const TicketAssignedMentor = 4;
    
    
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
    
     public static function isTimeDimension($dimensionType)
     {
         return  ($dimensionType == DimensionType::Date || $dimensionType == DimensionType::Year || $dimensionType == DimensionType::MonthOfTheYear);
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
    public $assigned_domain_mentor_id;
    public $assigned_project_mentor_id;
    public $assigned_personal_mentor_id;
    public $assigned_project_id;
    public $mentee_id;
    

    public function rules()
    {
        return array(
            array('reportTypeId, dim2ID', 'required'),
            array('reportTypeId, dim2ID, agregatedDomainID, exclusiveDomainID, subdomainID, assigned_domain_mentor_id, assigned_project_mentor_id, assigned_personal_mentor_id, assigned_project_id, mentee_id', 'numerical', 'integerOnly'=>true),
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
                        'dim2ID' => 'By',
                        'assigned_domain_mentor_id' => 'Assigned Domain Mentor',
                        'assigned_project_mentor_id' => 'Assigned Project Mentor',
                        'assigned_personal_mentor_id' => 'Assigned Personal Mentor',
                        'assigned_project_id'=> 'Assigned to Project',
                        'mentee_id'=> 'Mentee');
    }
    
    public function retrieveTicketsCreatedDashboardData()
    {
      //retrieve tha data
      $ticketsCreatedData =  $this->retrieveTicketsCreatedData();
      $chartData = "";
      foreach ($ticketsCreatedData as $data)
      {
          $countPart =  ArrayUtils::getValueOrDefault($data, "EventCount",0);
          
          if ( DimensionType::isTimeDimension($this->dim2ID))
          {
             $currentReadingYear =  ArrayUtils::getValueOrDefault($data, "Year",1);
             $currentReadingMonth = ArrayUtils::getValueOrDefault($data, "Month", 1);
             $currentReadingDay =   ArrayUtils::getValueOrDefault($data, "Day" ,1); 
             $chartData = $chartData.sprintf('[new Date(%s, %s, %s), %s],',
                                                    $currentReadingYear,
                                                    $currentReadingMonth - 1,
                                                    $currentReadingDay,
                                                    $countPart);
              
          }else
          {
              switch ($this->dim2ID)
              {
                  case DimensionType::TicketAssignedMentor:
                      $mentorName =   ArrayUtils::getValueOrDefault($data, "MentorName",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $mentorName,
                                                         $countPart);
                      break;
                  
              }              
          }         
  
       }
       
       //format the data
       $chartFormatedData = "[".$chartData."]" ;// "[[new Date(2015, 2, 1),1],[new Date(2015, 3, 1),1]]";// json_encode($monthData);
       return  $chartFormatedData;   
    }
    
    public function retrieveTicketsClosedDashboardData()
    {
       //retrieve data
      $ticketsClosedData =  $this->retrieveTicketsClosedData();
      $chartData = "";
      foreach ($ticketsClosedData as $data)
      {
          $countPart =  ArrayUtils::getValueOrDefault($data, "EventCount",0);
          
          if  ( DimensionType::isTimeDimension($this->dim2ID))
          {
           $currentReadingYear =  ArrayUtils::getValueOrDefault($data, "Year",1);
           $currentReadingMonth = ArrayUtils::getValueOrDefault($data, "Month", 1);
           $currentReadingDay =   ArrayUtils::getValueOrDefault($data, "Day" ,1); 
           $chartData = $chartData.sprintf('[new Date(%s, %s, %s), %s],',
                                               $currentReadingYear,
                                               $currentReadingMonth - 1,
                                               $currentReadingDay,
                                               $countPart);              
          }else
          {
              switch ($this->dim2ID)
              {
                  case DimensionType::TicketAssignedMentor:
                      $mentorName =   ArrayUtils::getValueOrDefault($data, "MentorName",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $mentorName,
                                                         $countPart);
                      break;
                  
              }              
          } 

       }
       
       //format the data
       $chartFormatedData = "[".$chartData."]" ;// "[[new Date(2015, 2, 1),1],[new Date(2015, 3, 1),1]]";// json_encode($monthData);
       return  $chartFormatedData; 
        
    }
    
    private function retrieveTicketsClosedData()
    {
        
       $command =  Yii::app()->db->createCommand();
      
      
       $command->from("ticket_events");
       $command->join('ticket', 'ticket.id = ticket_events.ticket_id');
       $command->where("ticket_events.event_type_id = ".EventType::Event_Status_Changed);
       $command->where("ticket_events.new_value = 'Close'");
                  
      switch ($this->dim2ID)
       {
         case DimensionType::Date:
               $command->select(array("COUNT(1) AS EventCount, DAY(event_recorded_date) AS Day, MONTH(event_recorded_date) AS Month, YEAR(event_recorded_date)AS Year"));  
               $command->group('DATE(ticket_events.event_recorded_date)');
           
               break;            
           case DimensionType::MonthOfTheYear:
               $command->select(array("COUNT(1) AS EventCount, 1 AS Day ,MONTH(event_recorded_date) AS Month, YEAR(event_recorded_date) AS Year")); 
               $command->group('YEAR(ticket_events.event_recorded_date), MONTH(ticket_events.event_recorded_date)');
             
               break;           
           case DimensionType::Year:
               $command->select(array("COUNT(1) AS EventCount, 1 AS Day, 1 AS Month, YEAR(event_recorded_date) AS Year")); 
               $command->group('YEAR(ticket_events.event_recorded_date)');
              break;
           case DimensionType::TicketAssignedMentor:
                 $command->select(array("COUNT(1) AS EventCount, CONCAT_WS(' ',
                                        `user`.`fname`,
                                        `user`.`mname`,
                                        `user`.`lname`) AS MentorName")); 
                 $command->group('ticket.assign_user_id');
                 $command->join('user', 'user.id = ticket.assign_user_id');
             break;
          
           default:
               throw new CException("Invalid dimension");
       }       
       $this->prepareAllFiltersCommand($command);
       return $command->queryAll(); 
    }
  
    private function retrieveTicketsCreatedData()
    {
      $command =  Yii::app()->db->createCommand();
      
      $command->from("ticket_events");
      $command->join('ticket', 'ticket.id = ticket_events.ticket_id');
      $command->where("ticket_events.event_type_id = ".EventType::Event_New);
                  
      switch ($this->dim2ID)
      {
         case DimensionType::Date:
               $command->select(array("COUNT(1) AS EventCount, DAY(event_recorded_date) AS Day, MONTH(event_recorded_date) AS Month, YEAR(event_recorded_date)AS Year"));  
               $command->group('DATE(ticket_events.event_recorded_date)');
           
               break;            
           case DimensionType::MonthOfTheYear:
               $command->select(array("COUNT(1) AS EventCount, 1 AS Day, MONTH(event_recorded_date) AS Month, YEAR(event_recorded_date) AS Year")); 
               $command->group('YEAR(ticket_events.event_recorded_date), MONTH(ticket_events.event_recorded_date)');
             
               break;           
           case DimensionType::Year:
               $command->select(array("COUNT(1) AS EventCount, 1 AS Day, 1 AS Month ,YEAR(event_recorded_date) AS Year")); 
               $command->group('YEAR(ticket_events.event_recorded_date)');
               break;
           
         case DimensionType::TicketAssignedMentor:
             $command->select(array("COUNT(1) AS EventCount, CONCAT_WS(' ',
                `user`.`fname`,
                `user`.`mname`,
                `user`.`lname`) AS MentorName")); 
             $command->group('ticket.assign_user_id');
             $command->join('user', 'user.id = ticket.assign_user_id');
             
             break;
           default:
               throw new CException("Invalid dimension");
       }
       
       $this->prepareAllFiltersCommand($command);
           
       return $command->queryAll(); 
    }
    
    private function prepareAllFiltersCommand(&$command)
    {
        if ($this->fromDate != "")
       {
           $command->andWhere("ticket_events.event_recorded_date >= '".DateUtils::getSQLDateStringFromDateStr($this->fromDate)."'");
       }
       
       if ($this->toDate != "")
       {
           $command->andWhere("ticket_events.event_recorded_date <= '".DateUtils::getSQLDateStringFromDateStr($this->toDate)."'");
       }
    
       if (isset($this->exclusiveDomainID) && $this->exclusiveDomainID >0)
       {
            $command->andWhere("ticket.subdomain_id IS NULL AND ticket.domain_id = ".$this->exclusiveDomainID);
       }
       
       if (isset($this->agregatedDomainID) && $this->agregatedDomainID >0)
       {
            $command->andWhere("ticket.domain_id = ".$this->agregatedDomainID);
       }
       
       if (isset($this->subdomainID) && $this->subdomainID >0)
       {
            $command->andWhere("ticket.subdomain_id = ".$this->subdomainID);
       }
       
       if (isset($this->assigned_domain_mentor_id) && $this->assigned_domain_mentor_id >0)
       {
           $command->andWhere("ticket.assign_user_id = ".$this->assigned_domain_mentor_id);
       }else if (isset($this->assigned_project_mentor_id) && $this->assigned_project_mentor_id >0)
       {
           $command->andWhere("ticket.assign_user_id = ".$this->assigned_project_mentor_id);
       }else if (isset($this->assigned_personal_mentor_id) && $this->assigned_personal_mentor_id >0)
       {
           $command->andWhere("ticket.assign_user_id = ".$this->assigned_personal_mentor_id);
       }
       
       if (isset($this->mentee_id) && $this->mentee_id > 0 )
       {
          $command->andWhere("ticket.creator_user_id = ".$this->mentee_id); 
       }
        
    }
    

    
}

