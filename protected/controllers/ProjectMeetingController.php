<?php

class ProjectMeetingController extends Controller
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
				'actions'=>array('index','view','adminViewMeetings','pMentorViewMeetings','pMenteeViewMeetings'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','adminViewMeetings','pMentorViewMeetings','pMenteeViewMeetings'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','adminViewMeetings','pMentorViewMeetings','pMenteeViewMeetings'),
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
		$model=new ProjectMeeting;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProjectMeeting']))
		{
			$model->attributes=$_POST['ProjectMeeting'];
            $model->project_mentor_user_id = $id;

            if($model->save()) {

                User::sendMeetingNotification($model->project_mentor_user_id, $model->mentee_user_id,
                    $model->date, $model->time);
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

		if(isset($_POST['ProjectMeeting']))
		{
			$model->attributes=$_POST['ProjectMeeting'];
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
		$dataProvider=new CActiveDataProvider('ProjectMeeting');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    /**
     * Lists all models.
     */

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ProjectMeeting('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProjectMeeting']))
			$model->attributes=$_GET['ProjectMeeting'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ProjectMeeting the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ProjectMeeting::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ProjectMeeting $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-meeting-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


    /*Implemented by Lorenzo Sanchez */
    public function actionadminViewMeetings()
    {
        /** @var  User $user */
        $username = Yii::app()->user->name;

        $user = User::model()->find("username=:username", array(':username' => $username));

        /*Return all the meetings for the current user */
        /** @var ProjectMeeting $meetings */
        $meetings = ProjectMeeting::model()->findAll();
        /*mentee array */
        $mentees = array();
        /** @var User $mentee */
        foreach ($meetings as $id => $meetin) {
            $mentees[$id] = User::model()->findBySql("SELECT * FROM user WHERE id =:id", array(":id" => $meetin->mentee_user_id));
        }
        /*Return all the projects in the system*/
        $projects = Project::model()->findAll();

        /* Return all the mentees for the project mentor */
        /** @var Projectmentor_project $projectmentor_project */
        /*$projectmentor_project = Project::model()->findAll(); */

        $pmentees = array();

        foreach ($projects as $pm) {
           /** @var ProjectMentorProject $pm */
            $allMentees = Mentee::model()->findAllBySql("SELECT * FROM mentee WHERE project_id=:id", array(":id" => $pm->id));
            foreach ($allMentees as $i => $m) {
                $pmentees[$pm->id][$m->user_id] = $m;
            }
        }

        $pmentee = array();
        foreach ($pmentees as $pment) {
            foreach ($pment as $pm) {
                $pmentee[$pm->user_id] = User::model()->findBySql("SELECT * FROM user WHERE id=:id", array(":id" => $pm->user_id));
            }
        }

        /*return the mentees for each project */
        foreach ($projects as $project) {
            /** @var Project $project */

            $project->description .= sprintf("<h4>Mentees</h4><ul>");
            foreach ($pmentees[$project->id] as $projectMenteeId=>$menteeObject) {
                $project->description .= sprintf("<li>%s</li>", $pmentee[$projectMenteeId]);
            }
            $project->description .= sprintf("</ul>");
        }

        /** @var User $usermentee */

        /* End Return all the mentees for the project mentor */

        $this->render('adminViewMeetings', array( /*'menteeName' => $menteeName,*/
            'user' => $user,
            'meetings' => $meetings,
            'projects' => $projects,
            'pmentee' => $pmentee,
            'mentees' => $mentees,
        ));
    }

    /*Implemented by Lorenzo Sanchez */
    public function actionpMentorViewMeetings()
    {
        /** @var  User $user */
        $username = Yii::app()->user->name;

        $user = User::model()->find("username=:username", array(':username' => $username));

        /*Return all the meetings for the current user */
        /** @var ProjectMeeting $meetings */
        $meetings = ProjectMeeting::model()->findAllBySql("SELECT * FROM project_meeting WHERE project_mentor_user_id =:id ORDER BY `date` ASC", array(":id" => $user->id));
        /*mentee array */
        $mentees = array();
        /** @var User $mentee */
        foreach ($meetings as $id => $meetin) {
            $mentees[$id] = User::model()->findBySql("SELECT * FROM user WHERE id =:id", array(":id" => $meetin->mentee_user_id));
        }
        /*Return all the projects for the current Project Mentor */
        $projects = Project::model()->findAll("project_mentor_user_id=:mentor_id", array(':mentor_id' => $user->id));

        /*  */
        /* Return all the mentees for the project mentor */
        /** @var Projectmentor_project $projectmentor_project */
        $pmentees = array();

        foreach ($projects as $pm) {
            //$pmentees = Mentee::model()->findAll("projectmentor_project_id=:id", array(":id"=>$pm->id));

            /** @var ProjectMentorProject $pm */
            $allMentees = Mentee::model()->findAllBySql("SELECT * FROM mentee WHERE project_id=:id", array(":id" => $pm->id));
            foreach ($allMentees as $i => $m) {
                $pmentees[$pm->id][$m->user_id] = $m;
            }
        }

        $pmentee = array();
        foreach ($pmentees as $pment) {
            foreach ($pment as $pm) {
                $pmentee[$pm->user_id] = User::model()->findBySql("SELECT * FROM user WHERE id=:id", array(":id" => $pm->user_id));
            }
        }

        /*Get all tickets for his mentees */
        $tickets = array();
        foreach($pmentee as  $id=>$menteeTickets){
            $myTickets = Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE creator_user_id=:id and assign_user_id!=:id2",
                array(':id'=>$menteeTickets->id, ':id2'=>User::getCurrentUserId()));
            if(is_array($myTickets)) {
                $tickets = array_merge($tickets, $myTickets);
            }
        }


        /* Popover */
        foreach ($projects as $project) {
            /** @var Project $project */

            $project->description .= sprintf("<h4>Mentees</h4><ul>");
            foreach ($pmentees[$project->id] as $projectMenteeId => $menteeObject) {
                $project->description .= sprintf("<li>%s</li>", $pmentee[$projectMenteeId]);
            }
            $project->description .= sprintf("</ul>");
        }

        /** @var User $usermentee */

        /* End Return all the mentees for the project mentor */

        $this->render('pMentorViewMeetings', array( /*'menteeName' => $menteeName,*/
            'user' => $user,
            'meetings' => $meetings,
            'projects' => $projects,
            'pmentee' => $pmentee,
            'mentees' => $mentees,
            'tickets' => $tickets,
        ));
    }

    /*Implemented by Lorenzo Sanchez */
    public function actionpMenteeViewMeetings()
    {
        /** @var  User $user */
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));

        /*Return all the meetings for the current user */
        /** @var ProjectMeeting $meetings */
        $meetings = ProjectMeeting::model()->findAllBySql("SELECT * FROM project_meeting WHERE mentee_user_id =:id ORDER BY `date` ASC", array(":id" => $user->id));

        /*mentee array */
        $mentees = array();
        /** @var User $mentee */
        foreach ($meetings as $id => $meetin) {
            $mentees[$id] = User::model()->findBySql("SELECT * FROM user WHERE id =:id OR id =:iid", array(":id" => $meetin->mentee_user_id,
                                                        ":iid"=>$meetin->project_mentor_user_id));
        }


        /*Return all the projects for the current Project Mentor */
        $pro = Mentee::model()->find("user_id=:id", array(':id'=>$user->id));

        $projects = Project::model()->findAll("id=:project_id", array(':project_id' => $pro->project_id));

        /* Return all the mentees for the project mentor */
        $pmentees = array();
        foreach ($projects as $pm) {

            /** @var ProjectMentorProject $pm */
            $allMentees = Mentee::model()->findAllBySql("SELECT * FROM mentee WHERE project_id=:id", array(":id" => $pm->id));
            foreach ($allMentees as $i => $m) {
                $pmentees[$pm->id][$m->user_id] = $m;
            }
        }

        $pmentee = array();
        foreach ($pmentees as $pment) {
            foreach ($pment as $pm) {
                $pmentee[$pm->user_id] = User::model()->findBySql("SELECT * FROM user WHERE id=:id", array(":id" => $pm->user_id));
            }
        }

        foreach ($projects as $project) {
            /** @var Project $project */

            $project->description .= sprintf("<h4>Mentees</h4><ul>");
            foreach ($pmentees[$project->id] as $projectMenteeId => $menteeObject) {
                $project->description .= sprintf("<li>%s</li>", $pmentee[$projectMenteeId]);
            }
            $project->description .= sprintf("</ul>");
        }

        /** @var User $usermentee */

        /* End Return all the mentees for the project mentor */

        $this->render('pMenteeViewMeetings', array( /*'menteeName' => $menteeName,*/
            'user' => $user,
            'meetings' => $meetings,
            'projects' => $projects,
            'pmentee' => $pmentee,
            'mentees' => $mentees,
        ));
    }

}
