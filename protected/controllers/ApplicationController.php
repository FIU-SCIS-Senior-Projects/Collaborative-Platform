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
		$mentees = new User;
		$unis = array();
		
		if (Yii::app()->getRequest()->isPostRequest) {
			print("POSTED THIS SHIT: " . $_POST['picks']);
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
			$mentees->unsetAttributes();
			$mentees->isMentee = 1;
			$universities = University::model()->getUniversities();
			$unis[0] = 'Any';
			foreach ($universities as $uni) $unis[$uni->id] = $uni->name;
			$model->system_pick_amount = 0;
		}
		
		$error='';
		
		$this->render('personal', array(
            'model'=>$model, 'user'=>$mentees, 'universities'=>$unis, 'error' => $error,
        ));
	}
	
	public function actionMenteeSelect(){
		$pk = Yii::app()->request->getParam('pk');
		$mypicks = Yii::app()->request->getParam('picks');
		$key = array_keys($this->selected, $pk);
		if(count($key) > 0){// this mentee was selected
			unset($selected[$key[0]]);
		} else {// this mentee was not selected
			$selected[] = $pk;
		}
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