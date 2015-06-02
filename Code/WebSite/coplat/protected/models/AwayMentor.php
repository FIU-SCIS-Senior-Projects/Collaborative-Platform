<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 5/26/2015
 * Time: 7:17 AM
 */
/**
* This is the model class for table "away_mentor".
 *
 * The followings are the available columns in table 'user':
 * @property int(10) $userID
 *
 /**
 * @param $user_email
 */
Class AwayMentor extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return 'away_mentor';
    }
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('userID, tiStamp', 'required'),
            array('userID', 'integerOnly'=>true),
            array('userID', 'safe', 'on'=>'search'),
        );
    }
    public function attributeLabels()
    {
        return array(
            'userID' => 'User Id',
        );
    }
    public static function setAsAway($user_Id)
    {

            $command = Yii::app()->db->createCommand();
                $command->insert('away_mentor', array("userID" => $user_Id, "tiStamp"=> "NOW()"));
                $command->execute();

            $ftickets = Ticket::model()->findAllBySql("SELECT * FROM ticket WHERE assign_user_id =:userID AND assigned_date >= DATE_ADD(CURRENT_DATE , INTERVAL -1 DAY )", array(":userID" => $user_Id));//find tickets assigned to this user within last 24 hours

            foreach ($ftickets as $aticket) {
                $ticketcon = new TicketController($aticket->id);
                $ticketcon->actionReassign($aticket->id);
                $awayMent = User::model()->findAllBySql("SELECT * FROM user WHERE id =:user_Id", array(":user_Id"=>$user_Id));
                foreach ($awayMent as $bawayMent) {
                    AwayMentor::model()->sendEmailTicketCancelOutOfOffice($bawayMent->fname . " " . $bawayMent->lname, $bawayMent->email, $aticket->subject);
                }
            }


    }

    /**
     * @param $user_email
     */
    public static function setAsNotAway($user_id)
    {
        $command = Yii::app()->db->createCommand();
        $command->delete('away_mentor', 'userID=:user_id', array(':user_id' => $user_id));
        $command->execute();
    }

    public static function detectOOOmessage($subjectline, $body, $email)
    {

        if (stristr($subjectline, "Auto") || stristr($subjectline, "out of office"))
        {
            if(stristr($body, "out of office"))
            {

                    $isAwayAlready = User::model()->findAllBySql("SELECT * FROM user  INNER JOIN away_mentor ON user.id = away_mentor.userID WHERE email =:email", array(':email' => $email));

                if(!$isAwayAlready)
                    {
                        $awayment = User::model()->findAllBySql("Select * from user where email =:email", array (':email' => "adurocruor@gmail.com"));

                        foreach($awayment as $awaym) {

                            AwayMentor::setAsAway($awaym->id);

                        }
                        return 1;//success
                    }
                return 0;//is
            }
        }
        return 0;
    }

    public static function detectB00message($subjectline, $email)
    {
        if(stristr($subjectline, "Back in Office"))
        {
            $am = User::model()->findAllBySql("Select * from user where email =:email", array(":email"=>"adurocruor@gmail.com"));
            foreach($am as $anam) {
                AwayMentor::setAsNotAway($anam->id);
            }
        }
    }

    public static function sendEmailTicketCancelOutOfOffice($mentorname, $mentoremail, $ticketsubject)
    {
        $email = Yii::app()->email;
        $link = CHtml::link('Click here to go to the site!', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $message = 'Dear ' . $mentorname . ': <br> Collaborative platform received an "Out of office" automated reply from this email, and has made it so tickets will not be assigned to you untill you are back.  The ticket with the subject " ' . $ticketsubject . ' " has reassigned to another mentor. <br>You can let the system know that you are available again by sending and email to this email address with "Back In Office" in the subject <br> Thank you for all your help and we hope to hear from you soon.';
        $html = User::replaceMessage($mentorname, $message);

        $email->to = $mentoremail;
        $email->from = 'Collaborative Platform';
        $email->replyTo ='fiucoplat@gmail.com';
        $email->subject = 'Auto Response to Out of Office';
        $email->message = $html;
        $email->send();
    }
    public static function readText1()
    {
    $am = new AwayMentor();
    $a1 = AwayMentor::model()->findAllBySql("SELECT * FROM user  INNER JOIN away_mentor ON user.id = away_mentor.userID WHERE email =:email", array(":email"=>"adurocruor@gmail.com") );
        if($a1)
    {
        return 0;
    }
    $myfile = fopen("/var/www/html/CoplatVe5/Code/WebSite/coplat/protected/models/settoAway.txt", "r") or die("Unable to open file!");
    $email=fgets($myfile);
    $subject = fgets($myfile);
    $body = fgets($myfile);
    fclose($myfile);

    $am->detectOOOmessage($subject, $body, $email);



    }
    public static function readText2()
    {
        $am = new AwayMentor();
        $myfile = fopen("/var/www/html/CoplatVe5/Code/WebSite/coplat/protected/models/settoBack.txt", "r") or die("Unable to open file!");
        $email=fgets($myfile);
        $subject = fgets($myfile);
        fclose($myfile);

        $am->detectB00message($subject, $email);

    }
}