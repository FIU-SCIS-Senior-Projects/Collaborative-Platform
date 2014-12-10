<?php

/**
 * This is the model class for table "project_mentor_projects".
 *
 * The followings are the available columns in table 'project_mentor_projects':
 * @property string $id
 * @property string $user_id
 * @property string $project_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Project $project
 */
class ProjectMentorProjects extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProjectMentorProjects the static model class
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
		return 'project_mentor_projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, project_id', 'required'),
			array('user_id, project_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, project_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'project_id' => 'Project',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('project_id',$this->project_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getProjectMentors($dataprovider, $currentUser){
		$mentors = array();
		foreach($dataprovider->getData() as $mapping){
			$user = new User;
			$user = User::model()->getUser($mapping->user_id);
			
			// If the current user is on this project return empty
			if($user->id == $currentUser) return array();
			
			$temp = array();
			$temp["name"] = $user->getFullName();
			$temp["pic"] = $user->pic_url;
			
			// user id 999 is a default value
			if($user->id != 999)$mentors[] = $temp;
		}
		return $mentors;
	}
}