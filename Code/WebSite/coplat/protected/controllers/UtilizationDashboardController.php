<?php

class UtilizationDashboardController extends Controller
{
    
        public $layout = '//layouts/column2';
    
               
        
	public function actionIndex()
	{ 
     $ultilizationFilter = new UtilizationDashboardFilter();
	 $ultilizationFilter->reportFormatId = ReportFormat::chart;
	 $this->render('view', array('filter'=>$ultilizationFilter));  
     }
        
       //chart actions
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
               
               $ticketsAVGLifeSpamData = $ultilizationFilter->retrieveAVGTicketDurationDashboardData(); 
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
       
       public function actionPullTicketsCurrentlyOpened()
       {
            if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ticketsCreatedData = $ultilizationFilter->retrieveTicketsCurrentlyOpenedDashboardData(); 
               $data =  array('dashboardData' => $ticketsCreatedData);
               echo json_encode($data); 
            }  
       }
	   
	   public function actionPullTicketsUnanswered()
	   {
		    if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ticketsUnanswered = $ultilizationFilter->retrieveUnansweredTicketsDashboardData(); 
               $data =  array('dashboardData' => $ticketsUnanswered);
               echo json_encode($data); 
            }  
	   }
      
	  
	    ////////////////////////////////////raw data actions
	   public function actionPullTicketsCreatedDetails()
	   {
		    if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ticketRawData = $ultilizationFilter->retrieveTicketsCreatedDetailsData();
               $dataProvider=new CArrayDataProvider($ticketRawData, array('pagination'=> false));
			   			   
               $this->renderPartial('UtilizationViewRawData',array('dataprovider' => $dataProvider,
			                                                       'ultilizationFilter' => $ultilizationFilter ),false,true);	
            }  		   
	   }
	   
	   public function actionPullTicketsClosedDetails()
	   {
		    if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ticketRawData = $ultilizationFilter->retrieveTicketsClosedDetailsData();
               $dataProvider=new CArrayDataProvider($ticketRawData, array('pagination'=> false));
			   			   
               $this->renderPartial('UtilizationViewRawData',array('dataprovider' => $dataProvider,
			                                                       'ultilizationFilter' => $ultilizationFilter ),false,true);	
            }  
	   }
		
	   public function actionPullTicketDurationDetails()
	   {
		    if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ticketRawData = $ultilizationFilter->retrieveTicketDurationDetailsData();
               $dataProvider=new CArrayDataProvider($ticketRawData, array('pagination'=> false));
			   			   
               $this->renderPartial('UtilizationViewRawData',array('dataprovider' => $dataProvider,
			                                                       'ultilizationFilter' => $ultilizationFilter ),false,true);	
            }   
	   }
	    
	   public function actionPullTimeMentorAnswerDetails()
	   {
		   if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ticketRawData = $ultilizationFilter->retrieveTimeMentorAnswerDetailsData();
               $dataProvider=new CArrayDataProvider($ticketRawData, array('pagination'=> false));
			   			   
               $this->renderPartial('UtilizationViewRawData',array('dataprovider' => $dataProvider,
			                                                       'ultilizationFilter' => $ultilizationFilter ),false,true);	
            }
	   }
	   
	   public function actionPullTicketsCurrentlyOpenedDetails()
	   {
		   if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ticketRawData = $ultilizationFilter->retrieveTicketsCurrentlyOpenedDetailsData();
               $dataProvider=new CArrayDataProvider($ticketRawData, array('pagination'=> false));
			   			   
               $this->renderPartial('UtilizationViewRawData',array('dataprovider' => $dataProvider,
			                                                       'ultilizationFilter' => $ultilizationFilter ),false,true);	
            }
	   }
	   
	   public function actionPullTicketsUnansweredDetails()
	   {
		   	if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ticketRawData = $ultilizationFilter->retrieveTicketsUnansweredDetailsData();
               $dataProvider=new CArrayDataProvider($ticketRawData, array('pagination'=> false));
			   			   
               $this->renderPartial('UtilizationViewRawData',array('dataprovider' => $dataProvider,
			                                                       'ultilizationFilter' => $ultilizationFilter ),false,true);	
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
                    'actions'=>array('index', 'PullTicketsCreated', 'PullTicketsClosed','PullAVGTicketDuration', 
					                          'PullAVGTimeMentorAnswer', 'PullTicketsCurrentlyOpened',
											  'PullTicketsUnanswered' , 'PullTicketsCreatedDetails',
											  'PullTicketsClosedDetails', 'PullAVGTicketDetails',
											  'PullTicketDurationDetails', 'PullTimeMentorAnswerDetails',
											  'PullTicketsCurrentlyOpenedDetails', 'PullTicketsUnansweredDetails'),
                    'users'=>array('admin')),
                array('deny',  // deny all users
                    'users'=>array('*')),
            );
        }

	
}