<?php

require ('PasswordHash.php');

class UserController extends Controller
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
				'actions'=>array('create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','update','delete','create_admin','view','ChangePassword'),
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
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $this->render('create',array(
            'model'=>$model,
        ));

		if(isset($_POST['User']))
		{
            if ($this->actionVerifyRegistration() != "") {
                $this->render('user/create');
            }

			$model->attributes=$_POST['User'];
            $model->pic_url = '/coplat/images/profileimages/avatarsmall.gif';

            $model->activation_chain = $this->genRandomString(10);

            //Hash the password before storing it into the database
			$hasher = new PasswordHash(8, false);
			$model->password = $hasher->HashPassword($model->password);

			if($model->save()){
				$model->sendVerificationEmail();
			    $this->actionSendVerificationEmail($model->email);
				//$this->redirect(array('/site/login','id'=>$model->id));
            }
		}
        $error = '';
        $this->render('/user/create',array('model'=>$model, 'error' => $error));


	}
	public function actionCreate_Admin()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('/user/admin','id'=>$model->id));
		}

		$this->render('create_admin',array(
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

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
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
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionChangePassword() {
		$model = User::getCurrentUser();
		$error = '';
		if(isset($_POST['User'])) {
			$pass = $_POST['User']['password'];
			$p1 = $_POST['User']['password1'];
			$p2 = $_POST['User']['password2'];
			//verify old password
			$username = Yii::app()->user->name;
			$hasher = new PasswordHash(8, false);
			$login = new LoginForm;
			$login->username = $username;
			$login->password = $pass;

			//$user = User::model()->find("username=:username AND password=:password", array(":username"=> $username, ":password"=>$password));
			if (!$login->validate()){
				$error = "Old Password was incorrect.";
				$this->render('ChangePassword',array('model'=>$model, 'error' => $error));
			} elseif ($p1 == $p2) {
				//Hash the password before storing it into the database
				$hasher = new PasswordHash(8, false);
				$user = User::getCurrentUser();
				$user->password = $hasher->HashPassword($p1);
				$user->save(false);
				$this->redirect("/coplat/index.php");
			} else {
				$error = "Passwords do not match.";
				$this->render('ChangePassword',array('model'=>$model, 'error' => $error));
			}
		} else {
			$this->render('ChangePassword',array('model'=>$model, 'error' => $error));
		}
	}

    public function actionSendVerificationEmail($email = null){

        if (!isset($email)) {
            $username = $_GET['username'];
            $user = User::model()->find("username=:username",array(':username'=>$username));
        } else {
            $user = User::model()->find("email=:email",array(':email'=>$email));
        }

        $user->sendVerificationEmail();
        $this->redirect('/coplat/index.php/site/page?view=verification');
    }

    public function actionVerifyEmail($username, $activation_string)
    {
        $usermodel = User::model()->find("username=:username AND activation_string=:activation_string",array(':username'=>$username, ':activation_string'=>$activation_string));
        if ($usermodel != null)
        {
            $usermodel->activated = true;
            $usermodel->save(false);
            $this->redirect("/coplat/index.php/site/login");
        }
        else
            redirect();
    }

    function check_email_address($email) {
        // First, we check that there's one @ symbol, and that the lengths are right
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                return false;
            }
        }
        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                    return false;
                }
            }
        }

        return true;
    }

    public function actionVerifyRegistration(){
        $user = $_POST['User'];
        $error = "";

        $username = $user['username'];
        $password = $user['password'];
        $password2 = $user['password2'];
        $email = $user['email'];


        if ((strlen($username) < 4) || (!ctype_alnum($username))) {
            $error .= "Username must be alphanumeric and at least 4 characters.<br />";
        }
        if (User::model()->find("username=:username",array(':username'=>$username))) {
            $error .= "Username is taken<br />";
        }
        if (User::model()->find("email=:email",array(':email'=>$email))) {
            $error .= "Email is taken<br />";
        }
        if ($password != $password2) {
            $error .= "Passwords do not match<br />";
        }
        if (strlen($password) < 6) {
            $error .= "Password must be more than 5 characters<br />";
        }
        if (!$this->check_email_address($email)){
            $error .= "Email is not correct format<br />";
        }

        print $error;
        return $error;
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public static function genRandomString($length = 10) {
		$characters = "0123456789abcdefghijklmnopqrstuvwxyz";
		$string = "";
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
	
		return $string;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	/*protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}*/
}
