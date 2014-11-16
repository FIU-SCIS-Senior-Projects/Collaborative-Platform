<?php

class ApplicationController extends Controller
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
				'actions'=>array('Personal'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','view'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionCreate()
	{
		$this->render('create');
	}

	public function actionDelete()
	{
		$this->render('delete');
	}

	public function actionImport()
	{
		$this->render('import');
	}

	public function actionUpdate()
	{
		$this->render('update');
	}

	public function actionView($id)
	{	
		$this->layout = '';
		$user_id = $id;
		
		// application personal mentor
		$personalMentor = $this->loadPersonalMentorByUser($user_id);
		$personalMentorHistory = null;
		$personalMentorChanges = null;
		if ($personalMentor != null){
		$personalMentorHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.user_id, t.approval_status, u.fname, u.lname
							FROM application_personal_mentor_pick t, user u
							WHERE t.user_id = u.id AND t.approval_status != "Proposed by Mentor" AND t.app_id = '.$personalMentor->id.'');
		
		$personalMentorChanges = new CSqlDataProvider('SELECT t.id, t.app_id, t.user_id, t.approval_status, u.fname, u.lname
							FROM application_personal_mentor_pick t, user u
							WHERE t.user_id = u.id AND t.approval_status = "Proposed by Mentor" AND t.app_id = '.$personalMentor->id.'');
		}
		
		// application project mentor
		$projectMentor = $this->loadProjectMentorByUser($user_id);
		$projectMentorHistory = null;
		$projectMentorChanges = null;
		if ($projectMentor != null){
		$projectMentorHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.project_id, t.approval_status, p.title
										FROM application_project_mentor_pick t, project p
										WHERE t.project_id = p.id AND t.approval_status != "Proposed by Mentor" AND t.app_id = '.$projectMentor->id.'');
		
		
		$projectMentorChanges = new CSqlDataProvider('SELECT t.id, t.app_id, t.project_id, t.approval_status, p.title
										FROM application_project_mentor_pick t, project p
										WHERE t.project_id = p.id AND t.approval_status = "Proposed by Mentor" AND t.app_id = '.$projectMentor->id.'');
		}
		
		// application domain mentor
		$domainMentor = $this->loadDomainMentorByUser($id);
		$domainHistory = null;
		$domainChanges= null;
		$subdomainHistory = null;
		$subdomainChanges = null;
		if ($projectMentor != null){
		$domainHistory = new CSqlDataProvider('SELECT * FROM application_domain_mentor_pick t
				WHERE t.approval_status != "Proposed by Mentor" AND t.app_id = '.$domainMentor->id.'');
		
		
		$domainChanges = new CSqlDataProvider('SELECT * FROM application_domain_mentor_pick t
				WHERE t.approval_status = "Proposed by Mentor" AND t.app_id = '.$domainMentor->id.'');
		
		$subdomainHistory = new CSqlDataProvider('SELECT * FROM application_subdomain_mentor_pick t
				WHERE t.approval_status != "Proposed by Mentor" AND t.app_id = '.$domainMentor->id.'');
		
		$subdomainChanges = new CSqlDataProvider('SELECT * FROM application_subdomain_mentor_pick t
				WHERE t.approval_status = "Proposed by Mentor" AND t.app_id = '.$domainMentor->id.'');
		}
		
		// render view
		$this->render('view', array('user_id'=>$user_id, 
				'personalMentor'=>$personalMentor,'personalMentorHistory'=>$personalMentorHistory,'personalMentorChanges'=>$personalMentorChanges,
				'projectMentor'=>$projectMentor,'projectMentorHistory'=>$projectMentorHistory,'projectMentorChanges'=>$projectMentorChanges,
				'domainMentor'=>$domainMentor, 'domainHistory'=>$domainHistory,'domainChanges'=>$domainChanges,
				'subdomainHistory'=>$subdomainHistory,'subdomainChanges'=>$subdomainChanges,
				
		));
	}
	
	public function loadPersonalMentorByUser($id)
	{
		$params = array('user_id'=>$id);
		$model=ApplicationPersonalMentor::model()->findByAttributes($params);
		return $model;
	}
	public function loadProjectMentorByUser($id)
	{
		$params = array('user_id'=>$id);
		$model=ApplicationProjectMentor::model()->findByAttributes($params);
		return $model;
	}
	
	public function loadDomainMentorByUser($id)
	{
		$params = array('user_id'=>$id);
		$model=ApplicationDomainMentor::model()->findByAttributes($params);
		return $model;
	}
	
	
	
	public function actionAdmin()
	{ 
		
		$dataprovider = new CSqlDataProvider('Select id , a.date_created, fname, lname from (SELECT * FROM
			(
			    (SELECT user_id, date_created FROM application_domain_mentor WHERE status="Admin")
			    UNION
			    (SELECT user_id, date_created FROM application_personal_mentor WHERE status="Admin")
			    UNION
			    (SELECT user_id, date_created FROM application_project_mentor WHERE status="Admin")
			) as c GROUP BY c.user_id)
											a, user u WHERE a.user_id = u.id ORDER BY a.date_created DESC');
			
			$this->render('admin',array('dataprovider'=>$dataprovider));	
	}
	
	/*
	 * Renders the mentor application portal
	 */
	public function actionPortal(){
		$this->render('portal');
	}
	
	/*
	 *  Personal Mentor Application
	 */
	public function actionPersonal(){
		$model = new ApplicationPersonalMentor;
		$user = User::model()->getCurrentUser();
		$mentees = new User('search');
		$mentees->unsetAttributes();
		$mentees->isMentee = 1;
		$mypicks = new User;
		$mypicks->unsetAttributes();
		
		$model->user_id = $user->id;
		$model->status = 0;
		$error='';
		
		$this->render('personal', array(
            'model'=>$model, 'search'=>$mentees, 'mypicks'=>$mypicks, 'error' => $error,
        ));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}