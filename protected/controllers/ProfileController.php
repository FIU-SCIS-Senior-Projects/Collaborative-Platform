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


            $uploadedFile = CUploadedFile::getInstance($model, 'pic_url'); /*Attach file */
            $fileName = "{$uploadedFile}";
            if ($fileName != null) {
                /*Save file uploaded in the Uploads folder */
                $model->pic_url = '/coplat/images/profileimages/' . $fileName;
                $uploadedFile->saveAs(Yii::getPathOfAlias('webroot') . '/images/profileimages/' . $fileName);

            }


            $model->save(false);

            if($model->isProMentor == 1)
            {
                echo $_POST['proHours'];
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
                $permentor->max_hours = $_POST['pmenHours'];
                $permentor->max_mentees = $_POST['numMentees'];
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
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        $projects = Project::model()->findAllBySql("SELECT title FROM project WHERE project_mentor_user_id=$user->id");
        $userdoms = UserDomain::model()->findAllBySql("SELECT distinct domain_id FROM user_domain WHERE user_id=$user->id");
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
