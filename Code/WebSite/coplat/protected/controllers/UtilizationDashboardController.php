<?php

class UtilizationDashboardController extends Controller
{
    
        public $layout = '//layouts/column2';
    
               
        
	public function actionIndex()
	{ 
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
        
        
        public function actionRefreshNewTickets()
        {            
            if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $newEvents= $ultilizationFilter->retrieveNewTicketsDashboardData(); 
               
               $newTicketRes =  array('dimDesc' => DimensionType::getDescriptionByDateDimension($ultilizationFilter->newTicketsCurrentDimension),
                                      'newEvents' => $newEvents,
                                      'dimFormat' => DimensionType::getDateFormatByDimension($ultilizationFilter->newTicketsCurrentDimension) );
                           
               echo json_encode($newTicketRes);
            }            
        }

        public function actionRefreshClosedTickets()
        {            
            if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $closedEvents= $ultilizationFilter->retrieveClosedTicketsDashboardData(); 
               
               $closedTicketRes =  array('dimDesc' => DimensionType::getDescriptionByDateDimension($ultilizationFilter->closedTicketsCurrentDimension),
                                         'closedEvents' => $closedEvents,
                                         'dimFormat' => DimensionType::getDateFormatByDimension($ultilizationFilter->closedTicketsCurrentDimension) );
                           
               echo json_encode($closedTicketRes);
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
                    'actions'=>array('index','RefreshNewTickets', 'RefreshClosedTickets'),
                    'users'=>array('admin')),
                array('deny',  // deny all users
                    'users'=>array('*')),
            );
        }

	
}