<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $propose_by_user_id
 * @property string $project_mentor_user_id
 * @property string $start_date
 * @property string $due_date
 * @property string $customer_fname
 * @property string $customer_lname
 *
 * The followings are the available model relations:
 * @property ApplicationProjectMentorPick[] $applicationProjectMentorPicks
 * @property Mentee[] $mentees
 * @property User $proposeByUser
 * @property ProjectMentor $projectMentorUser
 * @property ProjectMentorProjects[] $projectMentorProjects
 */
class Project extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('propose_by_user_id', 'required'),
			array('id, propose_by_user_id, project_mentor_user_id', 'length', 'max'=>11),
			array('title', 'length', 'max'=>45),
			array('description', 'length', 'max'=>1024),
			array('customer_fname, customer_lname', 'length', 'max'=>20),
			array('start_date, due_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, propose_by_user_id, project_mentor_user_id, start_date, due_date, customer_fname, customer_lname', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'applicationProjectMentorPicks' => array(self::HAS_MANY, 'ApplicationProjectMentorPick', 'project_id'),
			'mentees' => array(self::HAS_MANY, 'Mentee', 'project_id'),
				'projectMentorProjects' => array(self::HAS_MANY, 'ProjectMentorProjects', 'project_id'),
			'proposeByUser' => array(self::BELONGS_TO, 'User', 'propose_by_user_id'),
			'projectMentorUser' => array(self::BELONGS_TO, 'ProjectMentor', 'project_mentor_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'propose_by_user_id' => 'Propose By',
			'project_mentor_user_id' => 'Project Mentor',
			'start_date' => 'Start Date',
			'due_date' => 'Due Date',
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
			'criteria'=>$criteria,
		));
	}
	
	public function searchNoPagination() {
		$criteria = $this->setCriteria();
		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
				'pagination'=>false,
		));
	}
	
	public function setCriteria(){
		$criteria=new CDbCriteria;
		
		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('propose_by_user_id',$this->propose_by_user_id,true);
		$criteria->compare('project_mentor_user_id',$this->project_mentor_user_id,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('customer_fname',$this->customer_fname,true);
		$criteria->compare('customer_lname',$this->customer_lname,true);
		
		return $criteria;
	}
	
	public function getProjectMentor(){
		if ($this->project_mentor_user_id === null)
			return 'No Mentor Assigned';
		else return ($this->projectMentorUser->user->fname . ' ' . $this->projectMentorUser->user->lname);
	}
	
	public function getShortDescription(){
		$max = 200;
		if (strlen($this->description) > $max)
				return (substr($this->description, 0, $max) . '...');
		else return $this->description;
	}
	
	public function getDescriptionOfSize($size){
		$max = $size;
		if (strlen($this->description) > $max)
			return (substr($this->description, 0, $max) . '...');
		else return $this->description;
		
	}
	
	public function getCustomerFullName(){
		return $this->customer_fname . ' ' .$this->customer_lname;
	}
	
	public function getProjectsForApp($dataProvider, $currentUser){
		$projects = array();
		foreach($dataProvider->getData() as $project){
			$temp = array();
			$temp["id"] = $project->id;
			$temp["title"] = $project->title;
			$temp["customer"] = $project->getCustomerFullName();
			$temp["description"] = $project->getDescriptionOfSize(750);
			
			// get project mentors for this project
			$pmToP = new ProjectMentorProjects;
			$pmToP->project_id = $project->id;
			$temp["mentors"] = $pmToP->getProjectMentors($pmToP->search(), $currentUser);
			
			// get mentees for this project
			$mentees = new Mentee;
			$mentees->project_id = $project->id;
			$temp["mentees"] = $mentees->getMenteesOnProject($mentees->search());
			
			// Only add if user is not on this project
			$projects[] = $temp;
		}
		return $projects;
	}
        
        public static function getMenteeProjects($user_id)
        {
          return Project::model()->findAllBySql("SELECT project.*
                                                FROM project
                                                INNER JOIN mentee ON mentee.project_id = project.id
                                                WHERE mentee.user_id = ".$user_id);  
        }
        
        public function findAllProjects()
        {
            return Project::model()->findAll();
        }
}