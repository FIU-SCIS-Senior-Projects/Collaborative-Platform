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

        $Tickets = Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE assign_user_id=:id or creator_user_id=:id", array(":id" => $user->id));

        $this->render('userHome', array('Tickets' => $Tickets,
            //'results' => $results,
            'user' => $user));

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
        $Tickets = Ticket::model()->findAll();

        $this->render('adminHome', array('Tickets' => $Tickets,
            //'results' => $results,
            'user' => $user));


    }


    public function actionpMentoViewProjects()
    {
        $this->render('coplat/projectMeeting/pMentorViewProjects');
    }
}
