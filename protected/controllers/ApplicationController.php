<?php

class ApplicationController extends Controller
{

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

	public function actionView()
	{
		$this->render('view');
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
				$dbpick->approval_status = 'Pending';
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
				$dbpick->approval_status = 'Pending';
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