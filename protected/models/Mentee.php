<?php

/**
 * This is the model class for table "mentee".
 *
 * The followings are the available columns in table 'mentee':
 * @property string $user_id
 * @property string $projectmentor_project_project_id
 * @property string $projectmentor_project_project_mentor_user_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property ProjectmentorProject $projectmentorProjectProject
 * @property ProjectmentorProject $projectmentorProjectProjectMentorUser
 * @property PersonalMeeting[] $personalMeetings
 * @property ProjectMeeting[] $projectMeetings
 */
class Mentee extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mentee the static model class
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
		return 'mentee';
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
			array('user_id, projectmentor_project_project_mentor_user_id', 'length', 'max'=>11),
			array('projectmentor_project_project_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, projectmentor_project_project_id, projectmentor_project_project_mentor_user_id', 'safe', 'on'=>'search'),
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
			'projectmentorProjectProject' => array(self::BELONGS_TO, 'ProjectmentorProject', 'projectmentor_project_project_id'),
			'projectmentorProjectProjectMentorUser' => array(self::BELONGS_TO, 'ProjectmentorProject', 'projectmentor_project_project_mentor_user_id'),
			'personalMeetings' => array(self::HAS_MANY, 'PersonalMeeting', 'mentee_user_id'),
			'projectMeetings' => array(self::HAS_MANY, 'ProjectMeeting', 'mentee_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'projectmentor_project_project_id' => 'Projectmentor Project Project',
			'projectmentor_project_project_mentor_user_id' => 'Projectmentor Project Project Mentor User',
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
		$criteria->compare('projectmentor_project_project_id',$this->projectmentor_project_project_id,true);
		$criteria->compare('projectmentor_project_project_mentor_user_id',$this->projectmentor_project_project_mentor_user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}