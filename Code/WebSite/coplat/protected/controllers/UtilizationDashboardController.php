<?php

class UtilizationDashboardController extends Controller
{
    
        
	public function actionIndex()
	{
		$this->render('view');
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