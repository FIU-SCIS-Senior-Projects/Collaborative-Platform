<?php

/**
 * This is the model class for table "invitation".
 *
 * The followings are the available columns in table 'invitation':
 * @property string $id
 * @property string $email
 * @property string $administrator_user_id
 * @property string $date
 * @property integer $administrator
 * @property integer $personal_mentor
 * @property integer $project_mentor
 * @property integer $domain_mentor
 * @property integer $mentee
 * @property integer $employer
 * @property integer $judge
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Administrator $administratorUser
 * @property InvitationResends[] $invitationResends
 */
class Invitation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invitation the static model class
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
		return 'invitation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, administrator_user_id, personal_mentor, project_mentor, domain_mentor, name', 'required'),
			array('administrator, personal_mentor, project_mentor, domain_mentor, mentee, employer, judge', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>100),
			array('administrator_user_id', 'length', 'max'=>11),
			array('name', 'length', 'max'=>20),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, administrator_user_id, date, administrator, personal_mentor, project_mentor, domain_mentor, mentee, employer, judge, name', 'safe', 'on'=>'search'),
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
			'administratorUser' => array(self::BELONGS_TO, 'Administrator', 'administrator_user_id'),
			'invitationResends' => array(self::HAS_MANY, 'InvitationResends', 'invitation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'administrator_user_id' => 'Administrator User',
			'date' => 'Date',
			'administrator' => 'Administrator',
			'personal_mentor' => 'Personal Mentor',
			'project_mentor' => 'Project Mentor',
			'domain_mentor' => 'Domain Mentor',
			'mentee' => 'Mentee',
			'employer' => 'Employer',
			'judge' => 'Judge',
			'name' => 'Name',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('administrator_user_id',$this->administrator_user_id,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('administrator',$this->administrator);
		$criteria->compare('personal_mentor',$this->personal_mentor);
		$criteria->compare('project_mentor',$this->project_mentor);
		$criteria->compare('domain_mentor',$this->domain_mentor);
		$criteria->compare('mentee',$this->mentee);
		$criteria->compare('employer',$this->employer);
		$criteria->compare('judge',$this->judge);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}