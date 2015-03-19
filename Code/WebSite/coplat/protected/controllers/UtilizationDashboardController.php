<?php

class UtilizationDashboardController extends Controller
{
    
        public $layout = '//layouts/column2';
    
               
        
	public function actionIndex()
	{ 
            
           /* $subQueryCommand =  Yii::app()->db->createCommand();
            
            $subQueryCommand->select("ticket_events.ticket_id, MAX(ticket_events.event_recorded_date) AS event_recorded_date");
            $subQueryCommand->from("ticket_events");
            $subQueryCommand->join("ticket","ticket.id = ticket_events.ticket_id" );
            $subQueryCommand->where("ticket.status = 'Close'");
            $subQueryCommand->andWhere("ticket_events.event_type_id = 2");
            $subQueryCommand->andWhere("ticket_events.new_value = 'Close'");
            $subQueryCommand->group("ticket_events.ticket_id");*/
            //echo $subQueryCommand->text;
            
         
              /* $command =  Yii::app()->db->createCommand();
               $command->select(array("ticket_events.ticket_id", 
                                      "ticket_events.event_recorded_date AS ceatedDate",
	                              "tc.event_recorded_date AS closedDate"));  
               $command->from("ticket_events");*/
              /* $command->inne(new Query())*/
               
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
       
       
      
        public function filters()
	{
	   return array('accessControl');
	}
        
        //this is for the access rules
        public function accessRules()
        {
            return array(
                array('allow',
                    'actions'=>array('index', 'PullTicketsCreated', 'PullTicketsClosed'),
                    'users'=>array('admin')),
                array('deny',  // deny all users
                    'users'=>array('*')),
            );
        }

	
}