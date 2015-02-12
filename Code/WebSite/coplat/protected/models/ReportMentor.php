<?php

/**
 * This is the model class for table "report_mentor".
 *
 * The followings are the available columns in table 'report_mentor':
 * @property string $userID
 * @property string $userName
 * @property string $email
 * @property string $name
 * @property integer $disabled
 * @property integer $isProjectMentor
 * @property integer $isPersonalMentor
 * @property integer $isDomainMentor
 * @property integer $isJudge
 * @property integer $isNew
 * @property integer $isEmployer
 * @property string $employer
 * @property string $position
 * @property string $degree
 * @property string $fieldOfStudy
 * @property string $gradYear
 */
class ReportMentor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReportMentor the static model class
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
		return 'report_mentor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userName, email, isNew', 'required'),
			array('disabled, isProjectMentor, isPersonalMentor, isDomainMentor, isJudge, isNew, isEmployer', 'numerical', 'integerOnly'=>true),
			array('userID', 'length', 'max'=>11),
			array('userName', 'length', 'max'=>45),
			array('email', 'length', 'max'=>255),
			array('name', 'length', 'max'=>192),
			array('employer, position, degree, fieldOfStudy', 'length', 'max'=>50),
			array('gradYear', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userID, userName, email, name, disabled, isProjectMentor, isPersonalMentor, isDomainMentor, isJudge, isNew, isEmployer, employer, position, degree, fieldOfStudy, gradYear', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userID' => 'User',
			'userName' => 'User Name',
			'email' => 'Email',
			'name' => 'Name',
			'disabled' => 'Disabled',
			'isProjectMentor' => 'Is Project Mentor',
			'isPersonalMentor' => 'Is Personal Mentor',
			'isDomainMentor' => 'Is Domain Mentor',
			'isJudge' => 'Is Judge',
			'isNew' => 'Is New',
			'isEmployer' => 'Is Employer',
			'employer' => 'Employer',
			'position' => 'Position',
			'degree' => 'Degree',
			'fieldOfStudy' => 'Field Of Study',
			'gradYear' => 'Grad Year',
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

		$criteria->compare('userID',$this->userID,false );
		$criteria->compare('userName',$this->userName,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('disabled',$this->disabled);
		$criteria->compare('isProjectMentor',$this->isProjectMentor);
		$criteria->compare('isPersonalMentor',$this->isPersonalMentor);
		$criteria->compare('isDomainMentor',$this->isDomainMentor);
		$criteria->compare('isJudge',$this->isJudge);
		$criteria->compare('isNew',$this->isNew);
		$criteria->compare('isEmployer',$this->isEmployer);
		$criteria->compare('employer',$this->employer,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('degree',$this->degree,true);
		$criteria->compare('fieldOfStudy',$this->fieldOfStudy,true);
		$criteria->compare('gradYear',$this->gradYear,false );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}