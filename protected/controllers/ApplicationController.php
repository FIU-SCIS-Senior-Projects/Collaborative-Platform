<?php

class ApplicationController extends Controller
{
	public function actionCreate()
	{
		$this->render('create');
	}

	public function actionDelete()
	{
		$this->render('delete');
	}

	public function actionImport()
	{
		$this->render('import');
	}

	public function actionUpdate()
	{
		$this->render('update');
	}

	public function actionView()
	{
		$this->render('view');
	}
	
	/*
	 * Renders the mentor application portal
	 */
	public function actionPortal(){
		$this->render('portal');
	}
	
	/*
	 *  Personal Mentor Application
	 */
	public function actionPersonal(){
		$model = new Application;
		$user = User::model()->getCurrentUser();
		$mentees = new User('search');
		$mentees->unsetAttributes();
		$mentees->isMentee = 1;
		$mypicks = new User;
		
		
		$model->type = 1;
		$model->user_id = $user->id;
		$error='';
		
		$this->render('personal', array(
            'model'=>$model, 'search'=>$mentees, 'mypicks'=>$mypicks, 'error' => $error,
        ));
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