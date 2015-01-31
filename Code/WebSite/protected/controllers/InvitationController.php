<?php

class InvitationController extends Controller
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
			//array('booster.filters.BoosterFilter - create')

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
				'actions'=>array('create','update','delete','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'viewmodal', 'confirm'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionViewmodal($id)
	{
		$model = $this->loadModel($id);
		 
	
		if( Yii::app()->request->isAjaxRequest )
			$this->renderPartial('viewmodal',array('model'=>$model), false, true);
		else
			$this->render('viewmodal',array('model'=>$model));
		 
	}
	
	public function actionConfirm($id){
		
		$model=$this->loadModel($id);
		
		if(isset($_POST['Invitation']))
		{
			$model->attributes=$_POST['Invitation'];
			$model->save();
			User::sendInviteByMessage($model);
			$this->redirect(array('admin'));
		}

		$this->render('confirm',array(
				'model'=>$model,'id'=>$id,
		));
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Invitation;
		$this->layout = '';
		
		/**
		 * todo:
		 * 
		 * create the ability to select the different roles
		 * personal mentor
		 * project mentor
		 * domain mentor
		 * 
		 * click generate and then the text box is updated to display template data.
		 * 
		 * the admin can then make changes to the textbox and when submit occurs
		 * the data from the textbox is captured and sent to the email function
		 * with email and message as parameters.
		 */

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Invitation']))
		{
			$user = new User();
				
			$model->attributes=$_POST['Invitation'];
            $model->administrator_user_id = (int)User::getCurrentUserId();
            $model->date = date('Y-m-d H:i:s');
            $model->employer = 0;
            $model->judge = 0;
            $model->message = $user->setInvitationEmail($model);
            
			if($model->save())
            {
			    //User::sendInvitationEmail($model);
				//$this->redirect(array('admin','id'=>$model->id));
				$this->redirect(array('confirm', 'id'=>$model->id));
            }
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

		if(isset($_POST['Invitation']))
		{
			$model->attributes=$_POST['Invitation'];
            $model->administrator_user_id = (int)User::getCurrentUserId();
            $model->date = date('Y-m-d H:i:s');
			if($model->save())
                User::sendInvitationEmail($model);
				$this->redirect(array('admin','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Invitation');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$this->layout = '//layouts/column1';
		
		$model=new Invitation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Invitation']))
			$model->attributes=$_GET['Invitation'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Invitation the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Invitation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Invitation $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='invitation-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
