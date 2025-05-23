<?php
class DimensionType
{
    const Date =1;
    const Year =2;
    const MonthOfTheYear = 3;  
    const TicketAssignedMentor = 4;
	const Mentee = 5;
	const DomainExclusive = 6;
	const DomainAggregated = 7;
	const SubDomain = 8;
	const Project = 9;
    
    
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
    const TicketsAVGDuration = 3;
	const TicketsAVGTimeMentorAnswer = 4;
	const TicketsCurrentlyOpen = 5;
	const TicketsUnanswered = 6;
        
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
           case ReportType::TicketsAVGDuration:
                   $res = "AVG Ticket Duration"; 
               break; 
			   
		   case ReportType::TicketsAVGTimeMentorAnswer:
		           $res = "AVG Time Mentor to answer"; 
		       break;
			   
		   case ReportType::TicketsCurrentlyOpen:
		            $res = "Tickets currently open"; 
		      break;
			  
		    case ReportType::TicketsUnanswered:
			        $res = "Tickets unanswered";
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
                       ReportType::TicketsClosed =>ReportType::getReportTypeDescription( ReportType::TicketsClosed),
                       ReportType::TicketsAVGDuration =>ReportType::getReportTypeDescription( ReportType::TicketsAVGDuration),
                       ReportType::TicketsAVGTimeMentorAnswer => ReportType::getReportTypeDescription(ReportType::TicketsAVGTimeMentorAnswer),
					   ReportType::TicketsCurrentlyOpen =>  ReportType::getReportTypeDescription(ReportType::TicketsCurrentlyOpen),
					   ReportType::TicketsUnanswered => ReportType::getReportTypeDescription(ReportType::TicketsUnanswered)   );
        
    }
}

class ReportFormat
{	
	const chart =1;
    const rawData =2;
	
