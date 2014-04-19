<?php

class ProfileController extends Controller
{
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
                'actions' => array('create', 'update', 'userProfile', 'editProfile', 'testForm', 'test'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionuserProfile()
    {
        $model = User::getCurrentUser();
        $promentor = ProjectMentor::getCurrentUser();
        $permentor = PersonalMentor::getCurrentUser();
        $dommentor = DomainMentor::getCurrentUser();
        
        
        if(isset($_POST['submit']))
        {
            $model->biography = $_POST['biography'];
            $model->save(false);
            /*if(isset($_POST['photo']))
            {
                  $image = $_POST['photo'];
                  //Stores the filename as it was on the client computer.
                  $imagename = $_FILES['photo']['name'];
                  //Stores the filetype e.g image/jpeg
                  $imagetype = $_FILES['photo']['type'];
                  //Stores any error codes from the upload.
                  $imageerror = $_FILES['photo']['error'];
                  //Stores the tempname as it is given by the host when uploaded.
                  $imagetemp = $_FILES['photo']['tmp_name'];

                  //The path you wish to upload the image to
                  $imagePath = "/coplat/images/profileimages/";

                  if(is_uploaded_file($imagetemp)) {
                      if(move_uploaded_file($imagetemp, $imagePath . $imagename)) {
                          echo "Sussecfully uploaded your image.";
                      }
                      else {
                          echo "Failed to move your image.";
                      }
                  }
                  else {
                      echo "Failed to upload your image.";
                  }
            }*/
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
                        $curr = Project::model()->findbysql("SELECT * FROM project WHERE project_mentor_user_id=$model->id");
                        for($i = 0; $i < count($pro); $i++)
                        {
                            //while($promentor->max_projects > count($curr))
                            //{
                                $p = Project::model()->findBySql("SELECT * FROM project WHERE title='$pro[$i]'");
                                $p->project_mentor_user_id = $model->id;
                                $p->save();
                                //$p->update("UPDATE project SET mentor_id=$model->id");
                            //}
                        }
                        //$p = Project::model()->findBySql("SELECT * FROM project WHERE title='$pro[0]'");
                        //var_dump($p);
                        //$p->mentor_id = $model->id;
                        //$p->update("UPDATE project SET mentor_id=$model->id");
                        
                        //$p = Project::getProject($pro[0]);
                        //echo $id->id;
                     }
                 }
            }
            
            if($model->isPerMentor == 1)
            {
                $permentor->max_hours = $_POST['pmenHours'];
                $permentor->max_mentees = $_POST['numMentees'];
                $permentor->save();
                
                if(isset($_POST['mentees']))
                {
                    $men = $_POST['mentees'];
                    for($i = 0; $i < count($men); $i++)
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
                //$dommentor->update("UPDATE domain_mentor SET max_tickets-$dommentor->max_tickets WHERE user_id=$model->id");
            }
            //$model->update("UPDATE user SET biography=$model->biography WHERE user_id=$model->id");
        }
        
        /** @var User $username */
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        $projects = Project::model()->findAllBySql("SELECT title FROM project WHERE project_mentor_user_id=$user->id");
        $userdoms = UserDomain::model()->findAllBySql("SELECT domain_id FROM user_domain WHERE user_id=$user->id");
        $Mentees = Mentee::model()->findAllBySql("SELECT user_id FROM mentee WHERE personal_mentor_user_id=$user->id");
        $Tickets= Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE assign_user_id=:id", array(":id"=>$user->id));

        $this->render('userProfile', array('Tickets' => $Tickets, 'user'=> $user, 'userdoms' => $userdoms, 'Mentees' => $Mentees, 'projects' => $projects));    
        }
        
    public function actioneditProfile()
    {
        /** @var User $username */
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        $projects = Project::model()->findAllBySql("SELECT title FROM project WHERE project_mentor_user_id IS NULL");
        $userdoms = UserDomain::model()->findAllBySql("SELECT domain_id FROM user_domain WHERE user_id=$user->id");
        $Mentees = Mentee::model()->findAllBySql("SELECT user_id FROM mentee WHERE personal_mentor_user_id IS NULL");
        $Tickets= Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE assign_user_id=:id", array(":id"=>$user->id));

        $this->render('editProfile', array('Tickets' => $Tickets, 'user'=> $user, 'userdoms' => $userdoms, 'Mentees' => $Mentees, 'projects' => $projects));  
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
