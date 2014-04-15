<?php

class ProfileController extends Controller
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

                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions' => array('create', 'update', 'userProfile'),
                    'users' => array('@'),
                ),
                array('deny', // deny all users
                    'users' => array('*'),
                ),
            );
        }
        
        public function actionuserProfile()
        {
        /** @var User $username */
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        $projects = Project::model()->findAllBySql("SELECT title FROM project");
        $userdoms = UserDomain::model()->findAllBySql("SELECT domain_id FROM user_domain WHERE user_id=$user->id");
        $Mentees = Mentee::model()->findAllBySql("SELECT user_id FROM mentee");
        $Tickets= Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE assign_user_id=:id", array(":id"=>$user->id));

        $this->render('userProfile', array('Tickets' => $Tickets, 'user'=> $user, 'userdoms' => $userdoms, 'Mentees' => $Mentees, 'projects' => $projects));    
        }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

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
}
