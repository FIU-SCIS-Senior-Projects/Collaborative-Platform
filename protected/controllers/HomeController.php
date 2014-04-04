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
                'actions' => array('create', 'update', 'pMentorHome'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }


    public function actionpMentorHome()
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
        $projects = Project::model()->findAll("mentor_id=:mentor_id", array(':mentor_id'=> $user->id));

        $this->render('pMentorHome', array('user' => $user, 'meetings' => $meetings, 'mentees' => $mentees, 'projects' => $projects));
    }


}
