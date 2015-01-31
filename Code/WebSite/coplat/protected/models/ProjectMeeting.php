<?php

/**
 * This is the model class for table "project_meeting".
 *
 * The followings are the available columns in table 'project_meeting':
 * @property string $id
 * @property string $project_mentor_user_id
 * @property string $mentee_user_id
 * @property string $date
 * @property string $time
 *
 * The followings are the available model relations:
 * @property Mentee $menteeUser
 * @property ProjectMentor $projectMentorUser
 */
class ProjectMeeting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProjectMeeting the static model class
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
		return 'project_meeting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_mentor_user_id, mentee_user_id, date, time', 'required'),
			array('project_mentor_user_id, mentee_user_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, project_mentor_user_id, mentee_user_id, date, time', 'safe', 'on'=>'search'),
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
			'menteeUser' => array(self::BELONGS_TO, 'Mentee', 'mentee_user_id'),
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
			'project_mentor_user_id' => 'Project Mentor User',
			'mentee_user_id' => 'Mentee User',
			'date' => 'Date',
			'time' => 'Time',
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
		$criteria->compare('project_mentor_user_id',$this->project_mentor_user_id,true);
		$criteria->compare('mentee_user_id',$this->mentee_user_id,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}