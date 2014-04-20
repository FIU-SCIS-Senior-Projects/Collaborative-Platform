<?php

/**
 * This is the model class for table "project_mentor".
 *
 * The followings are the available columns in table 'project_mentor':
 * @property string $user_id
 * @property integer $max_hours
 * @property integer $max_projects
 *
 * The followings are the available model relations:
 * @property ProjectMeeting[] $projectMeetings
 * @property User $user
 * @property Project[] $projects
 */
class ProjectMentor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProjectMentor the static model class
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
		return 'project_mentor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('max_hours, max_projects', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, max_hours, max_projects', 'safe', 'on'=>'search'),
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
			'projectMeetings' => array(self::HAS_MANY, 'ProjectMeeting', 'project_mentor_user_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'projects' => array(self::MANY_MANY, 'Project', 'projectmentor_project(project_mentor_user_id, project_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'max_hours' => 'Max Hours',
			'max_projects' => 'Max Projects',
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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('max_hours',$this->max_hours);
		$criteria->compare('max_projects',$this->max_projects);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getCurrentUser()
    {
        $username = Yii::app()->user->name;
        $user = User::model()->find("username=:username", array(':username' => $username));
        $promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$user->id");

        return $promentor;
    }
    
    public static function getProMentor($id)
    {
        $promentor = ProjectMentor::model()->findBySql("SELECT * FROM project_mentor WHERE user_id=$id");
        
        return $promentor;
    }
}