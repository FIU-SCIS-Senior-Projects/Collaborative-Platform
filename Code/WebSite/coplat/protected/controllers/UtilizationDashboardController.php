<?php

class UtilizationDashboardController extends Controller
{
    
        public $layout = '//layouts/column2';
    
               
        
	public function actionIndex()
	{ 
	      if (!Yii::app()->request->isPostRequest)
		  {
            $ultilizationFilter = UtilizationDashboardFilter::initializeFilters(); 
           
          }	else
		  {
			  if(isset($_POST['UtilizationDashboardFilter'])) 
			  {
			   $ultilizationFilter = new UtilizationDashboardFilter ();
               $ultilizationFilter->unsetAttributes();  // clear any default values  
               $ultilizationFilter->attributes = $_POST['UtilizationDashboardFilter'];
              }
		  }	
		  
		  $ultilizationFilter->retrieveDashboardData($newEvents);  
	      $this->render('view', array('filter'=>$ultilizationFilter,'newEvents' => $newEvents));
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
                    'actions'=>array('index'),
                    'users'=>array('admin')),
                array('deny',  // deny all users
                    'users'=>array('*')),
            );
        }

	
}