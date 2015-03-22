<?php

class UtilizationDashboardController extends Controller
{
    
        public $layout = '//layouts/column2';
    
               
        
	public function actionIndex()
	{ 
            //closed query
            //this query return all the closed tickets...
            //all the filters mus be applied to this section
           /* $closedTicketsQuery =  Yii::app()->db->createCommand();
            $closedTicketsQuery->select("ticket_events.ticket_id, MAX(ticket_events.event_recorded_date) AS ClosedDate");
            $closedTicketsQuery->from("ticket_events");
            $closedTicketsQuery->join("ticket","ticket.id = ticket_events.ticket_id" );
            $closedTicketsQuery->where("ticket.status = 'Close'");
            $closedTicketsQuery->andWhere("ticket_events.event_type_id = ".EventType::Event_Status_Changed);
            $closedTicketsQuery->andWhere("ticket_events.new_value = 'Close'");
            $closedTicketsQuery->group("ticket_events.ticket_id");
            
            $ticketDurationQuery =  Yii::app()->db->createCommand();
            $ticketDurationQuery->select(array("ticket_events.ticket_id", 
                                               "MIN(ticket_events.event_recorded_date) AS OpenedDate",
                                               "closedTicketInfo.ClosedDate",
                                               "TIMESTAMPDIFF(HOUR, MIN(ticket_events.event_recorded_date), closedTicketInfo.ClosedDate) AS HourLifeSpan" ));  
            $ticketDurationQuery->from("ticket_events");
            $ticketDurationQuery->join("(".$closedTicketsQuery->text.") closedTicketInfo ", "closedTicketInfo.ticket_id = ticket_events.ticket_id ");
            $ticketDurationQuery->Where("ticket_events.event_type_id = ".EventType::Event_New); 
            $ticketDurationQuery->group("ticket_events.ticket_id");*/
                    
                    
           /* $tes =  $ticketDurationQuery->queryAll();
            
            echo $tes;*/
        
               
               /*$command->join("(SELECT ticket_events.ticket_id, 
                                    MAX(ticket_events.event_recorded_date) AS event_recorded_date
                                    FROM ticket_events
                               INNER JOIN ticket ON ticket.id = ticket_events.ticket_id
                               WHERE ticket.status = 'Close' AND
                                     ticket_events.event_type_id = 2 AND 
                                     ticket_events.new_value = 'Close'
                               GROUP BY ticket_events.ticket_id) tc", "ticket_events.ticket_id = tc.ticket_id");*/
              // $command->where("ticket_events.event_type_id = 1");
               //echo $command->text;
              // $command->queryAll();
            
            
	      /* if (!Yii::app()->request->isPostRequest)
	       {
                $ultilizationFilter = UtilizationDashboardFilter::initializeFilters(); 
               }*/	
              // else if(isset($_POST['UtilizationDashboardFilter'])) 
	       //{
		 
                 //$ultilizationFilter->unsetAttributes();  // clear any default values  
                 //$ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];     
		//}                
                
		/*$newEvents = $ultilizationFilter->retrieveNewTicketsDashboardData(); 
                $closedEvents = $ultilizationFilter->retrieveClosedTicketsDashboardData();*/
              /*$ultilizationFilter1 = new UtilizationDashboardFilter();
              $ultilizationFilter1->dim2ID = DimensionType::Date;
              $ultilizationFilter1->retrieveAVGTicketCreatedData();*/
            
            
            
            
                $ultilizationFilter = new UtilizationDashboardFilter();
                $this->render('view', array('filter'=>$ultilizationFilter));  
       }
        
       
       public function actionPullTicketsCreated()
       {
            if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ticketsCreatedData = $ultilizationFilter->retrieveTicketsCreatedDashboardData(); 
               $data =  array('dashboardData' => $ticketsCreatedData);
               echo json_encode($data); 
            }  
       }
       
       public function actionPullTicketsClosed()
        {
            if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ticketsClosedData = $ultilizationFilter->retrieveTicketsClosedDashboardData(); 
               $data =  array('dashboardData' => $ticketsClosedData);
               echo json_encode($data); 
            }  
        }
        
      public function actionPullAVGTicketDuration()
      {
            if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ticketsAVGLifeSpamData = $ultilizationFilter->retrieveAVGTicketCreatedDashboardData(); 
               $data =  array('dashboardData' => $ticketsAVGLifeSpamData);
               echo json_encode($data); 
            }  
       }
	   
	  public function actionPullAVGTimeMentorAnswer()
      {
            if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ticketsAVGMentorAnswer = $ultilizationFilter->retrieveAVGTimeMentorAnswerDashboardData(); 
               $data =  array('dashboardData' => $ticketsAVGMentorAnswer);
               echo json_encode($data); 
            }  
       }
       
       
      
        public function filters()
	{
	   return array('accessControl');
	}
        
        //this is for the access rules
        public function accessRules()
        {
            return array(
                array('allow',
                    'actions'=>array('index', 'PullTicketsCreated', 'PullTicketsClosed','PullAVGTicketDuration', 'PullAVGTimeMentorAnswer'),
                    'users'=>array('admin')),
                array('deny',  // deny all users
                    'users'=>array('*')),
            );
        }

	
}