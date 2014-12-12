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
 * @property int $university_id
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
 * @property ApplicationDomainMentor[] $applicationDomainMentors
 * @property ApplicationPersonalMentor[] $applicationPersonalMentors
 * @property ApplicationPersonalMentorPick[] $applicationPersonalMentorPicks
 * @property ApplicationProjectMentor[] $applicationProjectMentors
 * @property DomainMentor $domainMentor
 * @property Mentee $mentee
 * @property Message[] $messages
 * @property Message[] $messages1
 * @property PersonalMentor $personalMentor
 * @property PersonalMentorMentees[] $personalMentorMentees
 * @property PersonalMentorMentees[] $personalMentorMentees1
 * @property ProjectMentor $projectMentor
 * @property ProjectMentorProjects[] $projectMentorProjects
 * @property Ticket[] $tickets
 * @property Ticket[] $tickets1
 * @property UserDomain[] $userDomains
 * @property Domain[] $domains
 * @property UserInfo $user_info
 */
class User extends CActiveRecord
{
    public $password2;
    public $vjf_role;
    public $men_role;
    public $rmj_role;
    /* advanced search variables */
    public $firstField;
    public $quantity;
    public $criteria;
    /*assign variables */
    public $userDomain;
    public $userId;
    /*temporary variables currently not stored in db*/
    public $combineRoles;
    public $fullName;
    public $skills;
    public $toggleUser = 0;
    public $invitemessage = '';
    
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
            array('id, username, password, email, fname, mname, lname, pic_url, activated, activation_chain, 
            		disable, biography, linkedin_id, fiucs_id, google_id, isAdmin, isProMentor, isPerMentor, 
            		isDomMentor, isStudent, isMentee, isJudge, isEmployer, combineRoles, fullName', 'safe', 'on' => 'search'),
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
        		'applicationDomainMentors' => array(self::HAS_MANY, 'ApplicationDomainMentor', 'user_id'),
        		'applicationPersonalMentors' => array(self::HAS_MANY, 'ApplicationPersonalMentor', 'user_id'),
        		'applicationPersonalMentorPicks' => array(self::HAS_MANY, 'ApplicationPersonalMentorPick', 'user_id'),
        		'applicationProjectMentors' => array(self::HAS_MANY, 'ApplicationProjectMentor', 'user_id'),
        		'domainMentor' => array(self::HAS_ONE, 'DomainMentor', 'user_id'),
        		'mentee' => array(self::HAS_ONE, 'Mentee', 'user_id'),
        		'messages' => array(self::HAS_MANY, 'Message', 'receiver'),
        		'messages1' => array(self::HAS_MANY, 'Message', 'sender'),
        		'personalMentor' => array(self::HAS_ONE, 'PersonalMentor', 'user_id'),
        		'personalMentorMentees' => array(self::HAS_MANY, 'PersonalMentorMentees', 'user_id'),
        		'personalMentorMentees1' => array(self::HAS_MANY, 'PersonalMentorMentees', 'personal_mentor_id'),
        		'projectMentor' => array(self::HAS_ONE, 'ProjectMentor', 'user_id'),
        		'projectMentorProjects' => array(self::HAS_MANY, 'ProjectMentorProjects', 'user_id'),
        		'tickets' => array(self::HAS_MANY, 'Ticket', 'assign_user_id'),
        		'tickets1' => array(self::HAS_MANY, 'Ticket', 'creator_user_id'),
        		'userDomains' => array(self::HAS_MANY, 'UserDomain', 'user_id'),
        		'user_info' => array(self::HAS_ONE, 'UserInfo', 'user_id'),
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
            'email' => 'Email',
            'fname' => 'First Name',
            'mname' => 'Middle Name',
            'lname' => 'Last Name',
            'pic_url' => 'Pic Url',
            'activated' => 'Activated',
            'activation_chain' => 'Activation Chain',
            'disable' => 'Disabled',
            'biography' => 'Biography',
        	'university_id' => 'University',
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
            'rmj_role' => 'Remote Mobil Judge Roles:',
            'rmj_role' => 'Remote Mobil Judge Roles:',
            'firstField' => 'Type: ',
        	'criteria' => 'Assigned to: ',
        	'quantity' => 'projects, mentors, or mentees',
            'combineRoles' => 'Roles',
        	'fullName' => 'Name',
        	'skills' => 'Skills',	
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
        $criteria = $this->setCriteria();
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        		'sort'=>array(
        				'attributes'=>array(
        						'fullName'=>array(
        								'asc'=>'lname',
        								'desc'=>'lname DESC',
        						),
        						'*',
        				),
        		),
        ));
    }
    
    public function searchNoPagination() {
    	$criteria = $this->setCriteria();
    	return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        		'sort'=>array(
        				'attributes'=>array(
        						'fullName'=>array(
        								'asc'=>'lname',
        								'desc'=>'lname DESC',
        						),
        						'*',
        				),
        		),
        		'pagination'=>false,
        ));
    }
    
    public function setCriteria(){
    	$criteria = new CDbCriteria;
    	
    	$criteria->compare('fname', $this->fullName, true, 'OR');
    	$criteria->compare('lname', $this->fullName, true, 'OR');
    	
    	//$criteria->compare('id', $this->id, true);
    	$criteria->compare('username', $this->username, true);
    	//$criteria->compare('password',$this->password,true);
    	$criteria->compare('email', $this->email, true);
    	//$criteria->compare('fname', $this->fname, true);
    	//$criteria->compare('mname', $this->mname, true);
    	//$criteria->compare('lname', $this->lname, true);
    	//$criteria->compare('pic_url',$this->pic_url,true);
    	$criteria->compare('activated', $this->activated);
    	//$criteria->compare('activation_chain',$this->activation_chain,true);
    	$criteria->compare('disable', $this->disable);
    	//$criteria->compare('biography',$this->biography,true);
    	//$criteria->compare('linkedin_id',$this->linkedin_id,true);
    	//$criteria->compare('fiucs_id',$this->fiucs_id,true);
    	//$criteria->compare('google_id',$this->google_id,true);
    	//$criteria->compare('isAdmin', $this->isAdmin);
    	$criteria->compare('isProMentor', $this->isProMentor);
    	$criteria->compare('isPerMentor', $this->isPerMentor);
    	$criteria->compare('isDomMentor', $this->isDomMentor);
    	$criteria->compare('isStudent', $this->isStudent);
    	$criteria->compare('isMentee', $this->isMentee);
    	//$criteria->compare('isJudge', $this->isJudge);
    	//$criteria->compare('isEmployer', $this->isEmployer);
    	
    	return $criteria;
    }

    public function getCombineRoles(){
    	$count = 0;
        $st = '';

        if ($this->isProMentor){
        	$count = $count + 1;
            $st .= 'Project ';
        }
        if ($this->isPerMentor){
        	if ($count >= 1) $st .= ' | ';
        	$count = $count + 1;
        	 
            $st .= 'Personal ';
        }
        if ($this->isDomMentor){
        	if ($count >= 1) $st .= ' | ';
        	$count = $count + 1;
        	 
     
            $st .= 'Domain ';
        }
        if ($this->isMentee){
        	if ($count >= 1) $st .= ' | ';
        	$count = $count + 1;
        	 
            $st .= 'Mentee';
        }
        return $st;
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
	if ($user == null) { Yii::app()->getController()->redirect('/coplat/index.php/site/login');  }
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
        //$file = fopen("C:/xampp/htdocs/coplat/email/index1.html", "r");
        $html = "";
        while (!feof($file)) {
            $html .= fgets($file);
        }
        $html = str_replace("%USER%", $to, $html);
        $html = str_replace("%MESSAGE%", $message, $html);
        return $html;
    }
    
    public function getMenteeProject(){
    	//$ret = $this->mentee->
    }
    
    public function getMenteePersonalMentor(){
    	
    }
    
    public function getFullName(){
    	$name = $this->fname . ' ' . $this->lname;
    	return $name;
    }
    
    // returns a list of users
    public function returnUsersForApp($dataProvider, $id){
    	$users = array();
    	foreach($dataProvider->getData() as $user){
    		$temp = array();
    		
    		$temp["id"] = $user->id;
    		$temp["name"] = $user->getFullName();
    		$temp["university"] = University::model()->universityById($user->university_id);
    		$temp["avatar"] = $user->pic_url;
    		$temp["email"] = $user->email;
    		
    		$mentee = Mentee::model()->findByPk($user->id);
    		$mentorTrim = array();
    		$mentorTrim["name"] = "None";
    		$mentorTrim["avatar"] = "";
    		
    		if(count($mentee) == 0){
    			$temp["project"] = "None";
    			$temp["description"] = "";
    			$temp["mentor"] = $mentorTrim;
    		} else {
    			$project = Project::model()->findByPk($mentee->project_id);
    			if(count($project) > 0){
    				$temp["project"] = $project->title;
    				$temp["description"] = $project->getDescriptionOfSize(200);
    			} else{
    				$temp["project"] = "None";
    				$temp["description"] = "";
    			}
    				
    			$personalMentor = User::model()->findByPk($mentee->personal_mentor_user_id);
    			if(count($personalMentor) > 0 && $mentee->personal_mentor_user_id != 999){
    				$mentorTrim = array();
    				$mentorTrim["name"] = $personalMentor->getFullName();
    				$mentorTrim["avatar"] = $personalMentor->pic_url;
    			} 
    			$temp["mentor"] = $mentorTrim;
    			
    		}
    		
    		
    		$users[] = $temp;
    	}
    	return $users;
    }
    
    public function getUniversityName(){
    	$uni = University::model()->findByPk($this->university_id);
    	if($uni == NULL) return "FIU";
    	return $uni->name;
    }
    
    public function getPic(){
    	$pic = '<img src="' . $this->pic_url . '" height="20" width="20"></img>';
    	return $pic;
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

    public static function sendTicketClosedNotification($ticket_id, $userfullName,  $mentorfullName, $mentor_email)
    {
        $email = Yii::app()->email;
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $message = $userfullName . ", has closed the ticket #".$ticket_id;
        $html = User::replaceMessage($mentorfullName, $message);

        $email->to = $mentor_email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'Ticket #'.$ticket_id.' has been closed.';
        $email->message = $html;
        $email->send();
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

    //tito   /*Assign Domain Mentor to a Ticket */
    public static function reassignTicket($domain_id, $sub, $oldMentorId, $tier)
    {
        /*Query to the User_Domain model */
        if ($sub) {
            $userDomain = UserDomain::model()->findAllBySql("SELECT * FROM user_domain WHERE subdomain_id =:id and user_id !=:id2", array(":id" => $domain_id, ":id2" => $oldMentorId));
            $subdomain = Subdomain::model()->findByPk($domain_id);
            $validator = $subdomain->validator;
        } else {
            $userDomain = UserDomain::model()->findAllBySql("SELECT * FROM user_domain WHERE domain_id =:id and user_id !=:id2", array(":id" => $domain_id, ":id2" => $oldMentorId));
            $domain = Domain::model()->findByPk($domain_id);
            $validator = $domain->validator;
        }

        if ($userDomain != null && is_array($userDomain)) {
            foreach ($userDomain as $auserDomain) {
                /** @var UserDomain $auserDomain */
                if ($auserDomain->tier_team ==  $tier) {


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
/*
    public static function sendVerificationEmail($userfullName, $user_email, $adminfullName, $admin_email)
    {
        $email = Yii::app()->email;
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $message = $userfullName . ", has registered on the platform. Administration verification is needed to complete the registration process.<br> User email address: ".$user_email."</h2><br/>" . $link . " to follow access the platform.";
        $html = User::replaceMessage($adminfullName, $message);

        $email->to = $admin_email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'We have a New Member!!!!';
        $email->message = $html;
        $email->send();
    }*/
    public static function sendConfirmationEmail($userfullName, $user_email, $username, $password, $adminfullName)
    {
        $email = Yii::app()->email;
        $link = CHtml::link('Click here to go to the site', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $message = $adminfullName.' has registered you on the platform. Please use the credentials below to log in:<br><br>Username:' . $username . ' <br>Password: '.$password.'<br><br>You can change your password once logged in. <br><br>Thank you<br><br>'.$link.'';
        $html = User::replaceMessage($userfullName, $message);

        $email->to = $user_email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'Congratulations!';
        $email->message = $html;
        $email->send();
    }

    public static function sendRejectionAlertToAdmin($ticket_id, $userfullName, $user_email, $adminfullName, $admin_email)
    {
        $email = Yii::app()->email;
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $message = $userfullName . ", has rejected the ticket #".$ticket_id.".<br> User e-mail address: ".$user_email."</h2><br/>" . $link . " to view the rejection reason.";
        $html = User::replaceMessage($adminfullName, $message);

        $email->to = $admin_email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'Ticket #'.$ticket_id.' has been rejected.';
        $email->message = $html;
        $email->send();
    }

    public static function sendEmailPasswordChanged($user_id)
    {
        $user = User::model()->find("id=:id", array(':id' => $user_id));
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $message = "Your password on the Collaborative Platform Portal was changed. If you are not aware of this change.</h2><br/>".$link." to contact a system administrator as soon as possible.";
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
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $message = "Your new password in the Collaborative Platform is: ".$password." </h2><br/>".$link." to access the platform.";
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
        $msg = "You just got a message from " . $from . "<br/>" . $message . "</h2><br/>" . $link . "to see the message";
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
        $message = "You has been chosen to be part of the Collaborative Platform as System Administrator.<br/> Username: " . $user->username . "<br/>Password:" . $password . "</h2><br/>" . $link . "to access the platform.";
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

        $message = "The user, " . $creator->fname . " " . $creator->lname . ", has created a ticket that has being assigned to you. </h2><br/>".$link." for more information.";
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
            $message = $ticket_creator->fname . " " . $ticket_creator->lname . ", has added a new comment to the his/her ticket #" . $ticket->id . "</h2><br/>. $link to view the comment.";
            $name = $ticket_mentor->fname . ' ' . $ticket_mentor->lname;
            $html = User::replaceMessage($name, $message);

            $email = Yii::app()->email;
            $email->to = $ticket_mentor->email;
            $email->from = 'Collaborative Platform';
            $email->subject = 'Comment added to Ticket #' . $ticket->id;
            $email->message = $html;
            $email->send();
        } elseif ($ticket_mentor->id == User::model()->getCurrentUser()->id) {
            $message = $ticket_mentor->fname . " " . $ticket_mentor->lname . ", has added a new comment to the ticket #" . $ticket->id . ". </h2><br/>".$link." to view the comment.";
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
            $message = $comment_creator->fname . " " . $comment_creator->lname . ", has added a new comment to the ticket #" . $ticket->id . ". </h2><br/>".$link." to view the comment.";
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
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php/site/landing');
        $admin = User::model()->findByPk($invitation->administrator_user_id);
        $to = "";
        $message = "The Collaborative Platform system administrator, " . $admin->fname . " " . $admin->lname . ", through this email would like to invite you to participate on it as: <br/>";
        if ($invitation->administrator == 1)
            $message = $message . "<b><u>System Administrator</u>: Responsible, for users, invitations, projects, domains and sub-domains management.</b><br/>";
        if ($invitation->mentor == 1)
            $message = $message . "<b><u>Mentor</u></b><br/>&nbsp;&nbsp;<i>Domain Mentor: Provide solutions using his/her expertise in specific domains to questions within the platform.</i><br/>&nbsp;&nbsp;<i>Project Mentor: Guide the project development through the semester.</i><br/>&nbsp;&nbsp;<i>Personal Mentor: Provide assistance and guidance to his/her mentees.</i><br/>";
        if ($invitation->employer == 1)
            $message = $message . "<b><u>Employer</u>: Publish Job offers, and get to interview potential employees through the Virtual Job Fair Module.</b><br/>";
        if ($invitation->judge == 1)
            $message = $message . "<b><u>Judge</u>: Judge Senior Projects presentations through the Remote Judge Module.</b><br/>";
        if ($invitation->mentee == 1)
            $message = $message . "<b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/>";

        $message = $message . "</h2><br/>" . $link . " to access the platform.";

        $html = User::replaceMessage($to, $message);

        $email = Yii::app()->email;
        $email->to = $invitation->email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'We need you.';
        $email->message = $html;
        $email->send();

    }
    
    public static function sendInviteByMessage($invitation){
    	$to = "";
    	$message = $invitation->message;
    	$html = User::replaceMessage($to, $message);
    	$email = Yii::app()->email;
    	$email->to = $invitation->email;
    	$email->from = 'Collaborative Platform';
    	$email->subject = 'We need you.';
    	$email->message = $html;
    	$email->send();
    	
    	
    }
    
    public static function setInvitationEmail($invitation)
    {
    	$link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php/site/landing');
    	$admin = User::model()->findByPk($invitation->administrator_user_id);
    	$to = "";
    	$message = "The Collaborative Platform system administrator, " . $admin->fname . " " . $admin->lname . ", through this email would like to invite you to participate on it as: <br/>";
    	if ($invitation->administrator == 1)
    		$message = $message . "<b><u>System Administrator</u>: Responsible, for users, invitations, projects, domains and sub-domains management.</b><br/>";
    	if ($invitation->mentor == 1)
    		$message = $message . "<b><u>Mentor</u></b><br/>&nbsp;&nbsp;<i>Domain Mentor: Provide solutions using his/her expertise in specific domains to questions within the platform.</i><br/>&nbsp;&nbsp;<i>Project Mentor: Guide the project development through the semester.</i><br/>&nbsp;&nbsp;<i>Personal Mentor: Provide assistance and guidance to his/her mentees.</i><br/>";
    	if ($invitation->employer == 1)
    		$message = $message . "<b><u>Employer</u>: Publish Job offers, and get to interview potential employees through the Virtual Job Fair Module.</b><br/>";
    	if ($invitation->judge == 1)
    		$message = $message . "<b><u>Judge</u>: Judge Senior Projects presentations through the Remote Judge Module.</b><br/>";
    	if ($invitation->mentee == 1)
    		$message = $message . "<b><u>Mentee</u>: Platform general user that will interact will the all the users of the platform trough the Mentoring Module..</b><br/>";
    
    	$message = $message . "</h2><br/>" . $link . " to access the platform.";
    
    	$invitemessage = $message;
    	return $message;
    }

    public static function addNewMessageNotification($sender, $receiver, $link, $level)
    {

        $model = new Notification;
        $model->sender_id = $sender;

        $recive = User::model()->find("username=:username", array(':username' => $receiver));
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
            $message = $from . ', has '.$status.'ed the ticket #' . $ticket_id . ', related to ' . $ticket->subject . '.<br/><h2 style="color: #ff0000">Reason: '.$description.'.</h2><br/>' . $link . ' to see the its information.';
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
            $message = $from . ', has '.$status.'ed the ticket #' . $ticket_id . ', related to ' . $ticket->subject . '.<br/><h2 style="color: #ff0000">Reason: '.$description.'.</h2><br/>' . $link . ' to see the its information.';
            $html = User::replaceMessage($to, $message);
            $email = Yii::app()->email;
            $email->from = $email_from;
            $email->subject = $email_subject;
            $email->to = $mentor->email;
            $email->message = $html;
            $email->send();

            $to = $creator->fname . ' ' . $creator->lname;
            $message = $from . ', has '.$status.'ed the ticket #' . $ticket_id . ', related to ' . $ticket->subject . '.<br/><h2 style="color: #ff0000">Reason: '.$description.'.</h2><br/>' . $link . ' to see the its information.';
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
    public static function sendStatusReassignedEmailNotificationToOldMentor($ticket_id, $prev_mentor, $done_by)
    {
        $ticket = Ticket::model()->findByPk($ticket_id);
        $old_mentor = User::model()->findByPk($prev_mentor);
        $user = User::model()->findByPk($done_by);
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $to = $old_mentor->fname . ' ' . $old_mentor->lname;
        $from = $user->fname . ' ' . $user->lname;

        $message = $from . ", has reassigned the ticket #" . $ticket_id . ", related to " . $ticket->subject . ". Therefore, is now out of your queue.<br/>" . $link . " to see the its information.";
        $html = User::replaceMessage($to, $message);

        $email = Yii::app()->email;
        $email->to = $old_mentor->email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'Ticket # ' . $ticket_id . ' has been reassigned.';
        $email->message = $html;
        $email->send();
    }

    /* Ticket has being reassigned, notification to previous mentor working on the ticket */
    public static function sendStatusAutoReassignedEmailNotificationToOldMentor($ticket_id, $prev_mentor, $done_by)
    {
        $ticket = Ticket::model()->findByPk($ticket_id);
        $old_mentor = User::model()->findByPk($prev_mentor);
        $user = User::model()->findBySql("SELECT * from user  WHERE username=:id", array(":id" => 'SYSTEM'));
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $to = $old_mentor->fname . ' ' . $old_mentor->lname;
        $from = $user->fname . ' ' . $user->lname;

        $message = $from . ", has reassigned the ticket #" . $ticket_id . ", related to " . $ticket->subject . ". Therefore, is now out of your queue.<br/>" . $link . " to see the its information.";
        $html = User::replaceMessage($to, $message);

        $email = Yii::app()->email;
        $email->to = $old_mentor->email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'Ticket # ' . $ticket_id . ' has been reassigned.';
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

    public static function sendAccountValidatedEmailNotification($user_id, $admin_id)
    {
        $user = User::model()->findByPk($user_id);
        $admin = User::model()->findByPk($admin_id);

        $to = $user->fname.' '.$user->lname;
        $from = $admin->fname.' '.$admin->lname;
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');
        $message = "The System Administrator, ".$from.", has successfully validated your account. You may now try too login.<br/>Thanks for your patience.</h2><br/>".$link." for access.";
        $html = User::replaceMessage($to, $message);

        $email = Yii::app()->email;
        $email->to = $user->email;
        $email->from = 'Collaborative Platform.';
        $email->subject = 'Your Account has being verified.';
        $email->message = $html;
        $email->send();
    }

    public static function sendProfileChangedAdminNotification($adminfullName, $admin_email, $userfullName)
    {
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');
        $message = "The user, ".$userfullName. ", has made some changes to his/her profile that require administration review.</h2><br/>".$link." to view the changes.";
        $html = User::replaceMessage($adminfullName, $message);

        $email = Yii::app()->email;
        $email->to = $admin_email;
        $email->from = 'Collaborative Platform.';
        $email->subject = 'Profile Changed';
        $email->message = $html;
        $email->send();
    }

    public static function sendNotification($admin_email, $subject, $message , $adminfullName)
    {
        $email = Yii::app()->email;
        $link = CHtml::link('Click here', 'http://' . Yii::app()->request->getServerName() . '/coplat/index.php');

        $html = User::replaceMessage($adminfullName, $message);

        $email->to = $admin_email;
        $email->from = 'Collaborative Platform';
        $email->subject = $subject;
        $email->message = $html;
        $email->send();
    }



    public static function automaticReassignBySystem($domain_id, $sub, $oldMentorId, $tier ,$mentor1 , $mentor2)
    {
        /*Query to the User_Domain model */
        if ($sub) {
            $userDomain = UserDomain::model()->findAllBySql("SELECT * FROM user_domain WHERE subdomain_id =:id and user_id !=:id2  and user_id !=:id3  and user_id !=:id4", array(":id" => $domain_id, ":id2" => $oldMentorId, ":id3" => $mentor1, ":id4" => $mentor2));
            $subdomain = Subdomain::model()->findByPk($domain_id);
            $validator = $subdomain->validator;
        } else {
            $userDomain = UserDomain::model()->findAllBySql("SELECT * FROM user_domain WHERE domain_id =:id and user_id !=:id2 and user_id !=:id3 and user_id !=:id4", array(":id" => $domain_id, ":id2" => $oldMentorId, ":id3" => $mentor1, ":id4" => $mentor2));
            $domain = Domain::model()->findByPk($domain_id);
            $validator = $domain->validator;
        }

        if ($userDomain != null && is_array($userDomain)) {
            foreach ($userDomain as $auserDomain) {
                /** @var UserDomain $auserDomain */
                if ($auserDomain->tier_team ==  $tier) {


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
        return 0; /* No avalible mentors */
    }


    public static function escalateTicket($domain_id, $sub)
    {
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
                if ($auserDomain->tier_team == 2) {


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
}