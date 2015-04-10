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
				'actions'=>array('admin','view', 'adminpersonal', 'viewhistory'),
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
	
	public function actionViewHistory(){
		$model = new ApplicationClosed();
		$isAdmin = User::isCurrentUserAdmin();
		if (!$isAdmin)
			$model->user_id = User::getCurrentUserId();
		
		
		
		$this->render('viewhistory',array('model'=>$model));
		
	}
	
	public function actionHistory($id){
		
		$model = ApplicationClosed::model()->findByPk($id);
		
		$personalMentorHistory = null;
		$projectMentorHistory = null;
		$domainHistory = null;
		$subdomainHistory = null;
		
		
		if (!is_null($model->app_personal_mentor_id)){
			$personalMentorHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.user_id, t.approval_status, u.fname, u.lname
				FROM application_personal_mentor_pick t, user u
				WHERE t.user_id = u.id AND (t.approval_status = "Approved" OR t.approval_status = "Rejected")
				AND t.app_id = '.$model->app_personal_mentor_id.'');
		}
		
		if (!is_null($model->app_project_mentor_id)){
		$projectMentorHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.project_id, t.approval_status, p.title
								FROM application_project_mentor_pick t, project p
								WHERE t.project_id = p.id AND (t.approval_status = "Approved" OR t.approval_status = "Rejected")
								AND t.app_id = '.$model->app_project_mentor_id.'');
		}
		
		if (!is_null($model->app_domain_mentor_id)){
		$domainHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.domain_id, t.proficiency, t.approval_status, d.name
								FROM application_domain_mentor_pick t, domain d
								WHERE (t.approval_status = "Approved" OR t.approval_status = "Rejected") 
									AND t.domain_id = d.id AND t.app_id = '.$model->app_domain_mentor_id.'');
		}
		
		if (!is_null($model->app_domain_mentor_id)){
			$subdomainHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.subdomain_id, t.proficiency, t.approval_status, d.name as "dname", s.name as "sname"
				FROM application_subdomain_mentor_pick t, subdomain s, domain d
				WHERE (t.approval_status = "Approved" OR t.approval_status = "Rejected")
					AND s.domain_id = d.id AND s.id = t.subdomain_id AND t.app_id = '.$model->app_domain_mentor_id.'');
		}
		
			$this->render('history', array('personalHistory'=>$personalMentorHistory,
									'projectHistory'=>$projectMentorHistory,
									'domainHistory'=>$domainHistory,
									'subdomainHistory'=>$subdomainHistory,
			));
		
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
	
	function updateAppStatus($model, $status){
		$model->status = $status;
		$model->save();
	}
	
	function updatePickStatus($model, $status){
		$model->approval_status = $status;
		$model->save();
	}
	
	function loadPersonalPick($id){
		$model = ApplicationPersonalMentorPick::model()->findByPk($id);
		return $model;
	}
	function loadProjectPick($id){
		$model=ApplicationProjectMentorPick::model()->findByPk($id);
		return $model;
	}
	function loadDomainPick($id){
		$model=ApplicationDomainMentorPick::model()->findByPk($id);
		return $model;
	}
	function loadSubDomainPick($id){
		$model=ApplicationSubdomainMentorPick::model()->findByPk($id);
		return $model;
	}
	function loadProject($id){
		$model=Project::model()->findByPk($id);
		return $model;
	}
	function loadUser($id){
		$model=User::model()->findByPk($id);
		return $model;
	}
	function isNewEntry($user_id, $table){
		return Yii::app()->db->createCommand()->
		select('count(*)')->
		from($table)->
		where('user_id =:id', array(':id'=>$user_id))->
		queryScalar();
	}
	

	public function actionView($id)
	{	
		//$this->layout = '';
		$user_id = $id;
		$perModel = new ApplicationPersonalMentorPick();
		$proModel = new ApplicationProjectMentorPick();
		$domModel = new ApplicationDomainMentorPick();
		$subModel = new ApplicationSubdomainMentorPick();
		
		
		if (Yii::app()->getRequest()->isPostRequest) {
			
			$newPick = false;
		
			if(isset($_POST['ApplicationPersonalMentorPick']))
			{
				$temp = $this->loadPersonalMentorByUser($user_id);
				$perModel->attributes=$_POST['ApplicationPersonalMentorPick'];
				$perModel->app_id = $temp->id;
				$perModel->approval_status = "Proposed by Admin";
				$perModel->save();
				$perModel->unsetAttributes();
				$newPick = true;
				// render new form after post
			}else if(isset($_POST['ApplicationProjectMentorPick']))
			{
				$temp = $this->loadProjectMentorByUser($user_id);
				$proModel->attributes=$_POST['ApplicationProjectMentorPick'];
				$proModel->app_id = $temp->id;
				$proModel->approval_status = "Proposed by Admin";
				$proModel->save();
				$proModel->unsetAttributes();
				$newPick = true;
			} else if(isset($_POST['ApplicationDomainMentorPick']))
			{
				$temp = $this->loadDomainMentorByUser($user_id);
				$domModel->attributes=$_POST['ApplicationDomainMentorPick'];
				$domModel->app_id = $temp->id;
				$domModel->approval_status = "Proposed by Admin";
				$domModel->save();
				$domModel->unsetAttributes();
				$newPick = true;
			} else if(isset($_POST['ApplicationSubdomainMentorPick']))
			{
				$temp = $this->loadDomainMentorByUser($user_id);
				$subModel->attributes=$_POST['ApplicationSubdomainMentorPick'];
				$subModel->app_id = $temp->id;
				$subModel->approval_status = "Proposed by Admin";
				$subModel->save();
				$subModel->unsetAttributes();
				$newPick = true;
			}
		
			// if picks need to be determined and its not a propose POST
			if (!$newPick){
				$projectFlag = false;
				$personalFlag = false;
				$domainFlag = false;
				
				$domApp = $this->loadDomainMentorByUser($user_id);
				$persApp = $this->loadPersonalMentorByUser($user_id);
				$projApp = $this->loadProjectMentorByUser($user_id);
				
	
// PERSONAL PICKS ACCEPT
				$mypicks = $_POST['personal_picks_accept'];
				
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
					
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadPersonalPick($pick);
						$this->updatePickStatus($actualPick, 'Approved');
						
						// create new entry
						$mentee = new PersonalMentorMentees('add_new');
						$mentee->user_id = $actualPick->user_id; // mentee id
						$mentee->personal_mentor_id = $user_id; // mentor id
						$mentee->save();
						
					}
					
					// add entry to personal_mentor
					$personalEntry = $this->isNewEntry($user_id, 'personal_mentor');
						
					// if it already exists do NOTHING . change here with else statement to perform update
					if ($personalEntry < 1){
						// add entry to personal_mentor
						$pementor = new PersonalMentor('add_new');
						$pementor->user_id = $user_id;
						$pementor->max_hours = $persApp->max_hours;
						$pementor->max_mentees = $persApp->max_amount;
						$pementor->save();
					} // else UPDATE
					
					$personalFlag = true;
					//$loaduser->isPerMentor = 1;
					
				}
				
// PERSONAL PICKS REJECT
				$mypicks = $_POST['personal_picks_reject'];
				
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
					
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadPersonalPick($pick);
						$this->updatePickStatus($actualPick, 'Rejected');
					}
					
					$personalFlag = true;
					
				}
				
	// PROJECT PICKS ACCEPT	
				$mypicks = $_POST['project_picks_accept'];
					
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
					
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadProjectPick($pick);
						$this->updatePickStatus($actualPick, 'Approved');
						
						// update entry NO LONGER USED AS WE NOW HAVE MULTIPLE PROJECTS
						//$project = new ProjectMentorProjects('add_new');
						//$project->user_id = $user_id;
						//$project->project_id = $actualPick->project_id;
						$project = $this->loadProject($actualPick->project_id);
						$project->project_mentor_user_id = $user_id;
						$project->save();
						
					}
					
					// add entry to project_mentor
					$projectEntry = $this->isNewEntry($user_id, 'project_mentor');
					
					// if it already exists do NOTHING . change here with else statement to perform update
					if ($projectEntry < 1){
						// add entry to project_mentor
						$promentor = new ProjectMentor('add_new');
						$promentor->user_id = $user_id;
						$promentor->max_hours = $projApp->max_hours;
						$promentor->max_projects = $projApp->max_amount;
						$promentor->save();
					} // else UPDATE
					
					$projectFlag = true;
					//$loaduser->isProMentor = 1;
				}
				
	// PROJECT PICKS REJECT			
				$mypicks = $_POST['project_picks_reject'];
				
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
					
					foreach($mypicks as $pick){
						$actualPick = $this->loadProjectPick($pick);
						$this->updatePickStatus($actualPick, 'Rejected');
					}
					
					$projectFlag = true;				
				}
				
	// DOMAIN PICKS ACCEPT		
				$mypicks = $_POST['domain_picks_accept'];
				
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
					
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadDomainPick($pick);
						$this->updatePickStatus($actualPick, 'Approved');
						
						// create new entry
						$domain = new UserDomain('add_new');
						$domain->user_id = $user_id;
						$domain->domain_id = $actualPick->domain_id;
						$domain->rate = $actualPick->proficiency;
						$domain->active = 1;
						$domain->tier_team = 1;
						$domain->save();
					}
					
					$domainFlag = true;
					//$loaduser->isDomMentor = 1;
				}
				
	// DOMAIN PICKS REJECT			
				$mypicks = $_POST['domain_picks_reject'];
				
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
					
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadDomainPick($pick);
						$this->updatePickStatus($actualPick, 'Rejected');
					}
					
					$domainFlag = true;
				}
				
	// SUBDOMAIN PICKS ACCEPT			
				$mypicks = $_POST['subdomain_picks_accept'];
				
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
					
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadSubDomainPick($pick);
						$this->updatePickStatus($actualPick, 'Approved');
						
						//create new entry
						$subdomain = new UserDomain('add_new');
						$subdomain->user_id = $user_id;
						$subdomain->domain_id = $actualPick->subdomain->domain->id;
						$subdomain->subdomain_id = $actualPick->subdomain_id;
						$subdomain->rate = $actualPick->proficiency;
						$subdomain->active = 1;
						$subdomain->tier_team = 1;
						$subdomain->save();
					}
					
					
					$domainFlag = true;
					//$loaduser->isDomMentor = 1;
					
				}
				
	// SUBDOMAIN PICKS REJECT	
				$mypicks = $_POST['subdomain_picks_reject'];
					
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
				
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadSubDomainPick($pick);
						$this->updatePickStatus($actualPick, 'Rejected');
					}
				
					$domainFlag = true;
				}
				
				$closed = new ApplicationClosed();
				$closedOne = false;
				$loaduser = $this->loadUser($user_id);
				
				
				if ($domainFlag){
					// add entry to domain_mentor
					$domEntry = $this->isNewEntry($user_id, 'domain_mentor');
					$loaduser->isDomMentor = 1;
						
					// add entry to domain_mentor
					// if it already exists do NOTHING . change here with else statement to perform update
					if ($domEntry < 1){
						$dmentor = new DomainMentor('add_new');
						$dmentor->user_id = $user_id;
						$dmentor->max_tickets = $domApp->max_amount;
						$dmentor->save();
					} // else UPDATE
					
					
					$domcount = Yii::app()->db->createCommand()->
									select('count(*)')->
									from('application_domain_mentor_pick')->
									where('app_id =:id', array(':id'=>$domApp->id))->
									andWhere('approval_status = "Proposed by Admin"')->
									queryScalar();
					$domcount += Yii::app()->db->createCommand()->
									select('count(*)')->
									from('application_subdomain_mentor_pick')->
									where('app_id =:id', array(':id'=>$domApp->id))->
									andWhere('approval_status = "Proposed by Admin"')->
									queryScalar();
					if ($domcount > 0){
						$this->updateAppStatus($domApp, 'Mentor');
					} else {
						$this->updateAppStatus($domApp, 'Closed');
						$closed->app_domain_mentor_id = $domApp->id;
						$closedOne = true;
					}
				}
							
				if ($personalFlag){
					
					$loaduser->isPerMentor = 1;
					
					$percount = Yii::app()->db->createCommand()->
									select('count(*)')->
									from('application_personal_mentor_pick')->
									where('app_id =:id', array(':id'=>$persApp->id))->
									andWhere('approval_status = "Proposed by Admin"')->
									queryScalar();
					if ($percount > 0){
						$this->updateAppStatus($persApp, 'Mentor');						
					} else {
						$this->updateAppStatus($persApp, 'Closed');
						$closed->app_personal_mentor_id = $persApp->id;
						$closedOne = true;
					}
				}
				
				if ($projectFlag){
					
					$loaduser->isProMentor = 1;
					
					$procount = Yii::app()->db->createCommand()->
									select('count(*)')->
									from('application_project_mentor_pick')->
									where('app_id =:id', array(':id'=>$projApp->id))->
									andWhere('approval_status = "Proposed by Admin"')->
									queryScalar();
					if ($procount > 0){
						$this->updateAppStatus($projApp, 'Mentor');
					} else {
						$this->updateAppStatus($projApp, 'Closed');
						$closed->app_project_mentor_id = $projApp->id;
						$closedOne = true;
					}	
				}
				
				$loaduser->save();
				
				
				if ($closedOne) {
                                        $closed->user_id = $user_id;
					$closed->date = new CDbExpression('NOW()');	
					$closed->save();
				}
                                User::sendMentorApplicationStatusEmail($loaduser, "The administrator");
				$this->redirect(array('application/admin'));
			}
			
		}  // on initial load
		
				// application personal mentor
				$personalMentor = $this->loadPersonalMentorByUser($user_id);
				$personalMentorHistory = null;
				$personalMentorChanges = null;
				$personalMentorProposals = null;
				$personalCount = 0;
				if ($personalMentor != null){
							
						$personalMentorHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.user_id, t.approval_status, u.fname, u.lname
								FROM application_personal_mentor_pick t, user u
								WHERE t.user_id = u.id AND (t.approval_status = "Approved" OR t.approval_status = "Rejected" OR t.approval_status = "Proposed by Admin") 
								AND t.app_id = '.$personalMentor->id.'');
						
						$personalMentorChanges = new CSqlDataProvider('SELECT t.id, t.app_id, t.user_id, t.approval_status, u.fname, u.lname
								FROM application_personal_mentor_pick t, user u
								WHERE t.user_id = u.id AND (t.approval_status = "Proposed by Mentor" OR t.approval_status = "Proposed by System")
								AND t.app_id = '.$personalMentor->id.'');
						
						$personalCount = Yii::app()->db->createCommand()->
								select('count(*)')->
								from('application_personal_mentor_pick')->
								where('app_id =:id', array(':id'=>$personalMentor->id))->
								andWhere('approval_status = "Proposed by Mentor"')->
								queryScalar();
						
						$personalCount += Yii::app()->db->createCommand()->
								select('count(*)')->
								from('application_personal_mentor_pick')->
								where('app_id =:id', array(':id'=>$personalMentor->id))->
								andWhere('approval_status = "Proposed by System"')->
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
								WHERE t.project_id = p.id AND (t.approval_status = "Approved" OR t.approval_status = "Rejected" OR t.approval_status = "Proposed by Admin")
								AND t.app_id = '.$projectMentor->id.'');
						
						
						$projectMentorChanges = new CSqlDataProvider('SELECT t.id, t.app_id, t.project_id, t.approval_status, p.title
								FROM application_project_mentor_pick t, project p
								WHERE t.project_id = p.id AND (t.approval_status = "Proposed by Mentor" OR t.approval_status = "Proposed by System")
								AND t.app_id = '.$projectMentor->id.'');
						
						$projectCount = Yii::app()->db->createCommand()->
								select('count(*)')->
								from('application_project_mentor_pick')->
								where('app_id =:id', array(':id'=>$projectMentor->id))->
								andWhere('approval_status = "Proposed by Mentor"')->
								queryScalar();
						
						$projectCount += Yii::app()->db->createCommand()->
						select('count(*)')->
						from('application_project_mentor_pick')->
						where('app_id =:id', array(':id'=>$projectMentor->id))->
						andWhere('approval_status = "Proposed by System"')->
						queryScalar();
				
				}
				
				// application domain mentor
				$domainMentor = $this->loadDomainMentorByUser($user_id);
				$domainHistory = null;
				$domainChanges= null;
				$domainCount = 0;
				$subdomainHistory = null;
				$subdomainChanges = null;
				$subdomainCount = 0;
				if ($domainMentor != null){
					
						$domainHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.domain_id, t.proficiency, t.approval_status, d.name
								FROM application_domain_mentor_pick t, domain d 
								WHERE t.approval_status != "Proposed by Mentor" AND t.domain_id = d.id AND t.app_id = '.$domainMentor->id.'');
						
						
						$domainChanges = new CSqlDataProvider('SELECT t.id, t.app_id, t.domain_id, t.proficiency, t.approval_status, d.name
								FROM application_domain_mentor_pick t, domain d 
								WHERE (t.approval_status = "Proposed by Mentor") 
								AND t.domain_id = d.id AND t.app_id= '.$domainMentor->id.'');
						
						$domainCount = Yii::app()->db->createCommand()->
								select('count(*)')->
								from('application_domain_mentor_pick')->
								where('app_id =:id', array(':id'=>$domainMentor->id))->
								andWhere('approval_status = "Proposed by Mentor"')->
								queryScalar();
								
						$subdomainHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.subdomain_id, t.proficiency, t.approval_status, d.name as "dname", s.name as "sname" 
								FROM application_subdomain_mentor_pick t, subdomain s, domain d 
								WHERE t.approval_status != "Proposed by Mentor" AND s.domain_id = d.id AND s.id = t.subdomain_id AND t.app_id = '.$domainMentor->id.'');
						
						$subdomainChanges = new CSqlDataProvider('SELECT t.id, t.app_id, t.subdomain_id, t.proficiency, t.approval_status, d.name as "dname", s.name as "sname" 
								FROM application_subdomain_mentor_pick t, subdomain s, domain d 
								WHERE (t.approval_status = "Proposed by Mentor")
								AND s.domain_id = d.id AND s.id = t.subdomain_id AND t.app_id = '.$domainMentor->id.'');
						
						$subdomainCount = Yii::app()->db->createCommand()->
								select('count(*)')->
								from('application_subdomain_mentor_pick')->
								where('app_id =:id', array(':id'=>$domainMentor->id))->
								andWhere('approval_status = "Proposed by Mentor"')->
								queryScalar();
				}
				
				$userInfo = $this->loadUserInfoByUser($user_id);
				
				$newCount = $personalCount + $projectCount + $domainCount + $subdomainCount;
				
		
		
		// render view
		$this->render('view', array('user_id'=>$user_id, 
				'personalMentor'=>$personalMentor,'personalMentorHistory'=>$personalMentorHistory,'personalMentorChanges'=>$personalMentorChanges,
				'projectMentor'=>$projectMentor,'projectMentorHistory'=>$projectMentorHistory,'projectMentorChanges'=>$projectMentorChanges,
				'domainMentor'=>$domainMentor, 'domainHistory'=>$domainHistory,'domainChanges'=>$domainChanges,
				'subdomainHistory'=>$subdomainHistory,'subdomainChanges'=>$subdomainChanges,
				'newCount'=>$newCount,
				'perModel'=>$perModel,
				'proModel'=>$proModel,
				'domModel'=>$domModel,
				'subModel'=>$subModel,
				'userInfo'=>$userInfo,
				
		));
	}
	
	/*
	 * Renders the mentor application portal
	 */
	public function actionPortal(){
		$user = User::model()->getCurrentUser();
		$buttons = array();
		$count = Yii::app()->db->createCommand()->
						select('count(*)')->
						from('application_personal_mentor')->
						where('user_id =:id', array(':id'=>$user->id))->
						andWhere('status != "Closed"')->
						queryScalar();
		if($count > 0) $buttons[] = 0;
		else $buttons[] = 1;
		
		$count = Yii::app()->db->createCommand()->
			select('count(*)')->
			from('application_project_mentor')->
			where('user_id =:id', array(':id'=>$user->id))->
			andWhere('status != "Closed"')->
			queryScalar();
		if($count > 0) $buttons[] = 0;
		else $buttons[] = 1;
		
		$count = Yii::app()->db->createCommand()->
			select('count(*)')->
			from('application_domain_mentor')->
			where('user_id =:id', array(':id'=>$user->id))->
			andWhere('status != "Closed"')->
			queryScalar();
		if($count > 0) $buttons[] = 0;
		else $buttons[] = 1;
		
		$this->render('portal', array('buttons'=>$buttons));
	}
	
	public function actionAdminPersonal($id, $appid ){
		$model = new ApplicationPersonalMentor;
		$students = new User;
		$unis = array();
	
		if (Yii::app()->getRequest()->isPostRequest) {
			// on application submit
			$user = User::model()->findAllByPk($id);

				
			// save user picks
			$mypicks = $_POST['picks'];
			$mypicks = explode(',', $mypicks);
			foreach($mypicks as $pick){
				$dbpick = new ApplicationPersonalMentorPick;
				$dbpick->app_id = $model->id;
				$dbpick->user_id = $pick;
				$dbpick->approval_status = 'Proposed by Admin';
				$dbpick->save(false);
			}
				
			// redirect to application portal
			$this->redirect("/coplat/index.php/application/" . $id);
		} else {
			// on initial load
			$students->unsetAttributes();
			$students->isMentee = 1;
			$student = User::model()->returnUsersForApp($students->searchNoPagination());
			$universities = University::model()->getUniversities();
			$unis[0] = 'Any';
			foreach ($universities as $uni) $unis[$uni->id] = $uni->name;
			$model->system_pick_amount = 0;
		}
	
		$error='';
	
		$this->render('adminpersonal', array(
				'model'=>$model, 'user'=>$students, 'universities'=>$unis, 'students'=>$student, 'error' => $error,
		));
	}
	
	/*
	 *  Personal Mentor Application
	 */
	public function actionPersonal(){
		$model = new ApplicationPersonalMentor;
		$students = new User;
		$unis = array();
		
		if (Yii::app()->getRequest()->isPostRequest) {
			// on application submit
			$user = User::model()->getCurrentUser();		
			
			// pull application data and save
			$model->attributes = $_POST['ApplicationPersonalMentor'];
			$model->status = 'Admin';
			$model->user_id = $user->id;
			$model->date_created = new CDbExpression('NOW()');
			if(!isset($model->university_id) ||  $model->university_id == 0)
                        {
                           $model->university_id = NULL;
                        }
                          
			$model->save(false);
			
			// save user picks
			$mypicks = $_POST['picks'];
			$mypicks = explode(',', $mypicks);
			foreach($mypicks as $pick)
                        {
                            if ($pick > 0)
                            {
                                $dbpick = new ApplicationPersonalMentorPick;
				$dbpick->app_id = $model->id;
				$dbpick->user_id = $pick;
				$dbpick->approval_status = 'Proposed by Mentor';
				$dbpick->save(false);                                
                            }				
			}	
			
			// save system picks
			$systempicks = $_POST['systempicks'];
			$systempicks = explode(',', $systempicks);
			foreach($systempicks as $pick)
                        {
                            if ($pick > 0)
                            {
                               				$dbpick = new ApplicationPersonalMentorPick;
				$dbpick->app_id = $model->id;
				$dbpick->user_id = $pick;
				$dbpick->approval_status = 'Proposed by System';
				$dbpick->save(false); 
                            }
			}
			
			// redirect to application portal
			$this->redirect("/coplat/index.php/application/portal");
		} else { 
			// on initial load
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
		$user = User::model()->getCurrentUser();
		
		if (Yii::app()->getRequest()->isPostRequest) {
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
			
			// save system picks
			$systempicks = $_POST['systempicks'];
			$systempicks = explode(',', $systempicks);
			foreach($systempicks as $pick)
                        {
                            if ($pick > 0)
                            {
                                $dbpick = new ApplicationProjectMentorPick;
				$dbpick->app_id = $application->id;
				$dbpick->project_id = $pick;
				$dbpick->approval_status = 'Proposed by System';
				$dbpick->save(false);
                            }				
			}
			
			// redirect to application portal
			$this->redirect("/coplat/index.php/application/portal");
		} else { // on initial load
			$projects->unsetAttributes();
			$project = Project::model()->getProjectsForApp($projects->searchNoPagination(), $user->id);
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
		if (Yii::app()->getRequest()->isPostRequest) {
			$user = User::model()->getCurrentUser();
			$application->attributes = $_POST['ApplicationDomainMentor'];
			$application->status = 'Admin';
			$application->user_id = $user->id;
			$application->date_created = new CDbExpression('NOW()');
			$application->save(false);
				
			$picks = $_POST['domPicks'];
			$picks = explode(',', $picks);
			foreach($picks as $pick)
                        {
				$dbpick = new ApplicationDomainMentorPick;
				$dbpick->app_id = $application->id;
				$temp = explode(':', $pick);
				$dbpick->domain_id = $temp[0];
				$dbpick->proficiency = $temp[1];
				$dbpick->approval_status = 'Proposed by Mentor';
				$dbpick->save(false);
			}
			
			$picks = $_POST['subPicks'];
                        if (isset($picks) && $picks != "")
                        {
                            $picks = explode(',', $picks);
                            foreach($picks as $pick)
                            {
                                    $dbpick = new ApplicationSubdomainMentorPick;
                                    $dbpick->app_id = $application->id;
                                    $temp = explode(':', $pick);
                                    $dbpick->subdomain_id = $temp[0];
                                    $dbpick->proficiency = $temp[1];
                                    $dbpick->approval_status = 'Proposed by Mentor';
                                    $dbpick->save(false);
                            }                            
                        }
			

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
	
	public function actionApprove(){
		//$this->layout = '';
		$user = User::model()->getCurrentUser();		
		$perModel = new ApplicationPersonalMentorPick();
		$proModel = new ApplicationProjectMentorPick();
		$domModel = new ApplicationDomainMentorPick();
		$subModel = new ApplicationSubdomainMentorPick();
		
		
		if (Yii::app()->getRequest()->isPostRequest) {
							
				$projectFlag = false;
				$personalFlag = false;
				$domainFlag = false;
		
				$domApp = $this->loadDomainMentorForApproval($user->id);
				$persApp = $this->loadPersonalMentorForApproval($user->id);
				$projApp = $this->loadProjectMentorForApproval($user->id);
		
		
				// PERSONAL PICKS ACCEPT
				$mypicks = $_POST['personal_picks_accept'];
		
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
						
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadPersonalPick($pick);
						$this->updatePickStatus($actualPick, 'Approved');
		
						// create new entry
						$mentee = new PersonalMentorMentees('add_new');
						$mentee->user_id = $actualPick->user_id; // mentee id
						$mentee->personal_mentor_id = $user->id; // mentor id
						$mentee->save();
		
					}
						
					// add entry to personal_mentor
					$personalEntry = $this->isNewEntry($user->id, 'personal_mentor');
		
					// if it already exists do NOTHING . change here with else statement to perform update
					if ($personalEntry < 1){
						// add entry to personal_mentor
						$pementor = new PersonalMentor('add_new');
						$pementor->user_id = $user->id;
						$pementor->max_hours = $persApp->max_hours;
						$pementor->max_mentees = $persApp->max_amount;
						$pementor->save();
					} // else UPDATE
						
					$personalFlag = true;
					//$loaduser->isPerMentor = 1;
						
				}
		
				// PERSONAL PICKS REJECT
				$mypicks = $_POST['personal_picks_reject'];
		
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
						
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadPersonalPick($pick);
						$this->updatePickStatus($actualPick, 'Rejected');
					}
						
					$personalFlag = true;
						
				}
		
				// PROJECT PICKS ACCEPT
				$mypicks = $_POST['project_picks_accept'];
					
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
						
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadProjectPick($pick);
						$this->updatePickStatus($actualPick, 'Approved');
						
						// update entry
						$project = $this->loadProject($actualPick->project_id);
						$project->project_mentor_user_id = $user->id;
						$project->save();
		
					}
						
					// add entry to project_mentor
					$projectEntry = $this->isNewEntry($user->id, 'project_mentor');
						
					// if it already exists do NOTHING . change here with else statement to perform update
					if ($projectEntry < 1){
						// add entry to project_mentor
						$promentor = new ProjectMentor('add_new');
						$promentor->user_id = $user->id;
						$promentor->max_hours = $projApp->max_hours;
						$promentor->max_projects = $projApp->max_amount;
						$promentor->save();
					} // else UPDATE
						
					$projectFlag = true;
					//$loaduser->isProMentor = 1;
				}
		
				// PROJECT PICKS REJECT
				$mypicks = $_POST['project_picks_reject'];
		
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
						
					foreach($mypicks as $pick){
						$actualPick = $this->loadProjectPick($pick);
						$this->updatePickStatus($actualPick, 'Rejected');
					}
						
					$projectFlag = true;
				}
		
				// DOMAIN PICKS ACCEPT
				$mypicks = $_POST['domain_picks_accept'];
		
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
						
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadDomainPick($pick);
						$this->updatePickStatus($actualPick, 'Approved');
		
						// create new entry
						$domain = new UserDomain('add_new');
						$domain->user_id = $user>id;
						$domain->domain_id = $actualPick->domain_id;
						$domain->rate = $actualPick->proficiency;
						$domain->active = 1;
						$domain->tier_team = 1;
						$domain->save();
					}
						
					$domainFlag = true;
					//$loaduser->isDomMentor = 1;
				}
		
				// DOMAIN PICKS REJECT
				$mypicks = $_POST['domain_picks_reject'];
		
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
						
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadDomainPick($pick);
						$this->updatePickStatus($actualPick, 'Rejected');
					}
						
					$domainFlag = true;
				}
		
				// SUBDOMAIN PICKS ACCEPT
				$mypicks = $_POST['subdomain_picks_accept'];
		
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
						
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadSubDomainPick($pick);
						$this->updatePickStatus($actualPick, 'Approved');
		
						//create new entry
						$subdomain = new UserDomain('add_new');
						$subdomain->user_id = $user->id;
						$subdomain->domain_id = $actualPick->subdomain->domain->id;
						$subdomain->subdomain_id = $actualPick->subdomain_id;
						$subdomain->rate = $actualPick->proficiency;
						$subdomain->active = 1;
						$subdomain->tier_team = 1;
						$subdomain->save();
					}
						
						
					$domainFlag = true;
					//$loaduser->isDomMentor = 1;
						
				}
		
				// SUBDOMAIN PICKS REJECT
				$mypicks = $_POST['subdomain_picks_reject'];
					
				if ($mypicks != ''){
					$mypicks = explode(',', $mypicks);
		
					// cycle through each and add permanetly to appropriate table
					foreach($mypicks as $pick){
						$actualPick = $this->loadSubDomainPick($pick);
						$this->updatePickStatus($actualPick, 'Rejected');
					}
		
					$domainFlag = true;
				}
		
				$closed = new ApplicationClosed();
				$closedOne = false;		
		
				if ($domainFlag){
					// add entry to domain_mentor
					$domEntry = $this->isNewEntry($user->id, 'domain_mentor');
					$user->isDomMentor = 1;
		
					// add entry to domain_mentor
					// if it already exists do NOTHING . change here with else statement to perform update
					if ($domEntry < 1){
						$dmentor = new DomainMentor('add_new');
						$dmentor->user_id = $user->id;
						$dmentor->max_tickets = $domApp->max_amount;
						$dmentor->save();
					} // else UPDATE
						
						

					$this->updateAppStatus($domApp, 'Closed');
					$closed->app_domain_mentor_id = $domApp->id;
					$closedOne = true;
				}
					
				if ($personalFlag){
						
					$user->isPerMentor = 1;
						
					$this->updateAppStatus($persApp, 'Closed');
					$closed->app_personal_mentor_id = $persApp->id;
					$closedOne = true;
				}
		
				if ($projectFlag){
						
					$user->isProMentor = 1;
						
					$this->updateAppStatus($projApp, 'Closed');
					$closed->app_project_mentor_id = $projApp->id;
					$closedOne = true;
				}
		
				$user->save();
		
		
				if ($closedOne) {
					$closed->user_id = $user->id;
					$closed->date = new CDbExpression('NOW()');
					$closed->save();
				}
		
				$this->redirect("/coplat/index.php/application/portal");
			
				
		}  // on initial load
		
		// application personal mentor
		
		// load application sent by admin
		$personalMentor = $this->loadPersonalMentorForApproval($user->id);
		$personalMentorHistory = null;
		$personalMentorChanges = null;
		$personalCount = 0;
		if ($personalMentor != null){
				
			$personalMentorHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.user_id, t.approval_status, u.fname, u.lname
								FROM application_personal_mentor_pick t, user u
								WHERE t.user_id = u.id AND (t.approval_status = "Approved" OR t.approval_status = "Rejected")
								AND t.app_id = '.$personalMentor->id.'');
		
			$personalMentorChanges = new CSqlDataProvider('SELECT t.id, t.app_id, t.user_id, t.approval_status, u.fname, u.lname
								FROM application_personal_mentor_pick t, user u
								WHERE t.user_id = u.id AND (t.approval_status = "Proposed by Admin")
								AND t.app_id = '.$personalMentor->id.'');
		
			$personalCount = Yii::app()->db->createCommand()->
			select('count(*)')->
			from('application_personal_mentor_pick')->
			where('app_id =:id', array(':id'=>$personalMentor->id))->
			andWhere('approval_status = "Proposed by Admin"')->
			queryScalar();
		}
		
		// application project mentor
		$projectMentor = $this->loadProjectMentorForApproval($user->id);
		$projectMentorHistory = null;
		$projectMentorChanges = null;
		$projectCount = 0;
		if ($projectMentor != null){
			$projectMentorHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.project_id, t.approval_status, p.title
								FROM application_project_mentor_pick t, project p
								WHERE t.project_id = p.id AND (t.approval_status = "Approved" OR t.approval_status = "Rejected")
								AND t.app_id = '.$projectMentor->id.'');
		
		
			$projectMentorChanges = new CSqlDataProvider('SELECT t.id, t.app_id, t.project_id, t.approval_status, p.title
								FROM application_project_mentor_pick t, project p
								WHERE t.project_id = p.id AND (t.approval_status = "Proposed by Admin")
								AND t.app_id = '.$projectMentor->id.'');
		
			$projectCount = Yii::app()->db->createCommand()->
			select('count(*)')->
			from('application_project_mentor_pick')->
			where('app_id =:id', array(':id'=>$projectMentor->id))->
			andWhere('approval_status = "Proposed by Admin"')->
			queryScalar();
		}
		
		// application domain mentor
		$domainMentor = $this->loadDomainMentorForApproval($user->id);
		$domainHistory = null;
		$domainChanges= null;
		$domainCount = 0;
		$subdomainHistory = null;
		$subdomainChanges = null;
		$subdomainCount = 0;
		if ($domainMentor != null){
				
			$domainHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.domain_id, t.proficiency, t.approval_status, d.name
								FROM application_domain_mentor_pick t, domain d
								WHERE (t.approval_status = "Approved" OR t.approval_status = "Rejected") AND t.domain_id = d.id AND t.app_id = '.$domainMentor->id.'');
		
		
			$domainChanges = new CSqlDataProvider('SELECT t.id, t.app_id, t.domain_id, t.proficiency, t.approval_status, d.name
								FROM application_domain_mentor_pick t, domain d
								WHERE (t.approval_status = "Proposed by Admin")
								AND t.domain_id = d.id AND t.app_id= '.$domainMentor->id.'');
		
			$domainCount = Yii::app()->db->createCommand()->
			select('count(*)')->
			from('application_domain_mentor_pick')->
			where('app_id =:id', array(':id'=>$domainMentor->id))->
			andWhere('approval_status = "Proposed by Admin"')->
			queryScalar();
		
			$subdomainHistory = new CSqlDataProvider('SELECT t.id, t.app_id, t.subdomain_id, t.proficiency, t.approval_status, d.name as "dname", s.name as "sname"
								FROM application_subdomain_mentor_pick t, subdomain s, domain d
								WHERE (t.approval_status = "Approved" OR t.approval_status = "Rejected") AND s.domain_id = d.id AND s.id = t.subdomain_id AND t.app_id = '.$domainMentor->id.'');
		
			$subdomainChanges = new CSqlDataProvider('SELECT t.id, t.app_id, t.subdomain_id, t.proficiency, t.approval_status, d.name as "dname", s.name as "sname"
								FROM application_subdomain_mentor_pick t, subdomain s, domain d
								WHERE (t.approval_status = "Proposed by Admin")
								AND s.domain_id = d.id AND s.id = t.subdomain_id AND t.app_id = '.$domainMentor->id.'');
		
			$subdomainCount = Yii::app()->db->createCommand()->
			select('count(*)')->
			from('application_subdomain_mentor_pick')->
			where('app_id =:id', array(':id'=>$domainMentor->id))->
			andWhere('approval_status = "Proposed by Admin"')->
			queryScalar();
		}
		
		$userInfo = $this->loadUserInfoByUser($user->id);
		
		$newCount = $personalCount + $projectCount + $domainCount + $subdomainCount;
		
		
		
		// render view
		$this->render('approve', array('user_id'=>$user->id,
				'personalMentor'=>$personalMentor,'personalMentorHistory'=>$personalMentorHistory,'personalMentorChanges'=>$personalMentorChanges,
				'projectMentor'=>$projectMentor,'projectMentorHistory'=>$projectMentorHistory,'projectMentorChanges'=>$projectMentorChanges,
				'domainMentor'=>$domainMentor, 'domainHistory'=>$domainHistory,'domainChanges'=>$domainChanges,
				'subdomainHistory'=>$subdomainHistory,'subdomainChanges'=>$subdomainChanges,
				'newCount'=>$newCount,
				'perModel'=>$perModel,
				'proModel'=>$proModel,
				'domModel'=>$domModel,
				'subModel'=>$subModel,
				'userInfo'=>$userInfo,
		
		));
	}
	
	public function loadPersonalMentorByUser($id)
	{
		$params = array('user_id'=>$id, 'status'=>'Admin');
		$model=ApplicationPersonalMentor::model()->findByAttributes($params);
		return $model;
	}
	
	public function loadPersonalMentorForApproval($id)
	{
		$params = array('user_id'=>$id, 'status'=>'Mentor');
		$model=ApplicationPersonalMentor::model()->findByAttributes($params);
		return $model;
	}
	
	public function loadProjectMentorByUser($id)
	{
		$params = array('user_id'=>$id, 'status'=>'Admin');
		$model=ApplicationProjectMentor::model()->findByAttributes($params);
		return $model;
	}
                
	public function loadProjectMentorForApproval($id)
	{
		$params = array('user_id'=>$id, 'status'=>'Mentor');
		$model=ApplicationProjectMentor::model()->findByAttributes($params);
                return $model;
	}
	
	public function loadDomainMentorByUser($id)
	{
		$params = array('user_id'=>$id, 'status'=>'Admin');
		$model=ApplicationDomainMentor::model()->findByAttributes($params);
		return $model;
	}
	
	public function loadDomainMentorForApproval($id)
	{
		$params = array('user_id'=>$id, 'status'=>'Mentor');
		$model=ApplicationDomainMentor::model()->findByAttributes($params);
		return $model;
	}
	
	public function loadUserInfoByUser($id) {
		//$params = array('user_id'=>$id);
		//$model=UserInfo::model()->findByAttributes($params);
		$model = UserInfo::model()->findByPk($id);
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