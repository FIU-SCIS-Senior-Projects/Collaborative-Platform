<?php

class UtilizationDashboardController extends Controller
{
    
        public $layout = '//layouts/column2';
    
               
        
	public function actionIndex()
	{ 
            $ultilizationFilter = UtilizationDashboardFilter::initializeFilters(); 
            $ultilizationFilter->retrieveDashboardData($newEvents);            
	    $this->render('view', array('filter'=>$ultilizationFilter,
                                        'newEvents' => $newEvents));
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