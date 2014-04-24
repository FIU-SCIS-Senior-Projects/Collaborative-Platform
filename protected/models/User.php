<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property string $pic_url
 * @property integer $activated
 * @property string $activation_chain
 * @property integer $disable
 * @property string $biography
 * @property string $linkedin_id
 * @property string $fiucs_id
 * @property string $google_id
 * @property integer $isAdmin
 * @property integer $isProMentor
 * @property integer $isPerMentor
 * @property integer $isDomMentor
 * @property integer $isStudent
 * @property integer $isMentee
 * @property integer $isJudge
 * @property integer $isEmployer
 *
 * The followings are the available model relations:
 * @property Administrator $administrator
 * @property DomainMentor $domainMentor
 * @property Mentee $mentee
 * @property Message[] $messages
 * @property Message[] $messages1
 * @property PersonalMentor $personalMentor
 * @property ProjectMentor $projectMentor
 * @property Ticket[] $tickets
 * @property Ticket[] $tickets1
 * @property Domain[] $domains
 */
class User extends CActiveRecord
{
    public $password2;
    public $vjf_role;
    public $men_role;
    public $rmj_role;
    /*assign variables */
    public $userDomain;
    public $userId;
    /*Change the value when the system is deploy */
    public static $admin = 5;
    /* The most expert in the Domain */
    public static $condition = 8;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, password2, email, fname, lname', 'required'),
            array('activated, disable, isAdmin, isProMentor, isPerMentor, isDomMentor, isStudent, isMentee, isJudge, isEmployer', 'numerical', 'integerOnly' => true),
            array('username, fname, mname, activation_chain, linkedin_id, fiucs_id, google_id', 'length', 'max' => 45),
            array('password, email, pic_url', 'length', 'max' => 255),
            array('lname', 'length', 'max' => 100),
            array('biography', 'length', 'max' => 500),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, email, fname, mname, lname, pic_url, activated, activation_chain, disable, biography, linkedin_id, fiucs_id, google_id, isAdmin, isProMentor, isPerMentor, isDomMentor, isStudent, isMentee, isJudge, isEmployer', 'safe', 'on' => 'search'),
        );
    }


    public function validatePassword($password)
    {
        $hasher = new PasswordHash(8, false);
        return $hasher->CheckPassword($password, $this->password);
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'administrator' => array(self::HAS_ONE, 'Administrator', 'user_id'),
            'domainMentor' => array(self::HAS_ONE, 'DomainMentor', 'user_id'),
            'mentee' => array(self::HAS_ONE, 'Mentee', 'user_id'),
            'messages' => array(self::HAS_MANY, 'Message', 'receiver'),
            'messages1' => array(self::HAS_MANY, 'Message', 'sender'),
            'personalMentor' => array(self::HAS_ONE, 'PersonalMentor', 'user_id'),
            'projectMentor' => array(self::HAS_ONE, 'ProjectMentor', 'user_id'),
            'tickets' => array(self::HAS_MANY, 'Ticket', 'assign_user_id'),
            'tickets1' => array(self::HAS_MANY, 'Ticket', 'creator_user_id'),
            'domains' => array(self::MANY_MANY, 'Domain', 'user_domain(user_id, domain_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'User ID',
            'username' => 'User Name',
            'password' => 'Password',
            'password2' => 'Re-type Password',
            'email' => 'e-mail',
            'fname' => 'First Name',
            'mname' => 'Middle Name',
            'lname' => 'Last Name',
            'pic_url' => 'Pic Url',
            'activated' => 'Activated',
            'activation_chain' => 'Activation Chain',
            'disable' => 'Disable',
            'biography' => 'Biography',
            'linkedin_id' => 'Linkedin',
            'fiucs_id' => 'Fiucs',
            'google_id' => 'Google',
            'isAdmin' => 'Administrator',
            'isProMentor' => 'Project Mentor',
            'isPerMentor' => 'Personal Mentor',
            'isDomMentor' => 'Domain Mentor',
            'isStudent' => 'Student',
            'isMentee' => 'Mentee',
            'isJudge' => 'Judge',
            'isEmployer' => 'Employer',
            'vjf_role' => 'Virtual Job Fair Roles:',
            'men_role' => 'Mentoring Platform Roles:',
            'rmj_role' => 'Remote Mobil Judge Roles:'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('username', $this->username, true);
        //$criteria->compare('password',$this->password,true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('fname', $this->fname, true);
        $criteria->compare('mname', $this->mname, true);
        $criteria->compare('lname', $this->lname, true);
        //$criteria->compare('pic_url',$this->pic_url,true);
        $criteria->compare('activated', $this->activated);
        //$criteria->compare('activation_chain',$this->activation_chain,true);
        $criteria->compare('disable', $this->disable);
        //$criteria->compare('biography',$this->biography,true);
        //$criteria->compare('linkedin_id',$this->linkedin_id,true);
        //$criteria->compare('fiucs_id',$this->fiucs_id,true);
        //$criteria->compare('google_id',$this->google_id,true);
        $criteria->compare('isAdmin', $this->isAdmin);
        $criteria->compare('isProMentor', $this->isProMentor);
        $criteria->compare('isPerMentor', $this->isPerMentor);
        $criteria->compare('isDomMentor', $this->isDomMentor);
        $criteria->compare('isStudent', $this->isStudent);
        $criteria->compare('isMentee', $this->isMentee);
        $criteria->compare('isJudge', $this->isJudge);
        $criteria->compare('isEmployer', $this->isEmployer);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /* retrieve all user ids in the system */
    public static function getAllUserId()
    {
        $userid = User::model()->findBySql("SELECT id from user, user_domain WHERE  ");
        return $userid;
    }


    public static function getCurrentUser()
    {
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        return $user;
    }


    public static function getCurrentUserId()
    {
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        return $user->id;
    }


    public static function getUser($userid)
    {
        $user = User::model()->findByPk($userid);
        return $user;
    }

    public static function getUserName($userid)
    {
        $user = User::model()->findByPk($userid);
        return $user->username;
    }


    public static function replaceMessage($to, $message)
    {
        $file = fopen("/var/www/html/coplat/email/index1.html", "r");
        //$file = fopen("C:/wamp/www/coplat/email/index1.html", "r");
        $html = "";
        while (!feof($file)) {
            $html .= fgets($file);
        }
        $html = str_replace("%USER%", $to, $html);
        $html = str_replace("%MESSAGE%", $message, $html);
        return $html;
    }

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    public function isProMentor()
    {
        return $this->isProMentor;
    }

    public function isPerMentor()
    {
        return $this->isPerMentor;
    }

    public function isDomMentor()
    {
        return $this->isDomMentor;
    }

    public function isMentee()
    {
        return $this->isMentee;
    }

    public function isJudge()
    {
        return $this->isJudge;
    }

    public function isEmployer()
    {
        return $this->isEmployer;
    }

    public function isStudent()
    {
        return $this->isStudent;
    }

    public static function isCurrentUserAdmin()
    {
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        if ($user == null)
            return false;
        return $user->isAdmin;
    }

    public static function isCurrentUserMentee()
    {
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        if ($user == null)
            return false;
        return $user->isMentee;
    }

    public static function isCurrentUserProMentor()
    {
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        if ($user == null)
            return false;
        return $user->isProMentor;
    }

    public static function isCurrentUserDomMentor()
    {
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        if ($user == null)
            return false;
        return $user->isDomMentor;
    }

    public static function isCurrentUserPerMentor()
    {
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        if ($user == null)
            return false;
        return $user->isPerMentor;
    }

    public static function isCurrentUserJudge()
    {
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        if ($user == null)
            return false;
        return $user->isJudge;
    }

    public static function isCurrentUserEmployer()
    {
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        if ($user == null)
            return false;
        return $user->isEmployer;
    }

    public static function isCurrentUserStudent()
    {
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        if ($user == null)
            return false;
        return $user->isStudent;
    }


    /*Assign Domain Mentor to a Ticket */
    public static function assignTicket($domain_id, $sub)
    {
        /*Query to the User_Domain model */

        if ($sub) {
            $userDomain = UserDomain::model()->findAllBySql("SELECT * FROM user_domain WHERE subdomain_id =:id", array(":id" => $domain_id));
            $subdomain = Subdomain::model()->findByPk($domain_id);
            $validator = $subdomain->validator;
        } else {
            $userDomain = UserDomain::model()->findAllBySql("SELECT * FROM user_domain WHERE domain_id =:id", array(":id" => $domain_id));
            $domain = Domain::model()->findByPk($domain_id);
            $validator = $domain->validator;
        }

        if ($userDomain != null && is_array($userDomain)) {
            foreach ($userDomain as $auserDomain) {
                /** @var UserDomain $auserDomain */
                if ($auserDomain->tier_team == 1) {


                    if ($auserDomain->rate >= $validator) {
                        /*Query to the domain mentor to see how many tickets is allowed to be assigned */
                        $domainMentor = DomainMentor::model()->findAllBySql("SELECT * FROM domain_mentor WHERE user_id =:id", array(":id" => $auserDomain->user_id));
                        /** @var Ticket $count */
                        if (is_array($domainMentor)) {
                            foreach ($domainMentor as $adomainMentor) {
                                /** @var DomainMentor $adomainMentor */
                                $count = Ticket::model()->findBySql("SELECT COUNT(id) as `id` FROM ticket WHERE assign_user_id =:id", array(":id" => $adomainMentor->user_id));
                                if ($count->id < $adomainMentor->max_tickets) {
                                    /*return the first available domain mentor on queue */
                                    return $auserDomain->user_id;
                                }
                            }
                        }
                    }
                }
            }
        }
        return self::$admin; /* Assign the ticket to the admin for reassign */
    }

    function __toString()
    {
        return sprintf("%s %s", $this->fname, $this->lname);
    }

    public static function sendVerificationEmail($userfullName, $user_email, $adminfullName, $admin_email)
    {
        $email = Yii::app()->email;
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $message = $userfullName . ", has register on the system. Administration, verification is needed to complete the registration process.<br> User email address = ".$user_email."<br/>" . $link . " to follow access the platform.";
        $html = User::replaceMessage($adminfullName, $message);

        $email->to = $admin_email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'We have a New Member!!!!';
        $email->message = $html;
        $email->send();
    }

    public static function sendEmailPasswordChanged($user_id)
    {
        $user = User::model()->find("id=:id", array(':id' => $user_id));

        $message = "Your password on the Collaborative Platform Portal has change. If you are not aware of this change contact the system administrator as soon as possible.";
        $html = User::replaceMessage($user->fname, $message);

        $email = Yii::app()->email;
        $email->to = $user->email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'Password Change';
        $email->message = $html;
        $email->send();
    }

    public static function sendEmailWithNewPassword($username, $password)
    {
        $user = User::model()->find("username=:username", array(':username' => $username));
        $message = "Your new password in the Collaborative Platform is: $password";
        $html = User::replaceMessage($user->fname, $message);

        $email = Yii::app()->email;
        $email->to = $user->email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'Your New Password';
        $email->message = $html;
        $email->send();
    }

    public static function sendEmailNotificationAlert($address, $to, $from, $message)
    {

        $email = Yii::app()->email;
        $email->to = $address;
        $email->from = 'Collaborative Platform';
        $email->message = $message;
        $email->subject = 'Collaborative Platform';
        $email->send();
    }

    public static function sendNewMessageEmailNotification($sender, $receiver, $message)
    {
        $send = User::model()->find("username=:username", array(':username' => $sender));
        $receive = User::model()->find("username=:username", array(':username' => $receiver));
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php/message');
        $from = $send->fname . " " . $send->lname;
        $to = $receive->fname . " " . $receive->lname;
        $msg = "You just got a message from " . $from . "<br/>" . $message . "<br/>" . $link . "to see the message";
        $html = User::replaceMessage($to, $msg);

        $email = Yii::app()->email;
        $email->to = $receive->email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'New Message';
        $email->message = $html;
        $email->send();
    }

    public static function sendNewAdministratorEmailNotification($receiver_email, $password)
    {
        $user = User::model()->find("email=:email", array(':email' => $receiver_email));
        $to = $user->fname . " " . $user->lname;
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');
        $message = "You has been chosen to be part of the Collaborative Platform as System Administrator.<br/> Username: " . $user->username . "<br/>Password:" . $password . "<br/>" . $link . "to access the platform.";
        $html = User::replaceMessage($to, $message);

        $email = Yii::app()->email;
        $email->to = $receiver_email;
        $email->subject = 'Welcome';
        $email->from = 'Collaborative Platform';
        $email->message = $html;

        $email->send();
    }

    public static function sendTicketAssignedEmailNotification($creator_id, $assign_id, $ticket_domain)
    {
        $creator = User::model()->find("id=:id", array(':id' => $creator_id));
        $domMentor = User::model()->find("id=:id", array(':id' => $assign_id));
        $domain = Domain::model()->find("id=:id", array(':id' => $ticket_domain));

        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $message = "The user, " . $creator->fname . " " . $creator->lname . ", has created a ticket that has being assigned to you. $link to view";
        $name = $domMentor->fname . ' ' . $domMentor->lname;
        $html = User::replaceMessage($name, $message);

        $email = Yii::app()->email;
        $email->to = $domMentor->email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'New Ticket related to ' . $domain->name;
        $email->message = $html;
        $email->send();

    }

    public static function sendTicketCommentedEmailNotification($ticket_id)
    {
        $ticket = Ticket::model()->find("id=:id", array(':id' => $ticket_id));
        $ticket_creator = User::model()->find("id=:id", array(':id' => $ticket->creator_user_id));
        $ticket_mentor = User::model()->find("id=:id", array(':id' => $ticket->assign_user_id));

        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');


        if ($ticket_creator->id == User::model()->getCurrentUser()->id) {
            $message = "The user, " . $ticket_creator->fname . " " . $ticket_creator->lname . ", has added a new comment to the his/her ticket #" . $ticket->id . ". $link to view the comment.";
            $name = $ticket_mentor->fname . ' ' . $ticket_mentor->lname;
            $html = User::replaceMessage($name, $message);

            $email = Yii::app()->email;
            $email->to = $ticket_mentor->email;
            $email->from = 'Collaborative Platform';
            $email->subject = 'Comment added to Ticket #' . $ticket->id;
            $email->message = $html;
            $email->send();
        } elseif ($ticket_mentor->id == User::model()->getCurrentUser()->id) {
            $message = "The Domain Mentor, " . $ticket_mentor->fname . " " . $ticket_mentor->lname . ", has added a new comment to the ticket #" . $ticket->id . ". $link to view the comment.";
            $name = $ticket_creator->fname . ' ' . $ticket_creator->lname;
            $html = User::replaceMessage($name, $message);

            $email = Yii::app()->email;
            $email->to = $ticket_creator->email;
            $email->from = 'Collaborative Platform';
            $email->subject = 'Comment added to Ticket #' . $ticket->id;
            $email->message = $html;
            $email->send();
        } else {
            $comment_creator = User::model()->getCurrentUser();
            $message = "The user, " . $comment_creator->fname . " " . $comment_creator->lname . ", has added a new comment to the ticket #" . $ticket->id . ". $link to view the comment.";
            $name = "";
            $html = User::replaceMessage($name, $message);

            $email = Yii::app()->email;
            $email->to = $ticket_mentor->email . "," . $ticket_creator->email;
            $email->from = 'Collaborative Platform';
            $email->subject = 'Comment added to Ticket #' . $ticket->id;
            $email->message = $html;
            $email->send();
        }
    }

    public static function sendInvitationEmail($invitation)
    {
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');
        $admin = User::model()->findByPk($invitation->administrator_user_id);
        $to = "";
        $message = "The Collaborative Platform system administrator, " . $admin->fname . " " . $admin->lname . ", through this email would like to invite you to participate on it as: <br/>";
        if ($invitation->administrator == 1)
            $message = $message . "<b><u>System Administrator</u>: Role Description.</b><br/>";
        if ($invitation->mentor == 1)
            $message = $message . "<b><u>Mentor</u></b><br/>&nbsp;&nbsp;<i>Domain Mentor: Role Description.</i><br/>&nbsp;&nbsp;<i>Project Mentor: Role Description.</i><br/>&nbsp;&nbsp;<i>Personal Mentor: Role Description.</i><br/>";
        if ($invitation->employer == 1)
            $message = $message . "<b><u>Employer</u>: Role Description.</b><br/>";
        if ($invitation->judge == 1)
            $message = $message . "<b><u>Judge</u>: Role Description.</b><br/>";
        if ($invitation->mentee == 1)
            $message = $message . "<b><u>Mentee</u>: Role Description.</b><br/>";

        $message = $message . "<br/>" . $link . " to access the platform.";

        $html = User::replaceMessage($to, $message);

        $email = Yii::app()->email;
        $email->to = $invitation->email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'We need you.';
        $email->message = $html;
        $email->send();

    }

    public static function addNewMessageNotification($sender, $reciver, $link, $level)
    {

        $model = new Notification;
        $model->sender_id = $sender;

        $recive = User::model()->find("username=:username", array(':username' => $reciver));
        if ($recive != NULL) {
            $model->receiver_id = $recive->id;
            $model->datetime = date('Y-m-d H:i:s');
            $model->been_read = 0;
            $model->link = $link;
            //print "<pre>"; print_r($model->link);print "</pre>";return;
            $model->message = 'You got a new message from ' . $sender;
            $model->importancy = $level;
            $model->save(false);
        }

    }

    /* Ticket has been reassigned, send notification to all parties involved*/
    public static function sendTicketStatusCommentedEmailNotification($ticket_id, $description, $done_by)
    {
        $ticket = Ticket::model()->findByPk($ticket_id);
        $creator = User::model()->findByPk($ticket->creator_user_id);
        $mentor = User::model()->findByPk($ticket->assign_user_id);
        $user= User::model()->findByPk($done_by);
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $email_from = 'Collaborative Platform';
        if($ticket->status == 'Pending')
            $status = 'Reassign';
        else
            $status = strtolower($ticket->status);

        $email_subject = 'Ticket # ' . $ticket_id . ' has been '.$status.'ed.';


        if ($creator->id == $done_by) {
            $to = $mentor->fname . ' ' . $mentor->lname;
            $from = $creator->fname . ' ' . $creator->lname;
            $message = $from . ", has ".$status."ed the ticket #" . $ticket_id . ", related to " . $ticket->subject . ".<br/>Reason: ".$description."<br/>" . $link . " to see the its information.";
            $html = User::replaceMessage($to, $message);

            $email = Yii::app()->email;
            $email->from = $email_from;
            $email->subject = $email_subject;
            $email->to = $mentor->email;
            $email->message = $html;
            $email->send();


        } else {
            $to = $mentor->fname . ' ' . $mentor->lname;
            $from = $user->fname . ' ' . $user->lname;
            $message = $from . ", has ".$status."ed the ticket #" . $ticket_id . ", related to " . $ticket->subject . ".<br/>Reason: ".$description."<br/>" . $link . " to see the its information.";
            $html = User::replaceMessage($to, $message);
            $email = Yii::app()->email;
            $email->from = $email_from;
            $email->subject = $email_subject;
            $email->to = $mentor->email;
            $email->message = $html;
            $email->send();

            $to = $creator->fname . ' ' . $creator->lname;
            $message = $from . ", has ".$status."ed the ticket #" . $ticket_id . ", related to " . $ticket->subject . ".<br/>Reason: ".$description."<br/>" . $link . " to see the its information.";
            $html = User::replaceMessage($to, $message);
            $email1 = Yii::app()->email;
            $email1->from = $email_from;
            $email1->subject = $email_subject;
            $email1->to = $creator->email;
            $email1->message = $html;
            $email1->send();
        }
    }
    /* Ticket has being reassigned, notification to previous mentor working on the ticket */
    public static function sendStatusCommentedEmailNotificationToOldMentor($ticket_id, $prev_mentor, $assigned_by)
    {
        $ticket = Ticket::model()->findAllByPk($ticket_id);
        $old_mentor = User::model()->findByPk($prev_mentor);
        $user = User::model()->findByPk($assigned_by);
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $to = $old_mentor->fname . ' ' . $old_mentor->lname;
        $from = $user->fname . ' ' . $user->lname;

        if($ticket->status == 'Pending')
            $status = 'reassign';
        else
            $status = strtolower($ticket->status);


        $message = $from . ", has ".$status."ed the ticket #" . $ticket_id . ", related to " . $ticket->subject . ".<br/>" . $link . " to see the its information.";
        $html = User::replaceMessage($to, $message);

        $email = Yii::app()->email;
        $email->to = $old_mentor->email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'Ticket # ' . $ticket_id . ' has been '.$status.'ed.';
        $email->message = $html;
        $email->send();
    }

    /*Meeting notification */
    public static function sendMeetingNotification($project_mentor_user_id, $mentee_user_id, $date, $time)
    {
        $mentee = User::model()->findByPk($mentee_user_id);
        $mentor = User::model()->findByPk($project_mentor_user_id);
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $to = $mentee->fname . ' ' . $mentee->lname;
        $from = $mentor->fname . ' ' . $mentor->lname;
        $message = "Your Senior Project mentor, " . $from . ", setup a meeting for " . $date . ", at " . $time . ".<br/>" . $link . " for more details.";
        $html = User::replaceMessage($to, $message);
        $email = Yii::app()->email;
        $email->to = $mentee->email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'Project Meeting';
        $email->message = $html;
        $email->send();
    }

    /*Ticket has closed by the creator */
    /*public static function sendCloseTicketEmailNotification($creator_user_id, $assign_user_id, $ticket_id)
    {
        $creator = User::model()->findByPk($creator_user_id);
        $mentor = User::model()->findByPk($assign_user_id);
        $ticket = Ticket::model()->findByPk($ticket_id);
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');
        $to = $mentor->fname . ' ' . $mentor->lname;
        $from = $creator->fname . ' ' . $creator->lname;
        $message = "The user, " . $from . ", has closed the ticket #" . $ticket_id . ", related to " . $ticket->subject . ".<br/>" . $link . " to see the its information.";
        $html = User::replaceMessage($to, $message);

        $email = Yii::app()->email;

        $email->to = $mentor->email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'Ticket # ' . $ticket_id . ' has been closed.';
        $email->message = $html;
        $email->send();
    }*/

    /*public static function sendRejectEmailNotification($creator_user_id, $assign_user_id, $ticket_id, $rejected_by)
    {
        $creator = User::model()->findByPk($creator_user_id);
        $mentor = User::model()->findByPk($assign_user_id);
        $reject = User::model()->findByPk($rejected_by);
        $ticket = Ticket::model()->findByPk($ticket_id);
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');
        $from = $reject->fname . ' ' . $reject->lname;

        if ($creator_user_id == $rejected_by) {
            $to = $mentor->fname . ' ' . $mentor->lname;
            $message = "The user, " . $from . ", has reject the latest comment in the ticket #" . $ticket_id . ", related to " . $ticket->subject . ".<br/>" . $link . " to see the its information.";
            $html = User::replaceMessage($to, $message);

            $email = Yii::app()->email;
            $email->to = $mentor->email;
            $email->from = 'Collaborative Platform';
            $email->subject = 'Ticket #' . $ticket_id . ", status changed to Rejected";
            $email->message = $html;
            $email->send();
        } else {
            $to = '';
            $message = "The System Administrator, " . $from . ", has reject the latest comment in the ticket #" . $ticket_id . ", related to " . $ticket->subject . ".<br/>" . $link . " to see the its information.";
            $html = User::replaceMessage($to, $message);

            $email = Yii::app()->email;
            $email->to = $mentor->email . ';' . $creator->email;
            $email->from = 'Collaborative Platform';
            $email->subject = 'Ticket #' . $ticket_id . ", status changed to Rejected";
            $email->message = $html;
            $email->send();
        }
    }*/

}