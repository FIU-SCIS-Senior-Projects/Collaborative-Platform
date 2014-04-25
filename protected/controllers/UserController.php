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
				'actions'=>array('create','roles','setRoles'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('ChangePassword'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'view', 'update', 'delete', 'create_admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionsetRoles($id)
    {
        $model = $this->loadModel($id);

        $this->redirect('setRoles/'.$id);
    }

    public function actionRoles($id)
    {
        $model = $this->loadModel($id);

        $this->render('roles', array('model'=> $model));
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $model = $this->loadModel($id);
        $promentor = ProjectMentor::model()->getProMentor($id);
        $permentor = PersonalMentor::model()->getPerMentor($id);
        $dommentor = DomainMentor::model()->getDomMentor($id);

        $isactive = $model->activated;

        if(isset($_POST['submit']))
        {
            $model->biography = $_POST['biography'];
            if(!$isactive){
                $model->activated = 1;
                User::sendAccountValidatedEmailNotification($model->id, User::model()->getCurrentUserId());
            }
            $model->save(false);




            if($model->isProMentor == 1)
            {
                $promentor->max_hours = $_POST['proHours'];
                $promentor->max_projects = $_POST['numProjects'];
                $promentor->save();

                if(isset($_POST['proj']))
                {
                    $projs = $_POST['proj'];

                    if(empty($projs))
                    {
                        echo " No projects selected ";
                    }
                    else
                    {
                        $pro = $_POST['proj'];
                        $curr = Project::model()->findallbysql("SELECT * FROM project WHERE project_mentor_user_id=$model->id");
                        
                        for($i = 0; $i < ($promentor->max_projects - count($curr)); $i++)
                        {  
                                $p = Project::model()->findBySql("SELECT * FROM project WHERE title='$pro[$i]'");
                                $p->project_mentor_user_id = $model->id;
                                $p->save();
                        }
                    }
                }
            }

            if($model->isPerMentor == 1)
            {
                if(isset($_POST['pmentHours']))
                {
                    $permentor->max_hours = $_POST['pmenHours'];
                }
                if(isset($_POST['numMentees']))
                {
                    $permentor->max_mentees = $_POST['numMentees'];
                }
                $permentor->save();

                if(isset($_POST['mentees']))
                {
                    $men = $_POST['mentees'];
                    $curr = Mentee::model()->findallbysql("SELECT * FROM mentee WHERE personal_mentor_user_id=$model->id");
                    
                    for($i = 0; $i < ($permentor->max_mentees - count($curr)); $i++)
                    {
                        $m = Mentee::model()->findBySql("SELECT * FROM mentee WHERE user_id=$men[$i]");
                        $m->personal_mentor_user_id = $model->id;
                        $m->save();
                    }
                }
            }

            if($model->isDomMentor == 1)
            {
                $dommentor->max_tickets = $_POST['numTickets'];
                $dommentor->save();
                
                
                if(isset($_POST['domainName']))
                {
                    $d = new Domain();
                    $d->name = $_POST['domainName'];
                    if(Domain::model()->domainExists($d->name))
                    {
                        //do nothing
                    }
                    else
                    {
                        $d = new Domain();
                        $ud = new UserDomain();

                        $d->name = $_POST['domainName'];
                        $d->save();

                        $ud->domain_id = $d->id;
                        $ud->user_id = $model->id;
                        $ud->rate = $_POST['ratings'];
                        $ud->save();
                    }

                if(isset($_POST['existDoms']))
                {
                    $doms = $_POST['existDoms'];
                    for($i = 0; $i < count($doms); $i++)
                    {
                        $d = Domain::model()->findBySql("SELECT id FROM domain WHERE name='$doms[$i]'");
                        $ud = new UserDomain();
                        
                        $ud->domain_id = $d->id;
                        $ud->user_id = $model->id;
                        $ud->rate = $_POST['ratings'];
                        $ud->save();
                    }
                }
                
                if(isset($_POST['unrated']))
                {
                    $ud = UserDomain::model()->findAllBySql("SELECT * FROM user_domain WHERE rate IS NULL AND user_id=$model->id ");
                    $ur = $_POST['unrated'];
                    
                    for($i = 0; $i < count($ur); $i++)
                    {
                        $ud[$i]->rate = $ur[$i];
                        $ud[$i]->save();
                    }
                }
            }
        }

        /** @var User $username */
        $projects = Project::model()->findAllBySql("SELECT title FROM project WHERE project_mentor_user_id=$id");
        $userdoms = UserDomain::model()->findAllBySql("SELECT domain_id FROM user_domain WHERE user_id=$id");
        $Mentees = Mentee::model()->findAllBySql("SELECT user_id FROM mentee WHERE personal_mentor_user_id=$id");
        $Tickets= Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE assign_user_id=:id", array(":id"=>$id));

        $this->render('view', array('Tickets' => $Tickets, 'model'=> $model, 'userdoms' => $userdoms, 'Mentees' => $Mentees, 'projects' => $projects));

        /*$this->render('view',array(
			'model'=>$this->loadModel($id),
		));*/
	}
        else 
        {
            $projects = Project::model()->findAllBySql("SELECT title FROM project WHERE project_mentor_user_id=$id");
            $userdoms = UserDomain::model()->findAllBySql("SELECT domain_id FROM user_domain WHERE user_id=$id");
            $Mentees = Mentee::model()->findAllBySql("SELECT user_id FROM mentee WHERE personal_mentor_user_id=$id");
            $Tickets= Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE assign_user_id=:id", array(":id"=>$id));
            
            $this->render('view', array('Tickets' => $Tickets, 'model'=> $model, 'userdoms' => $userdoms, 'Mentees' => $Mentees, 'projects' => $projects,
			'model'=>$this->loadModel($id)));
        }
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


        if(isset($_POST['User']))
		{
            /*if ($this->actionVerifyRegistration() != "") {
                $this->render('create', array('model'=>$model));
            }*/

            $model->attributes=$_POST['User'];
            $model->pic_url = '/coplat/images/profileimages/default_pic.jpg';
            $model->biography = "Tell us something about yourself...";
            $model->activation_chain = $this->genRandomString(10);
            $model->activated == 0;

            //Hash the password before storing it into the database
			$hasher = new PasswordHash(8, false);
			$model->password = $hasher->HashPassword($model->password);

			if($model->save()){

                if($model->isAdmin == 1)
                {
                    $admin = new Administrator;
                    $admin->user_id = $model->id;
                    $admin->save();
                }

                if($model->isPerMentor == 1)
                {
                    $perMentor = new PersonalMentor;
                    $perMentor->user_id = $model->id;
                    $perMentor->max_hours = 0; $perMentor->max_mentees = 0;
                    $perMentor->save();
                }

                if($model->isProMentor == 1)
                {
                    $proMentor = new ProjectMentor;
                    $proMentor->user_id = $model->id;
                    $proMentor->max_hours = 0; $proMentor->max_projects = 0;
                    $proMentor->save();
                }

                if($model->isDomMentor == 1)
                {
                    $domainMentor = new DomainMentor;
                    $domainMentor->user_id = $model->id;
                    $domainMentor->max_tickets = 0;
                    $domainMentor->save();
                }

                if($model->isMentee == 1)
                {
                    $mentee = new Mentee();
                    $mentee->user_id = $model->id;
                    $mentee->save();
                }
                $userfullName = $model->fname.' '.$model->lname;

                $this->actionSendVerificationEmail($userfullName, $model->email);
            }
		}
        $error = '';
        $this->render('create',array(
            'model'=>$model,'error' => $error
        ));
        //$this->render('add',array('model'=>$model, 'error' => $error));

	}
	public function actionCreate_Admin()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];

            $model->pic_url = '/coplat/images/profileimages/avatarsmall.gif';
            $model->activation_chain = $this->genRandomString(10);
            $model->username = $model->fname."_".$this->genRandomString(10);
            $hasher = new PasswordHash(8, false);
            $plain_pwd = $this->genRandomString(10);
            $model->password = $hasher->HashPassword($plain_pwd);
            $model->isAdmin = 1;

            if($model->save()){
                $model->username = $model->fname."_".$model->id;
                $model->save(false);
                $admin = new Administrator;
                $admin->user_id = $model->id;
                $admin->save();
                User::sendNewAdministratorEmailNotification($model->email, $plain_pwd);

				$this->redirect(array('/user/admin','id'=>$model->id));
            }
        }
        $error = '';
		$this->render('create_admin',array(
			'model'=>$model, 'error' => $error
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        $model = $this->loadModel($id);

        $this->renderPartial('update', array('model'=> $model));

	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
	    //Soft delete (Disable the User)
        $model=$this->loadModel($id);
        $model->disable = 1;

        $model->save(false);

	    //Hard delete
		//$this->loadModel($id)->delete();

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
                User::sendEmailPasswordChanged($user->id);
				$this->redirect("/coplat/index.php");
			} else {
				$error = "Passwords do not match.";
				$this->render('ChangePassword',array('model'=>$model, 'error' => $error));
			}
		} else {
			$this->render('ChangePassword',array('model'=>$model, 'error' => $error));
		}
	}

    public function actionSendVerificationEmail($userfullName, $user_email){

        $admins = User::model()->findAllBySql("SELECT fname, lname, email FROM user inner join administrator on user.id = administrator.user_id WHERE user.disable = 0 and user.activated = 1");

        foreach($admins as $ad)
        {
            $adminfullName = $ad->fname.' '.$ad->lname;
            User::sendVerificationEmail($userfullName, $user_email, $adminfullName, $ad->email);
        }

        $this->redirect('/coplat/index.php/site/page?view=verification');

    }

    public function actionVerifyEmail($username, $activation_chain)
    {
        $usermodel = User::model()->find("username=:username AND activation_chain=:activation_chain",array(':username'=>$username, ':activation_chain'=>$activation_chain));
        if ($usermodel != null)
        {
            $usermodel->activated = 1;
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
