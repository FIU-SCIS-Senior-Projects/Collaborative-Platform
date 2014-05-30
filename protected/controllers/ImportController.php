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

        if(User::isCurrentUserAdmin())
        {
            $url = "http://spws.cis.fiu.edu:8080/SPW2-RegisterAPI/rest/SPWRegister/getAll/123FIUspw/";
            $json = file_get_contents($url);
            $students = json_decode($json, true);

                foreach ($students as $student )
               {


                   $this->importStudent($student['email'],$student['id'],$student['firstName'],$student['lastName'],$student['middle'],$student['valid']);
               }


          echo "<script type='text/javascript'>

                alert('Data from SPW has been imported');

                window.location = 'adminHome';

              </script>";
            //s$this->refresh(false,'#');
        } else
        {
            echo "<script> window.location ='userHome' </script>";

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

    public function importStudent($email,$pid,$firstname,$lastname,$middle,$valid)
    {
        if($this->exists($email)==false)
        {

        $us = new User;
        $us->email = $email."@fiu.edu";
        $us->fiucs_id = $pid;
        $us->fname = ucfirst($firstname);
        $us->lname = ucfirst($lastname);

        $us->username = $email;
        if($valid==true)
        {
            $us->activated = 1;
        } else
        {
            $us->activated = 0;
        }
        //$us->activation_chain = $this->genRandomString(10);

        $us->isMentee =1;
        //$us->isStudent=1;

        $randPassword = $this->passwordGenerator();
        $us->tpassword =  $randPassword;
        $hasher = new PasswordHash(8, false);
        $us->password = $hasher->HashPassword($randPassword);

        $us->save(false);

        $mentee = new Mentee();
        $mentee->user_id = $us->id;
        $mentee->save(false);
        }

            //$userfullName = $model->fname.' '.$model->lname;
            $error = '';

           // $this->actionSendVerificationEmail($userfullName, $model->email);

        }
}





























