<?php

/**
 * This is the model class for table "application_personal_mentor".
 *
 * The followings are the available columns in table 'application_personal_mentor':
 * @property string $id
 * @property string $user_id
 * @property string $status
 * @property string $date_created
 * @property string $max_amount
 * @property string $max_hours
 * @property string $system_pick_amount
 * @property string $university_id
 *
 * The followings are the available model relations:
 * @property ApplicationClosed[] $applicationCloseds
 * @property User $user
 * @property University $university
 * @property ApplicationPersonalMentorPick[] $applicationPersonalMentorPicks
 */
class ApplicationPersonalMentor extends CActiveRecord
{
	public $tempPicks;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicationPersonalMentor the static model class
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
		return 'application_personal_mentor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, status, max_amount, max_hours', 'required'),
			array('university_id', 'numerical', 'integerOnly'=>true),
			array('user_id, university_id', 'length', 'max'=>11),
			array('status', 'length', 'max'=>6),
			array('max_amount, max_hours', 'length', 'max'=>2),
			array('system_pick_amount', 'length', 'max'=>1),
			array('date_created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, status, date_created, max_amount, max_hours, system_pick_amount, university_id', 'safe', 'on'=>'search'),
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
			'applicationCloseds' => array(self::HAS_MANY, 'ApplicationClosed', 'app_personal_mentor_id'),	
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'university' => array(self::BELONGS_TO, 'University', 'university_id'),
			'applicationPersonalMentorPicks' => array(self::HAS_MANY, 'ApplicationPersonalMentorPick', 'app_id'),
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
			'status' => 'Status',
			'date_created' => 'Date Created',
			'max_amount' => 'Max Amount',
			'max_hours' => 'Max Hours',
			'system_pick_amount' => 'How many students?',
			'university_id' => 'Preferred University',
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
		$criteria->compare('status',$this->status,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('max_amount',$this->max_amount,true);
		$criteria->compare('max_hours',$this->max_hours,true);
		$criteria->compare('system_pick_amount',$this->system_pick_amount,true);
		$criteria->compare('university_id',$this->university_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}