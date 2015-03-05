<?php
class DimensionType
{
    const Date =1;
    const Year =2;
    const MonthOfTheYear = 3;    
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
			'newTicketsToDate' => 'To');
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
       $command =  Yii::app()->db->createCommand();
       
       //new tickets data
       switch ($this->newTicketsCurrentDimension)
       {
           case DimensionType::Date:
               $command->select(array("COUNT(1) AS EventCount, ticket_events.event_recorded_date AS DateRecorded"));  
               $command->group('DATE(ticket_events.event_recorded_date)');
               break;            
           case DimensionType::MonthOfTheYear:
               $command->select(array("COUNT(1) AS EventCount, date_sub(ticket_events.event_recorded_date, INTERVAL DAY(ticket_events.event_recorded_date) -1 DAY) AS DateRecorded")); 
               $command->group('YEAR(ticket_events.event_recorded_date), MONTH(ticket_events.event_recorded_date)');
               break;           
           case DimensionType::Year:
               $command->select(array("COUNT(1) AS EventCount, MAKEDATE(ticket_events.event_recorded_date,1)  AS DateRecorded")); 
               $command->group('YEAR(ticket_events.event_recorded_date)');
               break;
           default:
               throw new CException("Invalid dimension");
       }
       
       $command->from("ticket_events");
       $command->where("ticket_events.event_type_id = ".EventType::Event_New);
       $newEvents = $command->queryAll(); 
    }
        
        
}

