<?php

/**
 * Created by PhpStorm.
 * User: lorenzo_mac
 * Date: 4/2/14
 * Time: 10:11 PM
 */
class HomeController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
                'actions' => array('create', 'update', 'pMentorViewProjects', 'userHome', 'adminHome', 'adminViewProjects'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }


    public function actionuserHome()
    {
        /** @var User $username */
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));

        $TicketsO = Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE (assign_user_id=:id or creator_user_id=:id)
        and (status=:pending or status=:reject)", array(":id" => $user->id,":pending"=>'pending', ":reject"=>'reject' ));


        // $TicketsR = Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE (assign_user_id=:id or creator_user_id=:id) and status=:status", array(":id" => $user->id,":status"=>'reject'));
        $TicketsC = Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE (assign_user_id=:id or creator_user_id=:id) and status=:status", array(":id" => $user->id,":status"=>'close'));
		
        $count = 0;
        $count += Yii::app()->db->createCommand()->
			select('count(*)')->
			from('application_personal_mentor')->
			where('user_id =:id', array(':id'=>$user->id))->
			andWhere('status = "Mentor"')->
			queryScalar();
        $count += Yii::app()->db->createCommand()->
	        select('count(*)')->
	        from('application_project_mentor')->
	        where('user_id =:id', array(':id'=>$user->id))->
	        andWhere('status = "Mentor"')->
	        queryScalar();
        $count += Yii::app()->db->createCommand()->
	        select('count(*)')->
	        from('application_domain_mentor')->
	        where('user_id =:id', array(':id'=>$user->id))->
	        andWhere('status = "Mentor"')->
	        queryScalar();
        if($count > 0) $button = 1;
        else $button = 0;
        
        $this->render('userHome', array('TicketsO' => $TicketsO, 'TicketsC' => $TicketsC,
            //'results' => $results,
            'user' => $user, 'button'=>$button));

    }

    public function actionadminViewProjects()
    {

        $this->render('coplat/projectMeeting/adminViewProjects');
    }


    public function actionadminHome()
    {

        /** @var User $username */
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));

        /* Get all tickets on the mentoring subsystem */
        //$TicketsO = Ticket::model()->findAll("status=:pending" or "status=:reject",array(':pending'=>'pending', ':reject'=>'reject'));
        $TicketsO = Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE (status=:pending or status=:reject)",array(':pending'=>'pending', ':reject'=>'reject') );
        $TicketsC = Ticket::model()->findAll("status=:status",array(':status'=>'close'));
        //$TicketsR = Ticket::model()->findAll("status=:status",array(':status'=>'reject'));

        $this->render('adminHome', array('TicketsO' => $TicketsO, 'TicketsC'=> $TicketsC,
            //'results' => $results,
            'user' => $user));


    }


    public function actionpMentoViewProjects()
    {
        $this->render('coplat/projectMeeting/pMentorViewProjects');
    }
}
