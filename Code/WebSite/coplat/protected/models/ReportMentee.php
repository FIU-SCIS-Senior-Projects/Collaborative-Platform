<?php

/**
 * This is the model class for table "report_mentee".
 *
 * The followings are the available columns in table 'report_mentee':
 * @property string $UserID
 * @property string $UserName
 * @property string $Email
 * @property string $Name
 * @property integer $Disabled
 * @property string $UniversityID
 * @property string $UniversityName
 * @property string $PersonalMentorID
 * @property string $PersonalMentorEmail
 * @property string $PersonalMentorName
 * @property integer $PersonalMentorDisabled
 * @property string $menteeProjectID
 * @property string $menteeProjectTitle
 * @property string $menteeProjectStartDate
 * @property string $menteeProjectDueDate
 * @property string $menteeProjectCustomerName
 */
class ReportMentee extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReportMentee the static model class
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
		return 'report_mentee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserName, Email', 'required'),
			array('Disabled, PersonalMentorDisabled', 'numerical', 'integerOnly'=>true),
			array('UserID, UniversityID, PersonalMentorID, menteeProjectID', 'length', 'max'=>11),
			array('UserName, menteeProjectTitle', 'length', 'max'=>45),
			array('Email, PersonalMentorEmail', 'length', 'max'=>255),
			array('Name, PersonalMentorName', 'length', 'max'=>192),
			array('UniversityName', 'length', 'max'=>50),
			array('menteeProjectCustomerName', 'length', 'max'=>41),
			array('menteeProjectStartDate, menteeProjectDueDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('UserID, UserName, Email, Name, Disabled, UniversityID, UniversityName, PersonalMentorID, PersonalMentorEmail, PersonalMentorName, PersonalMentorDisabled, menteeProjectID, menteeProjectTitle, menteeProjectStartDate, menteeProjectDueDate, menteeProjectCustomerName', 'safe', 'on'=>'search'),
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
			'UserID' => 'User',
			'UserName' => 'User Name',
			'Email' => 'Email',
			'Name' => 'Name',
			'Disabled' => 'Disabled',
			'UniversityID' => 'University',
			'UniversityName' => 'University Name',
			'PersonalMentorID' => 'Personal Mentor',
			'PersonalMentorEmail' => 'Personal Mentor Email',
			'PersonalMentorName' => 'Personal Mentor Name',
			'PersonalMentorDisabled' => 'Personal Mentor Disabled',
			'menteeProjectID' => 'Mentee Project',
			'menteeProjectTitle' => 'Mentee Project Title',
			'menteeProjectStartDate' => 'Mentee Project Start Data',
			'menteeProjectDueDate' => 'Mentee Project Due Date',
			'menteeProjectCustomerName' => 'Mentee Project Customer Name',
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

		$criteria->compare('UserID',$this->UserID,false);
		$criteria->compare('UserName',$this->UserName,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Disabled',$this->Disabled);
		$criteria->compare('UniversityID',$this->UniversityID,false);
		$criteria->compare('UniversityName',$this->UniversityName,true);
		$criteria->compare('PersonalMentorID',$this->PersonalMentorID,false );
		$criteria->compare('PersonalMentorEmail',$this->PersonalMentorEmail,true);
		$criteria->compare('PersonalMentorName',$this->PersonalMentorName,true);
		$criteria->compare('PersonalMentorDisabled',$this->PersonalMentorDisabled);
		$criteria->compare('menteeProjectID',$this->menteeProjectID,false );
		$criteria->compare('menteeProjectTitle',$this->menteeProjectTitle,true);
		$criteria->compare('menteeProjectStartDate',$this->menteeProjectStartDate,true);
		$criteria->compare('menteeProjectDueDate',$this->menteeProjectDueDate,true);
		$criteria->compare('menteeProjectCustomerName',$this->menteeProjectCustomerName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}