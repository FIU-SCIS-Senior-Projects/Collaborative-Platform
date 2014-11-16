<?php

class ApplicationPersonalMentorController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'view', 'updatepick'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModelByUser($id);
		
		//$model2=new ApplicationPersonalMentorPick('search');
		//$model2->unsetAttributes();
		//$model2->app_id = $model->id;
		$model2 = new CSqlDataProvider('SELECT t.id, t.app_id, t.user_id, t.approval_status, u.fname, u.lname 
							FROM application_personal_mentor_pick t, user u 
							WHERE t.user_id = u.id AND t.approval_status != "Proposed by Mentor" AND t.app_id = '.$model->id.'');

		
		//$model3=new ApplicationPersonalMentorPick('search');
		//$model3->unsetAttributes();
		//$model3->app_id = $model->id;
		$model3 = new CSqlDataProvider('SELECT t.id, t.app_id, t.user_id, t.approval_status, u.fname, u.lname 
							FROM application_personal_mentor_pick t, user u 
							WHERE t.user_id = u.id AND t.approval_status = "Proposed by Mentor" AND t.app_id = '.$model->id.'');
		
		
		$this->renderPartial('view',array(
			'model'=>$model,'model2'=>$model2,'model3'=>$model3,
		));
	}
	
	public function actionUpdatePick()
	{
		$es = new EditableSaver('ApplicationPersonalMentorPick');  //'User' is name of model to be updated
		$es->update();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ApplicationPersonalMentor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ApplicationPersonalMentor']))
		{
			$model->attributes=$_POST['ApplicationPersonalMentor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ApplicationPersonalMentor']))
		{
			$model->attributes=$_POST['ApplicationPersonalMentor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ApplicationPersonalMentor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ApplicationPersonalMentor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ApplicationPersonalMentor']))
			$model->attributes=$_GET['ApplicationPersonalMentor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ApplicationPersonalMentor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ApplicationPersonalMentor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelByUser($id)
	{
		$params = array('user_id'=>$id);
		$model=ApplicationPersonalMentor::model()->findByAttributes($params);
		
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ApplicationPersonalMentor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='application-personal-mentor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
