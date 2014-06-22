<?php
/**
 * Created by PhpStorm.
 * User: Jonathan
 * Date: 5/24/14
 * Time: 3:50 PM
 */
?>

<?php

class ImportController extends Controller
{
    public $layout='//layouts/column2';

    public function accessRules()
    {
        return array(

            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','view','adminHome'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionImport()
    {

        //if(User::isCurrentUserAdmin())
        {
            //  $projectURL = "http://localhost:8083/SPW2-RegisterAPI/rest/SPWRegister/getProjects/123FIUspw/";
            $projectURL = "http://spws-dev.cis.fiu.edu:8080/SPW2-RegisterAPI/rest/SPWRegister/getProjects/123FIUspw/";

            $jsonProjects = file_get_contents($projectURL);
            $projects = json_decode($jsonProjects, true);

            foreach ($projects as $project)
            {
                $this->importProject($project['title'],$project['description'],$project['proposed_by_id'],$project['project_id']);


            }


            //$studentsURL = "http://localhost:8083/SPW2-RegisterAPI/rest/SPWRegister/getAll/123FIUspw/";
            $studentsURL = "http://spws-dev.cis.fiu.edu:8080/SPW2-RegisterAPI/rest/SPWRegister/getAll/123FIUspw/";
            $jsonStudents = file_get_contents($studentsURL);
            $students = json_decode($jsonStudents, true);

            foreach ($students as $student )
            {

                $this->importMentee($student['email'],$student['id'],$student['firstName'],$student['lastName'],$student['middle'],$student['valid']);

                $this->assignProjectforUser($student['email'],$student['projectID']);
            }

            echo "<script> window.alert('Data has been imported from SPW');window.location = 'adminHome'</script>";


            //s$this->refresh(false,'#');
        } //else
        {
            //echo "<script> window.location ='userHome' </script>";

        }
    }



    public function passwordGenerator()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string

    }
    public function exists($username)
    {
        $model = User::model()->find("username = '".$username."'");
        if (empty($model))
        {
            return false;

        }
        return true;
    }
    public function assignProjectforUser($username,$project_id)
    {
        if ($project_id!=null)
        {
            $id=User::model()->find(array(
                'select'=>'id',
                'condition'=>'username=:un',
                'params'=>array(':un'=>$username),
            ));

            $record=Mentee::model()->findByPk($id->id);
            $record->project_id = $project_id;


            $record->save(false);



        }
    }

    public function importMentee($email,$pid,$firstname,$lastname,$middle,$valid)
    {
        if($this->exists($email)==false)
        {
            $us = new User;

            if($valid==true)
            {
                $us->activated = 1;

                $us->email = $email."@fiu.edu";
                $us->fiucs_id = $pid;
                $us->fname = ucfirst($firstname);
                $us->lname = ucfirst($lastname);

                $us->username = $email;
                //$us->activation_chain = $this->genRandomString(10);

                $us->isMentee =1;
                //$us->isStudent=1;

                $randPassword = $this->passwordGenerator();
                //$us->tpassword =  $randPassword;
                $hasher = new PasswordHash(8, false);
                $us->password = $hasher->HashPassword($randPassword);

                $us->save(false);

                $mentee = new Mentee();
                $mentee->user_id = $us->id;
                $mentorid = User::model()->findBySql("select * from user where username = 'DEFAULT' ");
                $mentee->personal_mentor_user_id = $mentorid->id;
                //$mentee->project_id = 999;
                $mentee->save(false);


            } else

            {
                $us->disable = 1;
                $us->save(false);


            }
        }

        //$userfullName = $model->fname.' '.$model->lname;
        $error = '';

        // $this->actionSendVerificationEmail($userfullName, $model->email);

    }


    public function importProject($title,$description,$proposed_by, $spw_project_legacy_id)
    {

        $exists = Project::model()->find("id = '".$spw_project_legacy_id."'");

        if (empty($exists))
        {

            $project = new Project();
            $project->id = $spw_project_legacy_id;
            $project->title=$title;
            $project->description = $description;
            $mentorid = User::model()->findBySql("select * from user where username = 'DEFAULT' ");
            $project->propose_by_user_id = $mentorid->id;
            $project->project_mentor_user_id = $mentorid->id;
            //$list= Yii::app()->db->createCommand('select user_id from project_mentor where spw_legacy_id=:idd')->bindValue('idd',$proposed_by)->queryAll();
            //$project->propose_by = $proposed_by;//$list[0]['user_id'];
            $project->save(false);



        }


    }
    /*

    public function disableOldMentees()
    {
        $studentsURL = "http://localhost:8083/SPW2-RegisterAPI/rest/SPWRegister/getAll/123FIUspw/";
        // $url = "http://spws-dev.cis.fiu.edu:8080/SPW2-RegisterAPI/rest/SPWRegister/getAll/123FIUspw/";
        $jsonStudents = file_get_contents($studentsURL);
        $students = json_decode($jsonStudents, true);
        foreach ($students as $student )
        {

        }


    }
  */




}





























