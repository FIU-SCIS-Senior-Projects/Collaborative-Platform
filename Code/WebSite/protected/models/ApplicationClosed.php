<?php

/**
 * This is the model class for table "application_closed".
 *
 * The followings are the available columns in table 'application_closed':
 * @property string $app_domain_mentor_id
 * @property string $app_personal_mentor_id
 * @property string $app_project_mentor_id
 * @property string $date
 * @property string $id
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property ApplicationDomainMentor $appDomainMentor
 * @property ApplicationPersonalMentor $appPersonalMentor
 * @property ApplicationProjectMentor $appProjectMentor
 * @property User $user
 */
class ApplicationClosed extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicationClosed the static model class
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
		return 'application_closed';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, user_id', 'required'),
			array('app_domain_mentor_id, app_personal_mentor_id, app_project_mentor_id, user_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('app_domain_mentor_id, app_personal_mentor_id, app_project_mentor_id, date, id, user_id', 'safe', 'on'=>'search'),
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
			'appDomainMentor' => array(self::BELONGS_TO, 'ApplicationDomainMentor', 'app_domain_mentor_id'),
			'appPersonalMentor' => array(self::BELONGS_TO, 'ApplicationPersonalMentor', 'app_personal_mentor_id'),
			'appProjectMentor' => array(self::BELONGS_TO, 'ApplicationProjectMentor', 'app_project_mentor_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'app_domain_mentor_id' => 'App Domain Mentor',
			'app_personal_mentor_id' => 'App Personal Mentor',
			'app_project_mentor_id' => 'App Project Mentor',
			'date' => 'Date',
			'id' => 'ID',
			'user_id' => 'User',
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

		$criteria->compare('app_domain_mentor_id',$this->app_domain_mentor_id,true);
		$criteria->compare('app_personal_mentor_id',$this->app_personal_mentor_id,true);
		$criteria->compare('app_project_mentor_id',$this->app_project_mentor_id,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}