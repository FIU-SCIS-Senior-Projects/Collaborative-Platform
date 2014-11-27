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
                'actions'=>array('admin', 'view', 'update', 'delete', 'create_admin','findMentors', 'search', 'viewmodal', 'UpdateUser'),
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
    
    public function actionViewmodal($id)
    {
    	
    	$this->layout = '//layouts/column1';
    	 
    	$model = $this->loadModel($id);
    	
    	 
    	if( Yii::app()->request->isAjaxRequest )
			$this->renderPartial('viewmodal',array('model'=>$model), false, true);
    	else 
    		$this->render('viewmodal',array('model'=>$model));
    	
    }
    
    
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        echo("<script>console.log('actionView!');</script>");

        $model = $this->loadModel($id);
        $promentor = ProjectMentor::model()->getProMentor($id);
        $permentor = PersonalMentor::model()->getPerMentor($id);
        $dommentor = DomainMentor::model()->getDomMentor($id);
        $def = User::model()->findBySql("select * from user where username = 'DEFAULT'");

        //$isactive = $model->activated;

        if(isset($_POST['updateRoles']))
        {
            if($model->isProMentor == 1)
            {

                Project::model()->updateAll(array( 'project_mentor_user_id'=>$def->id),'project_mentor_user_id = '.$model->id);



                $promentor->max_hours =$_POST['pjmhours'] ;
                $all = Project::model()->findAll();

                $count =0;
                foreach ($all as $each)
                {
                    if(isset($_POST[$each->id.'pjm']))
                    {
                        $p = Project::model()->findByPk($each->id);
                        $p->project_mentor_user_id =$model->id;
                        $p->save(false);
                        $count++;
                    }

                }

                $promentor->max_projects = $count;
                $promentor->save();



            }

            if($model->isDomMentor)
            {

                UserDomain::model()->deleteAll("user_id = ".$model->id);


                $dommentor->max_tickets = $_POST['dmmaxtickets'];
                $dommentor->save();


                $all = Domain::model()->findAll();
                foreach ($all as $each)
                {


                    if(isset($_POST[$each->id]))
                    {
                        $user_domain = new UserDomain();
                        $user_domain->user_id = $dommentor->user_id;
                        $user_domain->domain_id= $each->id;
                        $user_domain->active=1;
                        $user_domain->save(false);


                        $allsubs = Subdomain::model()->findAllBySql("select * from subdomain where domain_id = $each->id");
                        if($allsubs!=null)
                        {
                            foreach( $allsubs as $onesub)
                            {
                                $temp = $onesub->id.'ddmsub';
                                if(isset($_POST[$temp]))
                                {
                                    $user_domain = new UserDomain();
                                    $user_domain->user_id = $dommentor->user_id;
                                    $user_domain->domain_id= $each->id;
                                    $user_domain->active=1;
                                    $rate = $each->id.'-'.$onesub->id.'dmrate';
                                    $tier = $each->id.'-'.$onesub->id.'dmtier';
                                    $user_domain->rate = $_POST[$rate];
                                    $user_domain->tier_team = $_POST[$tier];
                                    $user_domain->subdomain_id = $onesub->id;
                                    $user_domain->save(false);



                                }
                            }
                        } else
                        {
                            $user_domain = new UserDomain();
                            $user_domain->user_id = $dommentor->user_id;
                            $user_domain->domain_id= $each->id;
                            $user_domain->active=1;
                            $user_domain->save(false);


                        }



                    }

                }

            }

            if($model->isPerMentor)
            {

                Mentee::model()->updateAll(array( 'personal_mentor_user_id'=>$def->id),'personal_mentor_user_id = '.$model->id);

                $all = Mentee::model()->findAll();

                $count =0;
                foreach ($all as $each)
                {
                    if(isset($_POST[$each->user_id.'pm']))
                    {
                        //$p = Mentee::model()->findByPk($each->user_id);
                        $each->personal_mentor_user_id =$model->id;
                        $each->save(false);
                        $count++;
                    }

                }
                $permentor->max_hours =$_POST['pmhours'] ;
                $permentor->max_mentees = $count;
                $permentor->save();
            }


            /** @var User $username */
            $projects = Project::model()->findAllBySql("SELECT title FROM project WHERE project_mentor_user_id=$id");
            $userdoms = UserDomain::model()->findAllBySql("SELECT distinct domain_id FROM user_domain WHERE user_id=$id");
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
            $userdoms = UserDomain::model()->findAllBySql("SELECT distinct domain_id FROM user_domain WHERE user_id=$id");
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
        $model->username = "";
        $model->password = "";
        
        $infoModel = new UserInfo;
        $infoModel->user_id = $model->id;
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $error='';
        $form = 'user-Register-form';
        //If a new User has been successfully created e.g. the user has created an account from the register.php page        
        
        if(isset($_POST['User']) && isset($_POST['UserInfo']))
        {
            /*if ($this->actionVerifyRegistration() != "") {
                $this->render('create', array('model'=>$model));
            }*/
			
        	echo("<script>console.log('New User Registered');</script>");
        	// auto-fill biography information
            $model->attributes=$_POST['User'];
            $model->pic_url = '/coplat/images/profileimages/default_pic.jpg';
            $model->biography = "Tell us something about yourself...";
            $model->activation_chain = $this->genRandomString(10);
            $model->activated = 1;
            
            
            
            // hash entered password
            $pw = $model->password;
            $hasher = new PasswordHash(8, false);
            $model->password = $hasher->HashPassword($model->password);

            $error1 = $this->verifyRegistration();
            if($error1==null)
            {

                $model->save(false);
                
                if(isset($_POST['UserInfo'])){
                	// get entered personal info
                	$infoModel->attributes=$_POST['UserInfo'];
                	$infoModel->user_id = $model->id;
                	$infoModel->save(false);
                }
                
                
                //newUserLogin($model, $pw);
                $login = new LoginForm;
                $login->username = $model->username;
                $login->password = $pw;
                $login->login();
                $this->redirect("/coplat/index.php/application/portal");
                
                // Confirmation email for registration
                //$userfullName = $model->fname.' '.$model->lname;
                //$adminName = User::getCurrentUser();
                //User::sendConfirmationEmail($userfullName, $model->email,$model->username,$pw,$adminName->fname.' '.$adminName->lname);
                
                if($model->isProMentor)
                {
                    $proMentor = new ProjectMentor;
                    $proMentor->user_id = $model->id;
                    $proMentor->max_hours = 0;
                    $proMentor->max_projects = 0;
                    $proMentor->save(false);

                }
                if($model->isDomMentor)
                {
                    $domMentor = new DomainMentor();
                    $domMentor->user_id = $model->id;
                    $domMentor->max_tickets = 0;
                    $domMentor->save();
                }

                if($model->isPerMentor)
                {
                    $perMentor = new PersonalMentor();
                    $perMentor->user_id = $model->id;
                    $perMentor->max_hours =0 ;
                    $perMentor->max_mentees = 0;
                    $perMentor->save();


                }
            }
        }
        
        
        
        if(isset($_POST['Roles']))
        {
            $proMentor = ProjectMentor::model()->getProMentor($_COOKIE['UserID']);
            $perMentor = PersonalMentor::model()->getPerMentor($_COOKIE['UserID']);
            $domMentor = DomainMentor::model()->getDomMentor($_COOKIE['UserID']);

            //$model->save(false);
            $user = User::model()->findByPk($_COOKIE['UserID']);

            if($user->isProMentor ==1)
            {
                //$proMentor = new ProjectMentor;
                $proMentor->user_id = $user->id;
                $proMentor->max_hours =$_POST['pjmhours'] ;
                $all = Project::model()->findAll();
                $proMentor->save();

                $count =0;
                foreach ($all as $each)
                {
                    if(isset($_POST[$each->id.'pjm']))
                    {
                        $p = Project::model()->findByPk($each->id);
                        $p->project_mentor_user_id =$_COOKIE['UserID'];
                        $p->save(false);
                        $count++;
                    }

                }

                $proMentor->max_projects = $count;
                $proMentor->save();


            }

            if($user->isDomMentor ==1)
            {
                //UserDomain::model()->deleteAll("user_id = ".$user->id);


                $domMentor->max_tickets = $_POST['dmmaxtickets'];
                $domMentor->save();


                $all = Domain::model()->findAll();
                foreach ($all as $each)
                {


                    if(isset($_POST[$each->id]))
                    {
                        $user_domain = new UserDomain();
                        $user_domain->user_id = $domMentor->user_id;
                        $user_domain->domain_id= $each->id;
                        $user_domain->active=1;
                        $user_domain->save(false);


                        $allsubs = Subdomain::model()->findAllBySql("select * from subdomain where domain_id = $each->id");
                        if($allsubs!=null)
                        {
                            foreach( $allsubs as $onesub)
                            {
                                $temp = $onesub->id.'ddmsub';
                                if(isset($_POST[$temp]))
                                {
                                    $user_domain = new UserDomain();
                                    $user_domain->user_id = $domMentor->user_id;
                                    $user_domain->domain_id= $each->id;
                                    $user_domain->active=1;
                                    $rate = $each->id.'-'.$onesub->id.'dmrate';
                                    $tier = $each->id.'-'.$onesub->id.'dmtier';
                                    $user_domain->rate = $_POST[$rate];
                                    $user_domain->tier_team = $_POST[$tier];
                                    $user_domain->subdomain_id = $onesub->id;
                                    $user_domain->save(false);



                                }
                            }
                        } else
                        {
                            $user_domain = new UserDomain();
                            $user_domain->user_id = $domMentor->user_id;
                            $user_domain->domain_id= $each->id;
                            $user_domain->active=1;
                            $user_domain->save(false);


                        }



                    }

                }




            }
            if($user->isPerMentor)
            {
                //$perMentor = new PersonalMentor();
                $perMentor->user_id = $user->id;
                $perMentor->max_hours =$_POST['pmhours'] ;
                $all = Mentee::model()->findAll();
                $perMentor->save();

                $count =0;
                foreach ($all as $each)
                {
                    if(isset($_POST[$each->user_id.'pm']))
                    {
                        $p = Mentee::model()->findByPk($each->user_id);
                        $p->personal_mentor_user_id =$_COOKIE['UserID'];
                        $p->save(false);
                        $count++;
                    }

                }

                $perMentor->max_mentees = $count;
                $perMentor->save();



            }
			/* This is set up for a user being added by an admin
			 * 
            $hasher = new PasswordHash(8, false);
            $pw = $this->genRandomString(8);
            $user->password = $hasher->HashPassword($pw);
            $user->save(false);
            $userfullName = $user->fname.' '.$user->lname;
            $adminName = User::getCurrentUser();
            User::sendConfirmationEmail($userfullName, $user->email,$user->username,$pw,$adminName->fname.' '.$adminName->lname);
			*/

        }
        //$error = '';
        $this->render('create',array(
            'model'=>$model,'infoModel'=> $infoModel, 'error' => $error,
        ));
        return;

        //$this->render('add',array('model'=>$model, 'error' => $error));

    }
    

    public function actionRegister(){
    	$model=new User;
    	$model->username = "";
    	$model->password = "";
    	
    	$infoModel = new UserInfo;
    	$infoModel->user_id = $model->id;
    	
    	// Uncomment the following line if AJAX validation is needed
    	// $this->performAjaxValidation($model);
    	$error='';
    	$form = 'user-Register-form';
    	//If a new User has been successfully created e.g. the user has created an account from the register.php page
    	
    	if(isset($_POST['User']) && isset($_POST['UserInfo']))
    	{
    		/*if ($this->actionVerifyRegistration() != "") {
    		 $this->render('create', array('model'=>$model));
    		}*/
    			
    		echo("<script>console.log('New User Registered');</script>");
    		// auto-fill biography information
    		$model->attributes=$_POST['User'];
    		$model->pic_url = '/coplat/images/profileimages/default_pic.jpg';
    		$model->biography = "Tell us something about yourself...";
    		$model->activation_chain = $this->genRandomString(10);
    		$model->activated = 1;
    	
    	
    	
    		// hash entered password
    		$pw = $model->password;
    		$hasher = new PasswordHash(8, false);
    		$model->password = $hasher->HashPassword($model->password);
    	
    		$error1 = $this->verifyRegistration();
    		if($error1==null)
    		{
    	
    			$model->save(false);
    	
    			if(isset($_POST['UserInfo'])){
    				// get entered personal info
    				$infoModel->attributes=$_POST['UserInfo'];
    				$infoModel->user_id = $model->id;
    				$infoModel->save(false);
    			}
    	
    	
    			//newUserLogin($model, $pw);
    			$login = new LoginForm;
    			$login->username = $model->username;
    			$login->password = $pw;
    			$login->login();
    			$this->redirect("/coplat/index.php/application/portal");
    		}
    	}
    	
    	$this->render('register',array(
    			'model'=>$model,'infoModel'=> $infoModel, 'error' => $error,
    	));
    	return;
    }
    
    
    public function actionCreate_Admin()
    {

        echo ("<script>console.log('actionCreate_Admin');</script>");


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
        echo("<script>console.log('actionUpdate');</script>");


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

        echo("<script>console.log('actionIndex');</script>");

        $dataProvider=new CActiveDataProvider('User');
        $this->render('index',array('dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
    	$this->layout = '//layouts/column1';

        $model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User'])) {
            $model->attributes=$_GET['User'];
        }
        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    public function actionSearch()
    {
        echo("<script>console.log('actionSearch');</script>");

        $model=new User('search');
        $model->unsetAttributes();  // clear any default values
        
        if(isset($_GET['User'])) {
        	$model->attributes=$_GET['User'];
        }
        	
        $this->render('search',array(
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

    /*
        public function actionSendVerificationEmail($userfullName, $user_email){

            $admins = User::model()->findAllBySql("SELECT fname, lname, email FROM user inner join administrator on user.id = administrator.user_id WHERE user.disable = 0 and user.activated = 1");

            foreach($admins as $ad)
            {
                $adminfullName = $ad->fname.' '.$ad->lname;
                User::sendVerificationEmail($userfullName, $user_email, $adminfullName, $ad->email);
            }

            //$this->redirect('/coplat/index.php/site/page?view=verification');

        }*/

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

    public function verifyRegistration(){
        $user = $_POST['User'];
        $info = $_POST['UserInfo'];
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

        echo("<script>console.log('loadModel message!');</script>");


        $model=User::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public static function genRandomString($length) {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
        $string = "";
        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }



    public  function actionFindMentors()
    {
        $error = '';
        $domMentors= Yii::app()->db->createCommand("select u.id,sb.name as \"sname\", d.name as \"dname\",username  ,fname,lname,email,activated,disable


          from domain_mentor dm, user_domain ud, user u, subdomain sb, domain d

          where  dm.user_id=u.id and ud.user_id = u.id and ud.user_id = dm.user_id

		and sb.id = ud.subdomain_id and

		sb.domain_id = ud.domain_id and d.id = ud.domain_id")->queryAll();

        //$domMentors = User::model()->findAll();


        $filtersForm=new FiltersForm;
        if (isset($_GET['FiltersForm']))
            $filtersForm->filters=$_GET['FiltersForm'];

// Get rawData and create dataProvider
        $filteredData=$filtersForm->filter($domMentors);
        $dataProviderCompined = new CArrayDataProvider($filteredData, array(
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
        $this->render('findMentors',array('domMentors'=>$domMentors,'dataProviderCompined'=>$dataProviderCompined,
        		'filtersForm'=>$filtersForm,'error' => $error));

    }
    
    public function getTabs($form, $model){
    	$tabs = array(
					array(
					'active'=>true,
					'label'=>"Account",
					'content'=>$this->renderPartial('accountInfoForm', array('form'=>$form, 'model'=>$model), true)),
					array(
					'label'=>"Personal Info",
					'content'=>$this->renderPartial('personalInfoForm', array('form'=>$form, 'model'=>$model), true)),
				);
		return $tabs;
    }
    
public function actionUpdateUser()
{
   			$es = new EditableSaver('user');  //'User' is name of model to be updated
		    $es->update();
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


