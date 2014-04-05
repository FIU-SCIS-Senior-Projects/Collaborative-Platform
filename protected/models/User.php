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
    public $topic;
    public $userDomain;
    public $userId;
    /*Change the value when the system is deploy */
    public static $admin = 6;
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
            'isAdmin' => 'Is Admin',
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


    public function sendVerificationEmail()
    {
        $email = Yii::app()->email;
        $address = $this->email;
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php/user/VerifyEmail?username=' . $this->username
            . '&activation_chain=' . $this->activation_chain);
        $email->to = $address;
        $email->from = 'Collaborative Platform';
        $email->subject = 'Verify your account on the Collaborative Platform';
        $email->message = "You need to verify your account before logging in.  $link to verify your account.";
        $email->send();
    }

    public static function sendEmailWithNewPassword($address, $password, $username)
    {
        $email = Yii::app()->email;

        $link = CHtml::link('click here to login', Yii::app()->baseUrl . '/site/login');
        $email->to = $address;
        $email->subject = 'your new password';
        $email->message = "Username: $username<br/> Password: $password<br/>$link";
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

    public static function sendEmailMessageNotificationAlert($address, $message)
    {

        $email = Yii::app()->email;
        $email->to = $address;
        $email->from = 'Collaborative Platform';
        $email->subject = 'New Message';
        $email->message = $message;
        $email->send();
    }

    public static function sendUserNotificationMessageAlert($sender, $reciver, $link, $level)
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
            $model->importancy = 3;
            $model->save(false);
        }

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
    public static function assignTicket($domain_id)
    {
        /*Query to the User_Domain model */
        $userDomain = UserDomain::model()->findAllBySql("SELECT * FROM user_domain WHERE domain_id =:id", array(":id" => $domain_id));
        if ($userDomain != null && is_array($userDomain)) {
            foreach ($userDomain as $auserDomain) {
                /** @var UserDomain $auserDomain */
                if ($auserDomain->tier_team == 1) {
                    if ($auserDomain->rate >= self::$condition) {
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


}