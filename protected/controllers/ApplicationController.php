<?php

class ApplicationController extends Controller
{

	//public $layout='//layouts/column2';

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

	public function actionView($id)
	{	
		$this->layout = '';
		$user_id = $id;
		
		// application personal mentor
		$personalMentor = $this->loadPersonalMentorByUser($user_id);
		$personalMentorHistory = null;
		$personalMentorChanges = null;
		$personalCount = 0;
		if ($personalMentor != null){
					
				$personalMentorHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.user_id, t.approval_status, u.fname, u.lname
						FROM application_personal_mentor_pick t, user u
						WHERE t.user_id = u.id AND t.approval_status != "Proposed by Mentor" AND t.app_id = '.$personalMentor->id.'');
				
				$personalMentorChanges = new CSqlDataProvider('SELECT t.id, t.app_id, t.user_id, t.approval_status, u.fname, u.lname
						FROM application_personal_mentor_pick t, user u
						WHERE t.user_id = u.id AND t.approval_status = "Proposed by Mentor" AND t.app_id = '.$personalMentor->id.'');
				
				$personalCount = Yii::app()->db->createCommand()->
						select('count(*)')->
						from('application_personal_mentor_pick')->
						where('app_id =:id', array(':id'=>$personalMentor->id))->
						andWhere('approval_status = "Proposed by Mentor"')->
						queryScalar();
				
		}
		
		// application project mentor
		$projectMentor = $this->loadProjectMentorByUser($user_id);
		$projectMentorHistory = null;
		$projectMentorChanges = null;
		$projectCount = 0;
		if ($projectMentor != null){
				$projectMentorHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.project_id, t.approval_status, p.title
						FROM application_project_mentor_pick t, project p
						WHERE t.project_id = p.id AND t.approval_status != "Proposed by Mentor" AND t.app_id = '.$projectMentor->id.'');
				
				
				$projectMentorChanges = new CSqlDataProvider('SELECT t.id, t.app_id, t.project_id, t.approval_status, p.title
						FROM application_project_mentor_pick t, project p
						WHERE t.project_id = p.id AND t.approval_status = "Proposed by Mentor" AND t.app_id = '.$projectMentor->id.'');
				
				$projectCount = Yii::app()->db->createCommand()->
						select('count(*)')->
						from('application_project_mentor_pick')->
						where('app_id =:id', array(':id'=>$projectMentor->id))->
						andWhere('approval_status = "Proposed by Mentor"')->
						queryScalar();
		
		}
		
		// application domain mentor
		$domainMentor = $this->loadDomainMentorByUser($id);
		$domainHistory = null;
		$domainChanges= null;
		$domainCount = 0;
		$subdomainHistory = null;
		$subdomainChanges = null;
		$subdomainCount = 0;
		if ($projectMentor != null){
			
				$domainHistory = new CSqlDataProvider('SELECT * FROM application_domain_mentor_pick t
						WHERE t.approval_status != "Proposed by Mentor" AND t.app_id = '.$domainMentor->id.'');
				
				
				$domainChanges = new CSqlDataProvider('SELECT * FROM application_domain_mentor_pick t
						WHERE t.approval_status = "Proposed by Mentor" AND t.app_id = '.$domainMentor->id.'');
				
				$domainCount = Yii::app()->db->createCommand()->
						select('count(*)')->
						from('application_domain_mentor_pick')->
						where('app_id =:id', array(':id'=>$domainMentor->id))->
						andWhere('approval_status = "Proposed by Mentor"')->
						queryScalar();
						
				$subdomainHistory = new CSqlDataProvider('SELECT * FROM application_subdomain_mentor_pick t
						WHERE t.approval_status != "Proposed by Mentor" AND t.app_id = '.$domainMentor->id.'');
				
				$subdomainChanges = new CSqlDataProvider('SELECT * FROM application_subdomain_mentor_pick t
						WHERE t.approval_status = "Proposed by Mentor" AND t.app_id = '.$domainMentor->id.'');
				
				$subdomainCount = Yii::app()->db->createCommand()->
						select('count(*)')->
						from('application_subdomain_mentor_pick')->
						where('app_id =:id', array(':id'=>$domainMentor->id))->
						andWhere('approval_status = "Proposed by Mentor"')->
						queryScalar();
		}
		
		$newCount = $personalCount + $projectCount + $domainCount + $subdomainCount;
		
		// render view
		$this->render('view', array('user_id'=>$user_id, 
				'personalMentor'=>$personalMentor,'personalMentorHistory'=>$personalMentorHistory,'personalMentorChanges'=>$personalMentorChanges,
				'projectMentor'=>$projectMentor,'projectMentorHistory'=>$projectMentorHistory,'projectMentorChanges'=>$projectMentorChanges,
				'domainMentor'=>$domainMentor, 'domainHistory'=>$domainHistory,'domainChanges'=>$domainChanges,
				'subdomainHistory'=>$subdomainHistory,'subdomainChanges'=>$subdomainChanges,
				'newCount'=>$newCount,
				
		));
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
		$students = new User;
		$unis = array();
		
		if (Yii::app()->getRequest()->isPostRequest) {
			$user = User::model()->getCurrentUser();		
			$model->attributes = $_POST['ApplicationPersonalMentor'];
			$model->status = 'Admin';
			$model->user_id = $user->id;
			$model->date_created = new CDbExpression('NOW()');
			if($model->university_id === 0) $model->university_id = NULL;
			$model->save(false);
			
			$mypicks = $_POST['picks'];
			$mypicks = explode(',', $mypicks);
			foreach($mypicks as $pick){
				$dbpick = new ApplicationPersonalMentorPick;
				$dbpick->app_id = $model->id;
				$dbpick->user_id = $pick;
				$dbpick->approval_status = 'Proposed by Mentor';
				$dbpick->save(false);
			}	
			$this->redirect("/coplat/index.php/application/portal");
		} else { // on initial load
			$students->unsetAttributes();
			$students->isMentee = 1;
			$student = User::model()->returnUsersForApp($students->searchNoPagination());
			$universities = University::model()->getUniversities();
			$unis[0] = 'Any';
			foreach ($universities as $uni) $unis[$uni->id] = $uni->name;
			$model->system_pick_amount = 0;
		}
		
		$error='';
		
		$this->render('personal', array(
            'model'=>$model, 'user'=>$students, 'universities'=>$unis, 'students'=>$student, 'error' => $error,
        ));
	}
	
	/*
	 *  Project Mentor Application
	*/
	public function actionProject(){
		$application = new ApplicationProjectMentor;
		$projects = new Project;
		
		if (Yii::app()->getRequest()->isPostRequest) {
			$user = User::model()->getCurrentUser();
			$application->attributes = $_POST['ApplicationProjectMentor'];
			$application->status = 'Admin';
			$application->user_id = $user->id;
			$application->date_created = new CDbExpression('NOW()');
			$application->save(false);
			
			$mypicks = $_POST['picks'];
			$mypicks = explode(',', $mypicks);
			foreach($mypicks as $pick){
				$dbpick = new ApplicationProjectMentorPick;
				$dbpick->app_id = $application->id;
				$dbpick->project_id = $pick;
				$dbpick->approval_status = 'Proposed by Mentor';
				$dbpick->save(false);
			}
			$this->redirect("/coplat/index.php/application/portal");
		} else { // on initial load
			$projects->unsetAttributes();
			$projects->project_mentor_user_id = 999;
			$project = Project::model()->getProjectsForApp($projects->searchNoPagination());
			$application->system_pick_amount = 0;
		}
		
		$error='';
		
		$this->render('project', array(
				'application'=>$application, 'data'=>$project, 'error' => $error,
		));
	}
	
	public function actionDomain(){
		$application = new ApplicationDomainMentor;
		$domains = new Domain;
		$subdomains = new Subdomain;
		
		if (Yii::app()->getRequest()->isPostRequest) {

			$this->redirect("/coplat/index.php/application/portal");
		} else { // on initial load
			$domains->unsetAttributes();
			$domain = Domain::model()->getDomainsForApp($domains->searchNoPagination());
		}
		
		$error='';
		
		$this->render('domain', array(
				'application'=>$application, 'domain'=>$domain, 'error' => $error,
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
	
	// Toggle catch
	public function actions()
	{	
		return array(
				'toggle' => array(
						'class'=>'booster.actions.TbToggleAction',
						'modelName' => 'User',
				),
		);
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

?>