	public static function getReportFormats()
    {
     return  array(ReportFormat::chart  =>ReportFormat::getFormatDescriptionByFormatID(ReportFormat::chart),
                   ReportFormat::rawData  =>ReportFormat::getFormatDescriptionByFormatID(ReportFormat::rawData));
    }
	
	
	public static function getFormatDescriptionByFormatID($formatId)
	{
		
	   $res = "";
       switch ($formatId)
       {
           case ReportFormat::chart:
                   $res = "Chart";   
               break;            
           case ReportFormat::rawData:
                   $res = "Details"; 
               break;   
           default:
               throw new CException("Invalid report format");
       }       
       return $res;
		
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
	public $reportFormatId;
    

    public function rules()
    {
        return array(
            array('reportTypeId, dim2ID, reportFormatId', 'required'),
            array('reportTypeId, dim2ID, agregatedDomainID, exclusiveDomainID, subdomainID, assigned_domain_mentor_id, assigned_project_mentor_id, assigned_personal_mentor_id, assigned_project_id, mentee_id, reportFormatId', 'numerical', 'integerOnly'=>true),
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
                        'mentee_id'=> 'Mentee',
						'reportFormatId' => 'Report Format');
    }
    
	///////////////////////////////////Data formatting//////////////////////////////////////////////////
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
					  
				   case DimensionType::Mentee:
				      $menteeName =   ArrayUtils::getValueOrDefault($data, "MenteeName",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $menteeName,
                                                         $countPart);
                      break;
				   case DimensionType::DomainExclusive:
				      $domainExclusive =  ArrayUtils::getValueOrDefault($data, "Domain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $domainExclusive,
                                                         $countPart);
					  break;
				   case DimensionType::DomainAggregated:
				      $domainAggregated =  ArrayUtils::getValueOrDefault($data, "Domain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $domainAggregated,
                                                         $countPart);
					  break;
					case DimensionType::SubDomain:
				      $subDomain =  ArrayUtils::getValueOrDefault($data, "SubDomain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $subDomain,
                                                         $countPart);
					  break;
					case DimensionType::Project:
				      $project =  ArrayUtils::getValueOrDefault($data, "Project",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $project,
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
			 
			       case DimensionType::Mentee:
				      $menteeName =   ArrayUtils::getValueOrDefault($data, "MenteeName",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $menteeName,
                                                         $countPart);
                      break;
					  
				   case DimensionType::DomainExclusive:
				      $domain =   ArrayUtils::getValueOrDefault($data, "Domain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $domain,
                                                         $countPart);
                      break;
				   case DimensionType::DomainAggregated:
				      $domainAggregated =  ArrayUtils::getValueOrDefault($data, "Domain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $domainAggregated,
                                                         $countPart);
					  break;
				   case DimensionType::SubDomain:
				      $subDomain =  ArrayUtils::getValueOrDefault($data, "SubDomain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $subDomain,
                                                         $countPart);
					  break;
				    case DimensionType::Project:
				      $project =  ArrayUtils::getValueOrDefault($data, "Project",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $project,
                                                         $countPart);
					  break;
                  
              }              
          } 

       }
       
       //format the data
       $chartFormatedData = "[".$chartData."]" ;// "[[new Date(2015, 2, 1),1],[new Date(2015, 3, 1),1]]";// json_encode($monthData);
       return  $chartFormatedData; 
        
    }
    
    public function retrieveAVGTicketDurationDashboardData()
    {
        
      $ticketsAVGLifeSpanData =  $this->retrieveAVGTicketDurationData();
      $chartData = "";
      foreach ($ticketsAVGLifeSpanData as $data)
      {
          $countPart =  ArrayUtils::getValueOrDefault($data, "HourLifeSpan",0);
          
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
			 
			       case DimensionType::Mentee:
				      $menteeName =   ArrayUtils::getValueOrDefault($data, "MenteeName",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $menteeName,
                                                         $countPart);
                      break;
					  
				   case DimensionType::DomainExclusive:
				      $domain =   ArrayUtils::getValueOrDefault($data, "Domain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $domain,
                                                         $countPart);
                      break;
				   case DimensionType::DomainAggregated:
				      $domainAggregated =  ArrayUtils::getValueOrDefault($data, "Domain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $domainAggregated,
                                                         $countPart);
					  break;
				   case DimensionType::SubDomain:
				      $subDomain =  ArrayUtils::getValueOrDefault($data, "SubDomain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $subDomain,
                                                         $countPart);
					  break;
				    case DimensionType::Project:
				      $project =  ArrayUtils::getValueOrDefault($data, "Project",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $project,
                                                         $countPart);
					  break;
                  
              }              
          } 

       }
       
       //format the data
       $chartFormatedData = "[".$chartData."]" ;// "[[new Date(2015, 2, 1),1],[new Date(2015, 3, 1),1]]";// json_encode($monthData);
       return  $chartFormatedData; 
        
    }

	public function retrieveAVGTimeMentorAnswerDashboardData()
	{
	
	  $ticketsAVGTimeMentorAnswerData =  $this->retrieveAVGTimeMentorAnswerData();
      $chartData = "";
      foreach ($ticketsAVGTimeMentorAnswerData as $data)
      {
          $countPart =  ArrayUtils::getValueOrDefault($data, "HourAnswered",0);
          
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
			 
			       case DimensionType::Mentee:
				      $menteeName =   ArrayUtils::getValueOrDefault($data, "MenteeName",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $menteeName,
                                                         $countPart);
                      break;
					  
				   case DimensionType::DomainExclusive:
				      $domain =   ArrayUtils::getValueOrDefault($data, "Domain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $domain,
                                                         $countPart);
                      break;
				   case DimensionType::DomainAggregated:
				      $domainAggregated =  ArrayUtils::getValueOrDefault($data, "Domain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $domainAggregated,
                                                         $countPart);
					  break;
				   case DimensionType::SubDomain:
				      $subDomain =  ArrayUtils::getValueOrDefault($data, "SubDomain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $subDomain,
                                                         $countPart);
					  break;
				    case DimensionType::Project:
				      $project =  ArrayUtils::getValueOrDefault($data, "Project",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $project,
                                                         $countPart);
					  break;
                  
              }              
          } 

       }
       
       //format the data
       $chartFormatedData = "[".$chartData."]" ;// "[[new Date(2015, 2, 1),1],[new Date(2015, 3, 1),1]]";// json_encode($monthData);
       return  $chartFormatedData; 
     }
	
	public function retrieveTicketsCurrentlyOpenedDashboardData()
	{
		
	  //retrieve tha data
      $ticketsCreatedData =  $this->retrieveTicketsCurrentlyOpenedData();
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
					  
				   case DimensionType::Mentee:
				      $menteeName =   ArrayUtils::getValueOrDefault($data, "MenteeName",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $menteeName,
                                                         $countPart);
                      break;
				   case DimensionType::DomainExclusive:
				      $domainExclusive =  ArrayUtils::getValueOrDefault($data, "Domain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $domainExclusive,
                                                         $countPart);
					  break;
				   case DimensionType::DomainAggregated:
				      $domainAggregated =  ArrayUtils::getValueOrDefault($data, "Domain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $domainAggregated,
                                                         $countPart);
					  break;
					case DimensionType::SubDomain:
				      $subDomain =  ArrayUtils::getValueOrDefault($data, "SubDomain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $subDomain,
                                                         $countPart);
					  break;
					case DimensionType::Project:
				      $project =  ArrayUtils::getValueOrDefault($data, "Project",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $project,
                                                         $countPart);
					  break;
				   
              }              
          }         
  
       }
       
       //format the data
       $chartFormatedData = "[".$chartData."]" ;// "[[new Date(2015, 2, 1),1],[new Date(2015, 3, 1),1]]";// json_encode($monthData);
       return  $chartFormatedData;   
		
	}
	
	public function retrieveUnansweredTicketsDashboardData()
	{
		
		//retrieve tha data
      $ticketsCreatedData =  $this->retrieveUnansweredTicketsData();
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
					  
				   case DimensionType::Mentee:
				      $menteeName =   ArrayUtils::getValueOrDefault($data, "MenteeName",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $menteeName,
                                                         $countPart);
                      break;
				   case DimensionType::DomainExclusive:
				      $domainExclusive =  ArrayUtils::getValueOrDefault($data, "Domain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $domainExclusive,
                                                         $countPart);
					  break;
				   case DimensionType::DomainAggregated:
				      $domainAggregated =  ArrayUtils::getValueOrDefault($data, "Domain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $domainAggregated,
                                                         $countPart);
					  break;
					case DimensionType::SubDomain:
				      $subDomain =  ArrayUtils::getValueOrDefault($data, "SubDomain",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $subDomain,
                                                         $countPart);
					  break;
					case DimensionType::Project:
				      $project =  ArrayUtils::getValueOrDefault($data, "Project",0);
                      $chartData = $chartData.sprintf("['%s', %s],",
                                                         $project,
                                                         $countPart);
					  break;
				   
              }              
          }         
  
       }
       
       //format the data
       $chartFormatedData = "[".$chartData."]" ;// "[[new Date(2015, 2, 1),1],[new Date(2015, 3, 1),1]]";// json_encode($monthData);
       return  $chartFormatedData;   
		
		
	}
	
	////////////////////////////////////Data retrieval////////////////////////////////////////////////
    private function retrieveAVGTicketDurationData()
    {
        //closed query
        //this query return all the closed tickets...
        //all the filters mus be applied to this section
        $closedTicketsQuery =  Yii::app()->db->createCommand();
        $closedTicketsQuery->select("ticket_events.ticket_id, MAX(ticket_events.event_recorded_date) AS ClosedDate");
        $closedTicketsQuery->from("ticket_events");
        $closedTicketsQuery->join("ticket","ticket.id = ticket_events.ticket_id" );
        $closedTicketsQuery->where("ticket.status = 'Close'");
        $closedTicketsQuery->andWhere("ticket_events.event_type_id = ".EventType::Event_Status_Changed);
        $closedTicketsQuery->andWhere("ticket_events.new_value = 'Close'");
        $closedTicketsQuery->group("ticket_events.ticket_id");
        
        //at this point put all the filters so the tickets can be reduced according to the filter and for query optimization
        $this->prepareAllFiltersCommand($closedTicketsQuery);
        
        

        $ticketDurationQuery =  Yii::app()->db->createCommand();
        $ticketDurationQuery->select(array("ticket_events.ticket_id", 
                                           "MIN(ticket_events.event_recorded_date) AS OpenedDate",
                                           "closedTicketInfo.ClosedDate",
                                           "TIMESTAMPDIFF(HOUR, MIN(ticket_events.event_recorded_date), closedTicketInfo.ClosedDate) AS HourLifeSpan" ));  
        $ticketDurationQuery->from("ticket_events");
        $ticketDurationQuery->join("(".$closedTicketsQuery->text.") closedTicketInfo ", "closedTicketInfo.ticket_id = ticket_events.ticket_id ");
        $ticketDurationQuery->Where("ticket_events.event_type_id = ".EventType::Event_New); 
        $ticketDurationQuery->group("ticket_events.ticket_id");
        
        $command =  Yii::app()->db->createCommand();   
        
        $command->from("(".$ticketDurationQuery->text.") p ");
        $command->join("ticket", "p.ticket_id = ticket.id");
        
        
        switch ($this->dim2ID)
        {
           case DimensionType::Date:
               $command->select(array("AVG(HourLifeSpan) AS HourLifeSpan, DAY(OpenedDate) AS Day, MONTH(OpenedDate) AS Month, YEAR(OpenedDate)AS Year"));  
               $command->group('DATE(OpenedDate)');
           
               break;            
           case DimensionType::MonthOfTheYear:
               $command->select(array("AVG(HourLifeSpan) AS HourLifeSpan, 1 AS Day ,MONTH(OpenedDate) AS Month, YEAR(OpenedDate) AS Year")); 
               $command->group('YEAR(OpenedDate), MONTH(OpenedDate)');
             
               break;           
           case DimensionType::Year:
               $command->select(array("AVG(HourLifeSpan) AS HourLifeSpan, 1 AS Day, 1 AS Month, YEAR(OpenedDate) AS Year")); 
               $command->group('YEAR(OpenedDate)');
              break;
           case DimensionType::TicketAssignedMentor:
                 $command->select(array("AVG(HourLifeSpan) AS HourLifeSpan, CONCAT_WS(' ',
                                        `user`.`fname`,
                                        `user`.`mname`,
                                        `user`.`lname`) AS MentorName")); 
                 $command->group('ticket.assign_user_id');
                 $command->join('user', 'user.id = ticket.assign_user_id');
             break;
		    case DimensionType::Mentee:
                     $command->select(array("AVG(HourLifeSpan) AS HourLifeSpan, CONCAT_WS(' ',
                                        `user`.`fname`,
                                        `user`.`mname`,
                                        `user`.`lname`) AS MenteeName")); 
                    $command->group('ticket.creator_user_id');
                    $command->join('user', 'user.id = ticket.creator_user_id');			
		      break;
		 case DimensionType::DomainExclusive:
			     $command->select(array("AVG(HourLifeSpan) AS HourLifeSpan, domain.name AS Domain")); 
                            $command->group('ticket.domain_id');
                            $command->join('domain', 'ticket.domain_id = domain.id');
                            $command->andWhere("ticket.domain_id IS NOT NULL");
                            $command->andWhere("ticket.subdomain_id IS NULL");
			  break;
			  case DimensionType::DomainAggregated:
			     $command->select(array("AVG(HourLifeSpan) AS HourLifeSpan, domain.name AS Domain")); 
                 $command->group('ticket.domain_id');
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
			  break;
			  case DimensionType::SubDomain:
			     $command->select(array("AVG(HourLifeSpan) AS HourLifeSpan, subdomain.name AS SubDomain")); 
                 $command->group('ticket.subdomain_id');
                 $command->join('subdomain', 'ticket.subdomain_id = subdomain.id');
				 $command->andWhere("ticket.subdomain_id IS NOT NULL");
			  break;
			  case DimensionType::Project:
			     $command->select(array("AVG(HourLifeSpan) AS HourLifeSpan, project.title AS Project")); 
                 $command->group('ticket.assigned_project_id');
                 $command->join('project', 'ticket.assigned_project_id = project.id');
				 $command->andWhere("ticket.assigned_project_id IS NOT NULL");
			    break;
			  
			  
           default:
               throw new CException("Invalid dimension");
         }
         
        // echo $command->text;
        
        return $command->queryAll(); 
        
    }
	
	private function retrieveAVGTimeMentorAnswerData()
    {
      
        //all the filters mus be applied to this section
        $answeredTicketsQuery =  Yii::app()->db->createCommand();
        $answeredTicketsQuery->select("ticket_events.ticket_id, MIN(ticket_events.event_recorded_date) AS FirstAnswered");
        $answeredTicketsQuery->from("ticket_events");
        $answeredTicketsQuery->join("ticket","ticket.id = ticket_events.ticket_id" );
        $answeredTicketsQuery->andWhere("ticket_events.event_type_id = ".EventType::Event_Commented_By_Mentor);
        $answeredTicketsQuery->group("ticket_events.ticket_id");
        
        //at this point put all the filters so the tickets can be reduced according to the filter and for query optimization
        $this->prepareAllFiltersCommand($answeredTicketsQuery);
        
        

        $ticketDurationQuery =  Yii::app()->db->createCommand();
        $ticketDurationQuery->select(array("ticket_events.ticket_id", 
                                           "MIN(ticket_events.event_recorded_date) AS OpenedDate",
                                           "answerdTicketInfo.FirstAnswered",
                                           "TIMESTAMPDIFF(HOUR, MIN(ticket_events.event_recorded_date), answerdTicketInfo.FirstAnswered) AS HourAnswered" ));  
        $ticketDurationQuery->from("ticket_events");
        $ticketDurationQuery->join("(".$answeredTicketsQuery->text.") answerdTicketInfo ", "answerdTicketInfo.ticket_id = ticket_events.ticket_id ");
        $ticketDurationQuery->Where("ticket_events.event_type_id = ".EventType::Event_New); 
        $ticketDurationQuery->group("ticket_events.ticket_id");
        
        $command =  Yii::app()->db->createCommand();   
        
        $command->from("(".$ticketDurationQuery->text.") p ");
        $command->join("ticket", "p.ticket_id = ticket.id");
        
        
        switch ($this->dim2ID)
        {
           case DimensionType::Date:
               $command->select(array("AVG(HourAnswered) AS HourAnswered, DAY(OpenedDate) AS Day, MONTH(OpenedDate) AS Month, YEAR(OpenedDate)AS Year"));  
               $command->group('DATE(OpenedDate)');
           
               break;            
           case DimensionType::MonthOfTheYear:
               $command->select(array("AVG(HourAnswered) AS HourAnswered, 1 AS Day ,MONTH(OpenedDate) AS Month, YEAR(OpenedDate) AS Year")); 
               $command->group('YEAR(OpenedDate), MONTH(OpenedDate)');
             
               break;           
           case DimensionType::Year:
               $command->select(array("AVG(HourAnswered) AS HourAnswered, 1 AS Day, 1 AS Month, YEAR(OpenedDate) AS Year")); 
               $command->group('YEAR(OpenedDate)');
              break;
           case DimensionType::TicketAssignedMentor:
                 $command->select(array("AVG(HourAnswered) AS HourAnswered, CONCAT_WS(' ',
                                        `user`.`fname`,
                                        `user`.`mname`,
                                        `user`.`lname`) AS MentorName")); 
                 $command->group('ticket.assign_user_id');
                 $command->join('user', 'user.id = ticket.assign_user_id');
             break;
		    case DimensionType::Mentee:
                     $command->select(array("AVG(HourAnswered) AS HourAnswered, CONCAT_WS(' ',
                                        `user`.`fname`,
                                        `user`.`mname`,
                                        `user`.`lname`) AS MenteeName")); 
                    $command->group('ticket.creator_user_id');
                    $command->join('user', 'user.id = ticket.creator_user_id');			
		      break;
		 case DimensionType::DomainExclusive:
			     $command->select(array("AVG(HourAnswered) AS HourAnswered, domain.name AS Domain")); 
                            $command->group('ticket.domain_id');
                            $command->join('domain', 'ticket.domain_id = domain.id');
                            $command->andWhere("ticket.domain_id IS NOT NULL");
                            $command->andWhere("ticket.subdomain_id IS NULL");
			  break;
			  case DimensionType::DomainAggregated:
			     $command->select(array("AVG(HourAnswered) AS HourAnswered, domain.name AS Domain")); 
                 $command->group('ticket.domain_id');
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
			  break;
			  case DimensionType::SubDomain:
			     $command->select(array("AVG(HourAnswered) AS HourAnswered, subdomain.name AS SubDomain")); 
                 $command->group('ticket.subdomain_id');
                 $command->join('subdomain', 'ticket.subdomain_id = subdomain.id');
				 $command->andWhere("ticket.subdomain_id IS NOT NULL");
			  break;
			  case DimensionType::Project:
			     $command->select(array("AVG(HourAnswered) AS HourAnswered, project.title AS Project")); 
                 $command->group('ticket.assigned_project_id');
                 $command->join('project', 'ticket.assigned_project_id = project.id');
				 $command->andWhere("ticket.assigned_project_id IS NOT NULL");
			    break;
			  
			  
           default:
               throw new CException("Invalid dimension");
         }
         
        // echo $command->text;
        
        return $command->queryAll(); 
        
    }
	
    private function retrieveTicketsClosedData()
    {
        
       $command =  Yii::app()->db->createCommand();
      
      
       $command->from("ticket_events");
       $command->join('ticket', 'ticket.id = ticket_events.ticket_id');
       $command->where("ticket_events.event_type_id = ".EventType::Event_Status_Changed);
       $command->andWhere("ticket_events.new_value = 'Close'");
                  
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
		    case DimensionType::Mentee:
                $command->select(array("COUNT(1) AS EventCount, CONCAT_WS(' ',
                                        `user`.`fname`,
                                        `user`.`mname`,
                                        `user`.`lname`) AS MenteeName")); 
                 $command->group('ticket.creator_user_id');
                 $command->join('user', 'user.id = ticket.creator_user_id');			
		      break;
			 case DimensionType::DomainExclusive:
			     $command->select(array("COUNT(1) AS EventCount, domain.name AS Domain")); 
                 $command->group('ticket.domain_id');
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
				 $command->andWhere("ticket.subdomain_id IS NULL");
			  break;
			  case DimensionType::DomainAggregated:
			     $command->select(array("COUNT(1) AS EventCount, domain.name AS Domain")); 
                 $command->group('ticket.domain_id');
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
			  break;
			  case DimensionType::SubDomain:
			     $command->select(array("COUNT(1) AS EventCount, subdomain.name AS SubDomain")); 
                 $command->group('ticket.subdomain_id');
                 $command->join('subdomain', 'ticket.subdomain_id = subdomain.id');
				 $command->andWhere("ticket.subdomain_id IS NOT NULL");
			  break;
			  case DimensionType::Project:
			     $command->select(array("COUNT(1) AS EventCount, project.title AS Project")); 
                 $command->group('ticket.assigned_project_id');
                 $command->join('project', 'ticket.assigned_project_id = project.id');
				 $command->andWhere("ticket.assigned_project_id IS NOT NULL");
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
		 case DimensionType::Mentee;
                $command->select(array("COUNT(1) AS EventCount, CONCAT_WS(' ',
                                        `user`.`fname`,
                                        `user`.`mname`,
                                        `user`.`lname`) AS MenteeName")); 
                 $command->group('ticket.creator_user_id');
                 $command->join('user', 'user.id = ticket.creator_user_id');		 
			  break; 
		  case DimensionType::DomainExclusive:
			     $command->select(array("COUNT(1) AS EventCount, domain.name AS Domain")); 
                 $command->group('ticket.domain_id');
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
				 $command->andWhere("ticket.subdomain_id IS NULL");
			  break;
		  case DimensionType::DomainAggregated:
			     $command->select(array("COUNT(1) AS EventCount, domain.name AS Domain")); 
                 $command->group('ticket.domain_id');
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
			  break;
	       case DimensionType::SubDomain:
			     $command->select(array("COUNT(1) AS EventCount, subdomain.name AS SubDomain")); 
                 $command->group('ticket.subdomain_id');
                 $command->join('subdomain', 'ticket.subdomain_id = subdomain.id');
				 $command->andWhere("ticket.subdomain_id IS NOT NULL");
			  break;
		    case DimensionType::Project:
			     $command->select(array("COUNT(1) AS EventCount, project.title AS Project")); 
                 $command->group('ticket.assigned_project_id');
                 $command->join('project', 'ticket.assigned_project_id = project.id');
				 $command->andWhere("ticket.assigned_project_id IS NOT NULL");
			    break;
           default:
               throw new CException("Invalid dimension");
       }
       
       $this->prepareAllFiltersCommand($command);
           
       return $command->queryAll(); 
    }
    
	private function retrieveTicketsCurrentlyOpenedData()
	{
	  $command =  Yii::app()->db->createCommand();
      
      $command->from("ticket_events");
      $command->join('ticket', 'ticket.id = ticket_events.ticket_id');
      $command->where("ticket_events.event_type_id = ".EventType::Event_New);
	  $command->andWhere("ticket.status = 'Pending'");
                  
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
		 case DimensionType::Mentee;
                $command->select(array("COUNT(1) AS EventCount, CONCAT_WS(' ',
                                        `user`.`fname`,
                                        `user`.`mname`,
                                        `user`.`lname`) AS MenteeName")); 
                 $command->group('ticket.creator_user_id');
                 $command->join('user', 'user.id = ticket.creator_user_id');		 
			  break; 
		  case DimensionType::DomainExclusive:
			     $command->select(array("COUNT(1) AS EventCount, domain.name AS Domain")); 
                 $command->group('ticket.domain_id');
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
				 $command->andWhere("ticket.subdomain_id IS NULL");
			  break;
		  case DimensionType::DomainAggregated:
			     $command->select(array("COUNT(1) AS EventCount, domain.name AS Domain")); 
                 $command->group('ticket.domain_id');
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
			  break;
	       case DimensionType::SubDomain:
			     $command->select(array("COUNT(1) AS EventCount, subdomain.name AS SubDomain")); 
                 $command->group('ticket.subdomain_id');
                 $command->join('subdomain', 'ticket.subdomain_id = subdomain.id');
				 $command->andWhere("ticket.subdomain_id IS NOT NULL");
			  break;
		    case DimensionType::Project:
			     $command->select(array("COUNT(1) AS EventCount, project.title AS Project")); 
                 $command->group('ticket.assigned_project_id');
                 $command->join('project', 'ticket.assigned_project_id = project.id');
				 $command->andWhere("ticket.assigned_project_id IS NOT NULL");
			    break;
           default:
               throw new CException("Invalid dimension");
       }
       
       $this->prepareAllFiltersCommand($command);
           
       return $command->queryAll(); 		
	}
	
	private function retrieveUnansweredTicketsData()
	{
	  $command =  Yii::app()->db->createCommand();
          

          $command->from("ticket");
          $command->join('ticket_events', 'ticket.id = ticket_events.ticket_id');
          $command->leftJoin("ticket_events comented","ticket.id = comented.ticket_id AND comented.event_type_id = ".EventType::Event_Commented_By_Mentor);
          $command->where("comented.ticket_id IS NULL");
          $command->andWhere("ticket_events.event_type_id = ".EventType::Event_New);
          $command->andWhere("ticket.status = 'Pending'");

                  
      switch ($this->dim2ID)
      {
           case DimensionType::Date:
               $command->select(array("COUNT(1) AS EventCount, DAY(ticket_events.event_recorded_date) AS Day, MONTH(ticket_events.event_recorded_date) AS Month, YEAR(ticket_events.event_recorded_date)AS Year"));  
               $command->group('DATE(ticket_events.event_recorded_date)');
           
               break;            
           case DimensionType::MonthOfTheYear:
               $command->select(array("COUNT(1) AS EventCount, 1 AS Day, MONTH(ticket_events.event_recorded_date) AS Month, YEAR(ticket_events.event_recorded_date) AS Year")); 
               $command->group('YEAR(ticket_events.event_recorded_date), MONTH(ticket_events.event_recorded_date)');
             
               break;           
           case DimensionType::Year:
               $command->select(array("COUNT(1) AS EventCount, 1 AS Day, 1 AS Month ,YEAR(ticket_events.event_recorded_date) AS Year")); 
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
		 case DimensionType::Mentee;
                $command->select(array("COUNT(1) AS EventCount, CONCAT_WS(' ',
                                        `user`.`fname`,
                                        `user`.`mname`,
                                        `user`.`lname`) AS MenteeName")); 
                 $command->group('ticket.creator_user_id');
                 $command->join('user', 'user.id = ticket.creator_user_id');		 
			  break; 
		  case DimensionType::DomainExclusive:
			     $command->select(array("COUNT(1) AS EventCount, domain.name AS Domain")); 
                 $command->group('ticket.domain_id');
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
				 $command->andWhere("ticket.subdomain_id IS NULL");
			  break;
		  case DimensionType::DomainAggregated:
			     $command->select(array("COUNT(1) AS EventCount, domain.name AS Domain")); 
                 $command->group('ticket.domain_id');
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
			  break;
	       case DimensionType::SubDomain:
			     $command->select(array("COUNT(1) AS EventCount, subdomain.name AS SubDomain")); 
                 $command->group('ticket.subdomain_id');
                 $command->join('subdomain', 'ticket.subdomain_id = subdomain.id');
				 $command->andWhere("ticket.subdomain_id IS NOT NULL");
			  break;
		    case DimensionType::Project:
			     $command->select(array("COUNT(1) AS EventCount, project.title AS Project")); 
                 $command->group('ticket.assigned_project_id');
                 $command->join('project', 'ticket.assigned_project_id = project.id');
				 $command->andWhere("ticket.assigned_project_id IS NOT NULL");
			    break;
           default:
               throw new CException("Invalid dimension");
       }
       
       $this->prepareAllFiltersCommand($command);
      // echo $command->text;
           
       return $command->queryAll(); 		
	}
	
	//////////////////////////////////////////////Utilization Raw Data//////////////////////////////////
	public function retrieveTicketsCreatedDetailsData()
    {
      $command =  Yii::app()->db->createCommand();
      
      $command->from("ticket_events");
      $command->join('ticket', 'ticket.id = ticket_events.ticket_id');
	  $command->join('report_ticket rt', 'ticket.id = rt.ticketID');
      $command->where("ticket_events.event_type_id = ".EventType::Event_New);
                  
      switch ($this->dim2ID)
      {
           case DimensionType::Date:
               $command->select(array("DAY(event_recorded_date) AS Day, MONTH(event_recorded_date) AS Month, YEAR(event_recorded_date)AS Year, 
			                           rt.ticketID AS id,  rt.* "));  
               break;            
           case DimensionType::MonthOfTheYear:
               $command->select(array("MONTH(event_recorded_date) AS Month, YEAR(event_recorded_date) AS Year,
			                           rt.ticketID AS id,  rt.*")); 
               break;           
           case DimensionType::Year:
               $command->select(array("YEAR(event_recorded_date) AS Year,
			                           rt.ticketID AS id,  rt.*")); 
               break;
           
         case DimensionType::TicketAssignedMentor:
             $command->select(array("CONCAT_WS(' ',
                `user`.`fname`,
                `user`.`mname`,
                `user`.`lname`) AS MentorName,
				rt.ticketID AS id,  rt.* ")); 
             $command->join('user', 'user.id = ticket.assign_user_id');             
             break;
		 case DimensionType::Mentee;
                $command->select(array("CONCAT_WS(' ',
                                        `user`.`fname`,
                                        `user`.`mname`,
                                        `user`.`lname`) AS MenteeName,
										 rt.ticketID AS id,  rt.*")); 
                 $command->join('user', 'user.id = ticket.creator_user_id');		 
			  break; 
		  case DimensionType::DomainExclusive:
			     $command->select(array("domain.name AS Domain",
				                        "rt.ticketID AS id",
				                        "rt.*",)); 
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
				 $command->andWhere("ticket.subdomain_id IS NULL");
			  break;
		  case DimensionType::DomainAggregated:
			     $command->select(array("domain.name AS Domain",
				                        "rt.ticketID AS id", 
                                        "rt.*")); 
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
			  break;
	       case DimensionType::SubDomain:
			     $command->select(array("subdomain.name AS SubDomain",
				                        "rt.ticketID AS id",
                                        "rt.*")); 
                 $command->join('subdomain', 'ticket.subdomain_id = subdomain.id');
				 $command->andWhere("ticket.subdomain_id IS NOT NULL");
			  break;
		    case DimensionType::Project:
			     $command->select(array("project.title AS Project",
				                        "rt.ticketID AS id",
                                        "rt.*")); 
                 $command->join('project', 'ticket.assigned_project_id = project.id');
				 $command->andWhere("ticket.assigned_project_id IS NOT NULL");
			    break;
           default:
               throw new CException("Invalid dimension");
       }
       
       $this->prepareAllFiltersCommand($command);
		
        return $command->queryAll(); 
	  // return array();
    }
    
	public function retrieveTicketsClosedDetailsData()
	{
	   $command =  Yii::app()->db->createCommand();
     
	   $command->select(array("rt.ticketID AS id", "rt.*"));  
       $command->from("ticket_events");
       $command->join('ticket', 'ticket.id = ticket_events.ticket_id');
	   $command->join('report_ticket rt', 'ticket.id = rt.ticketID');
       $command->where("ticket_events.event_type_id = ".EventType::Event_Status_Changed);
       $command->andWhere("ticket_events.new_value = 'Close'");
	   
	  
                  
      switch ($this->dim2ID)
       {
         case DimensionType::Date:
          
               break;            
           case DimensionType::MonthOfTheYear:
             
               break;           
           case DimensionType::Year:
              break;
           case DimensionType::TicketAssignedMentor:
                 $command->join('user', 'user.id = ticket.assign_user_id');
             break;
		    case DimensionType::Mentee:
                 $command->join('user', 'user.id = ticket.creator_user_id');			
		      break;
			 case DimensionType::DomainExclusive:
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
				 $command->andWhere("ticket.subdomain_id IS NULL");
			  break;
			  case DimensionType::DomainAggregated:
                 $command->join('domain', 'ticket.domain_id = domain.id');
				 $command->andWhere("ticket.domain_id IS NOT NULL");
			  break;
			  case DimensionType::SubDomain:
                 $command->join('subdomain', 'ticket.subdomain_id = subdomain.id');
				 $command->andWhere("ticket.subdomain_id IS NOT NULL");
			  break;
			  case DimensionType::Project:
                 $command->join('project', 'ticket.assigned_project_id = project.id');
				 $command->andWhere("ticket.assigned_project_id IS NOT NULL");
			    break;
			  
			  
           default:
               throw new CException("Invalid dimension");
       }       
       $this->prepareAllFiltersCommand($command);
       return $command->queryAll(); 	
 
	}
	
	
	public function retrieveTicketDurationDetailsData()
	{
		//closed query
        //this query return all the closed tickets...
        //all the filters mus be applied to this section
        $closedTicketsQuery =  Yii::app()->db->createCommand();
        $closedTicketsQuery->select("ticket_events.ticket_id, MAX(ticket_events.event_recorded_date) AS ClosedDate");
        $closedTicketsQuery->from("ticket_events");
        $closedTicketsQuery->join("ticket","ticket.id = ticket_events.ticket_id" );
        $closedTicketsQuery->where("ticket.status = 'Close'");
        $closedTicketsQuery->andWhere("ticket_events.event_type_id = ".EventType::Event_Status_Changed);
        $closedTicketsQuery->andWhere("ticket_events.new_value = 'Close'");
        $closedTicketsQuery->group("ticket_events.ticket_id");
        
        //at this point put all the filters to the tickets can be reduced according to the filter and for query optimization
        $this->prepareAllFiltersCommand($closedTicketsQuery);
        
        

        $ticketDurationQuery =  Yii::app()->db->createCommand();
        $ticketDurationQuery->select(array("ticket_events.ticket_id", 
                                           "MIN(ticket_events.event_recorded_date) AS OpenedDate",
                                           "closedTicketInfo.ClosedDate",
                                           "TIMESTAMPDIFF(HOUR, MIN(ticket_events.event_recorded_date), closedTicketInfo.ClosedDate) AS HourLifeSpan" ));  
        $ticketDurationQuery->from("ticket_events");
        $ticketDurationQuery->join("(".$closedTicketsQuery->text.") closedTicketInfo ", "closedTicketInfo.ticket_id = ticket_events.ticket_id ");
        $ticketDurationQuery->Where("ticket_events.event_type_id = ".EventType::Event_New); 
        $ticketDurationQuery->group("ticket_events.ticket_id");
        
        $command =  Yii::app()->db->createCommand();   
        
		$command->select(array("rt.ticketID AS id", "rt.*","p.HourLifeSpan"));  
        $command->from("(".$ticketDurationQuery->text.") p ");
		$command->join("ticket", "p.ticket_id = ticket.id");
		$command->join('report_ticket rt', 'ticket.id = rt.ticketID');
        
        
        switch ($this->dim2ID)
        {
           case DimensionType::Date:
                      
               break;            
           case DimensionType::MonthOfTheYear:
                      
               break;           
           case DimensionType::Year:
                          break;
           case DimensionType::TicketAssignedMentor:
                    break;
		    case DimensionType::Mentee:
                   		
		      break;
		 case DimensionType::DomainExclusive:
                  $command->andWhere("ticket.domain_id IS NOT NULL");
                  $command->andWhere("ticket.subdomain_id IS NULL");
			  break;
			  case DimensionType::DomainAggregated:
			    $command->andWhere("ticket.domain_id IS NOT NULL");
			  break;
			  case DimensionType::SubDomain:
			    $command->andWhere("ticket.subdomain_id IS NOT NULL");
			  break;
			  case DimensionType::Project:
			    $command->andWhere("ticket.assigned_project_id IS NOT NULL");
			    break;
           default:
               throw new CException("Invalid dimension");
         }
         
        // echo $command->text;
        
        return $command->queryAll(); 		
	}
	
	
	public function retrieveTimeMentorAnswerDetailsData()
	{
		 //all the filters mus be applied to this section
        $answeredTicketsQuery =  Yii::app()->db->createCommand();
        $answeredTicketsQuery->select("ticket_events.ticket_id, MIN(ticket_events.event_recorded_date) AS FirstAnswered");
        $answeredTicketsQuery->from("ticket_events");
        $answeredTicketsQuery->join("ticket","ticket.id = ticket_events.ticket_id" );
        $answeredTicketsQuery->andWhere("ticket_events.event_type_id = ".EventType::Event_Commented_By_Mentor);
        $answeredTicketsQuery->group("ticket_events.ticket_id");
        
        //at this point put all the filters so the tickets can be reduced according to the filter and for query optimization
        $this->prepareAllFiltersCommand($answeredTicketsQuery);
        
        

        $ticketDurationQuery =  Yii::app()->db->createCommand();
        $ticketDurationQuery->select(array("ticket_events.ticket_id", 
                                           "MIN(ticket_events.event_recorded_date) AS OpenedDate",
                                           "answerdTicketInfo.FirstAnswered",
                                           "TIMESTAMPDIFF(HOUR, MIN(ticket_events.event_recorded_date), answerdTicketInfo.FirstAnswered) AS HourAnswered" ));  
        $ticketDurationQuery->from("ticket_events");
        $ticketDurationQuery->join("(".$answeredTicketsQuery->text.") answerdTicketInfo ", "answerdTicketInfo.ticket_id = ticket_events.ticket_id ");
	    $ticketDurationQuery->Where("ticket_events.event_type_id = ".EventType::Event_New); 
        $ticketDurationQuery->group("ticket_events.ticket_id");
        
        $command =  Yii::app()->db->createCommand();   
        
		
		$command->select(array("rt.ticketID AS id", "rt.*","p.HourAnswered"));
        $command->from("(".$ticketDurationQuery->text.") p ");
        $command->join("ticket", "p.ticket_id = ticket.id");
		$command->join('report_ticket rt', 'ticket.id = rt.ticketID');

        
        
        switch ($this->dim2ID)
        {
           case DimensionType::Date:
          
               break;            
           case DimensionType::MonthOfTheYear:
             
               break;           
           case DimensionType::Year:
              break;
           case DimensionType::TicketAssignedMentor:
             break;
		    case DimensionType::Mentee:
  
		      break;
		 case DimensionType::DomainExclusive:
                            $command->andWhere("ticket.domain_id IS NOT NULL");
                            $command->andWhere("ticket.subdomain_id IS NULL");
			  break;
			  case DimensionType::DomainAggregated:
				 $command->andWhere("ticket.domain_id IS NOT NULL");
			  break;
			  case DimensionType::SubDomain:
				 $command->andWhere("ticket.subdomain_id IS NOT NULL");
			  break;
			  case DimensionType::Project:
				 $command->andWhere("ticket.assigned_project_id IS NOT NULL");
			    break;
			  
			  
           default:
               throw new CException("Invalid dimension");
         }
         
        // echo $command->text;
        
        return $command->queryAll(); 
		
	}
	
	public function retrieveTicketsCurrentlyOpenedDetailsData()
	{
	  $command =  Yii::app()->db->createCommand();
      
	  $command->select(array("rt.ticketID AS id", "rt.*", "TIMESTAMPDIFF(HOUR, ticket_events.event_recorded_date,NOW()) AS OpenedSince"));
      $command->from("ticket_events");
      $command->join('ticket', 'ticket.id = ticket_events.ticket_id');
	  $command->join('report_ticket rt', 'ticket.id = rt.ticketID');
      $command->where("ticket_events.event_type_id = ".EventType::Event_New);
	  $command->andWhere("ticket.status = 'Pending'");
                  
      switch ($this->dim2ID)
      {
           case DimensionType::Date:
           
               break;            
           case DimensionType::MonthOfTheYear:
             
               break;           
           case DimensionType::Year:
  
               break;
           
         case DimensionType::TicketAssignedMentor:
                
             break;
		 case DimensionType::Mentee;
                
			  break; 
		  case DimensionType::DomainExclusive:
			   	 $command->andWhere("ticket.domain_id IS NOT NULL");
				 $command->andWhere("ticket.subdomain_id IS NULL");
			  break;
		  case DimensionType::DomainAggregated:
			     $command->andWhere("ticket.domain_id IS NOT NULL");
			  break;
	       case DimensionType::SubDomain:
				 $command->andWhere("ticket.subdomain_id IS NOT NULL");
			  break;
		    case DimensionType::Project:
				 $command->andWhere("ticket.assigned_project_id IS NOT NULL");
			    break;
           default:
               throw new CException("Invalid dimension");
       }
       
       $this->prepareAllFiltersCommand($command);
           
       return $command->queryAll(); 
		
	}
	
	public function retrieveTicketsUnansweredDetailsData()
	{
		 $command =  Yii::app()->db->createCommand();
          
          $command->select(array("rt.ticketID AS id", "rt.*","TIMESTAMPDIFF(HOUR, ticket_events.event_recorded_date,NOW()) AS OpenedSince"));
          $command->from("ticket");
          $command->join('ticket_events', 'ticket.id = ticket_events.ticket_id');
		  $command->join('report_ticket rt', 'ticket.id = rt.ticketID');
          $command->leftJoin("ticket_events comented","ticket.id = comented.ticket_id AND comented.event_type_id = ".EventType::Event_Commented_By_Mentor);
          $command->where("comented.ticket_id IS NULL");
          $command->andWhere("ticket_events.event_type_id = ".EventType::Event_New);
          $command->andWhere("ticket.status = 'Pending'");
		  

                  
      switch ($this->dim2ID)
      {
           case DimensionType::Date:
             
               break;            
           case DimensionType::MonthOfTheYear:
           
               break;           
           case DimensionType::Year:
            
               break;
           
         case DimensionType::TicketAssignedMentor:
                  
             break;
		 case DimensionType::Mentee;
               	 
			  break; 
		  case DimensionType::DomainExclusive:
			     $command->andWhere("ticket.domain_id IS NOT NULL");
				 $command->andWhere("ticket.subdomain_id IS NULL");
			  break;
		  case DimensionType::DomainAggregated:
			     $command->andWhere("ticket.domain_id IS NOT NULL");
			  break;
	       case DimensionType::SubDomain:
			     $command->andWhere("ticket.subdomain_id IS NOT NULL");
			  break;
		    case DimensionType::Project:
			     $command->andWhere("ticket.assigned_project_id IS NOT NULL");
			    break;
           default:
               throw new CException("Invalid dimension");
       }
       
       $this->prepareAllFiltersCommand($command);
      // echo $command->text;
           
       return $command->queryAll(); 			
	}
	
	///////////////////////////////////Parameter config/////////////////////////////////////////////////
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
       
       if (isset($this->assigned_project_id) && $this->assigned_project_id >0 )
       {
            $command->andWhere("ticket.assigned_project_id = ".$this->assigned_project_id); 
       }
       
       if (isset($this->mentee_id) && $this->mentee_id > 0 )
       {
            $command->andWhere("ticket.creator_user_id = ".$this->mentee_id); 
       }
        
    }
    

    
}

