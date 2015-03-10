<?php

class UtilizationDashboardController extends Controller
{
    
        public $layout = '//layouts/column2';
    
               
        
	public function actionIndex()
	{ 
	       if (!Yii::app()->request->isPostRequest)
	       {
                $ultilizationFilter = UtilizationDashboardFilter::initializeFilters(); 
               }	
               else
	       {
		    if(isset($_POST['UtilizationDashboardFilter'])) 
		    {
			 $ultilizationFilter = new UtilizationDashboardFilter ();
                         $ultilizationFilter->unsetAttributes();  // clear any default values  
                         $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
                    }
		}
                
                
		$ultilizationFilter->retrieveDashboardData($newEvents); 
                /*if (Yii::app()->request->isAjaxRequest)
                {
                  $this->renderPartial('NewTicketsPerOverTime',array('filter'=>$ultilizationFilter,'newEvents'=>$newEvents),false,true);
                }else
                {
                  $this->render('view', array('filter'=>$ultilizationFilter,'newEvents' => $newEvents));  
                }*/
		  
		  
	}
        
        
        public function actionRefreshNewTickets()
        {            
            if(isset($_POST['UtilizationDashboardFilter'])) 
            {
               $ultilizationFilter = new UtilizationDashboardFilter();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
               
               $ultilizationFilter->retrieveDashboardData($newEvents); 
               
               $newTicketRes =  array('dimDesc' => DimensionType::getDescriptionByDateDimension($ultilizationFilter->newTicketsCurrentDimension),
                                      'newEvents' => $newEvents,
                                      'dimFormat' => DimensionType::getDateFormatByDimension($ultilizationFilter->newTicketsCurrentDimension) );
                           
               echo json_encode($newTicketRes);
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
                    'actions'=>array('index','RefreshNewTickets'),
                    'users'=>array('admin')),
                array('deny',  // deny all users
                    'users'=>array('*')),
            );
        }

	
}