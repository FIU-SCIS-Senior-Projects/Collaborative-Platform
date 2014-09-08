<?php

class NotificationController extends Controller
{
	public function actionView()
	{
		
		$this->render('View');
		
	}

	public function actionGetNotification()
	{
		$username = Yii::app()->user->name;
		$user = User::model()->find("username=:username",array(':username'=>$username));
	}
	


	
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}