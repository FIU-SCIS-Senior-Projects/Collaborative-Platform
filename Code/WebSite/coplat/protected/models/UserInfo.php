<?php

/**
 * This is the model class for table "user_info".
 *
 * The followings are the available columns in table 'user_info':
 * @property string $user_id
 * @property string $employer
 * @property string $position
 * @property string $job_start
 * @property string $degree
 * @property string $field_of_study
 * @property string $university
 * @property string $grad_year
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserInfo the static model class
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
		return 'user_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, employer, position, job_start, degree, field_of_study, university, grad_year', 'required'),
			array('user_id', 'length', 'max'=>10),
			array('job_start, grad_year', 'length', 'max'=>4),
			array('job_start, grad_year', 'numerical', 'integerOnly' => true),
			array('employer, position, degree, field_of_study, university', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, employer, position, job_start, degree, field_of_study, university, grad_year', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'employer' => 'Current Employer',
			'position' => 'Position',
			'job_start' => 'Start Year',
			'degree' => 'Degree',
			'field_of_study' => 'Field Of Study',
			'university' => 'University',
			'grad_year' => 'Graduation Year',
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
		$criteria->compare('employer',$this->employer,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('job_start',$this->job_start,true);
		$criteria->compare('degree',$this->degree,true);
		$criteria->compare('field_of_study',$this->field_of_study,true);
		$criteria->compare('university',$this->university,true);
		$criteria->compare('grad_year',$this->grad_year,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}