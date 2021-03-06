<?php

class CommentController extends Controller
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
				'actions'=>array('create','update','message'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		$model = new Comment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comment']) && $_POST['Comment']['description'] <> "" )
		{
                   //Collect the model
                   $model-> description = $_POST['Comment']['description'];
		   $model -> ticket_id = $id;
			/*Set the date */
		   $model -> added_date = new CDbExpression('NOW()');

                   /* Get the name and lastname of the current user */
                   $user = User::model()->getCurrentUser();
                   /** @var User user_added */
                   $model ->user_added = $user->fname.' '.$user->lname;
                   
                   
                             
                   $ticket =  Ticket::model()->findByPk($id);
                   if (!isset($ticket))
                   {
                       throw new Exception("Ticket with ID: ".$id." not found", "", "");
                   }
                   
                   //deduct what event type is going to be
                   $eventType = EventType::Event_Commented_By_Mentor;
                   if ($user->id == $ticket->creator_user_id)
                   {
                       $eventType = EventType::Event_Commented_By_Owner;
                   }
			
                   
                   $trans = Yii::app()->db->beginTransaction();
                   $saved = true;
                   try 
                   {
                   
		      $model->save(false);
                      
                       TicketEvents::recordEvent($eventType, 
                                                 $id,
                                                 NULL, 
                                                 $model->id, 
                                                 NULL);
                      
                   
                       $trans->commit();
                    } 
                    catch (Exception $e) 
                    {
                      $trans->rollback();
                      Yii::log("Error occurred while saving the ticket comment. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), CLogger::LEVEL_ERROR, __METHOD__);
                      $saved = false;
                    }
                    
                    if ($saved)
                    {
                        User::sendTicketCommentedEmailNotification($model->ticket_id);
                    }
                   
                   
		}
	}

    public function actionMessage($id)
    {
        $model = new Comment;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Comment']))
        {
            $model-> description = $_POST['Comment']['description'];
            $model -> ticket_id = $id;
            /*Set the date */
            $model -> added_date = new CDbExpression('NOW()');

            /* Get the name and lastname of the current user */
            $user = User::model()->getCurrentUser();
            /** @var User user_added */
            $model ->user_added = $user->fname.' '.$user->lname;

            if($model->save(false))
            {
                /*Get the ticket status */
                //$TicketStatus = Ticket::model()->find("id=:id", array(":id"=>$model->ticket_id));

                /* Send Notification about the comment added to a ticket */
                User::sendTicketStatusCommentedEmailNotification($model->ticket_id, $model->description, User::model()->getCurrentUserId());

            }
        }
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

		if(isset($_POST['Comment']))
		{
			$model->attributes=$_POST['Comment'];
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
		$dataProvider=new CActiveDataProvider('Comment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comment']))
			$model->attributes=$_GET['Comment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Comment the loaded model
	 * @throws CHttpException
	 */


	public function loadModel($id)
	{

        //$model = new Comment();
        //$model -> ticket_id = $id;
       // $comment = Comment::model()->findBySql("SELECT * FROM comment WHERE ticket_id=:id", array(":id"=>$id));
		$model=Comment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;


	}


	/**
	 * Performs the AJAX validation.
	 * @param Comment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
