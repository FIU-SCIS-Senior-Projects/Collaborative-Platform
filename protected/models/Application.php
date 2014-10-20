<?php

/**
 * This is the model class for table "application".
 *
 * The followings are the available columns in table 'application':
 * @property string $id
 * @property string $user_id
 * @property string $type
 * @property string $status
 * @property string $date
 * @property string $max_amount
 * @property string $max_hours
 * @property string $system_pick_amount
 *
 * The followings are the available model relations:
 * @property ApplicationDomain $applicationDomain
 * @property ApplicationPicks $applicationPicks
 */
class Application extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Application the static model class
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
		return 'application';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, type, status, date, max_amount', 'required'),
			array('user_id', 'length', 'max'=>3),
			array('type, status', 'length', 'max'=>1),
			array('max_amount, max_hours, system_pick_amount', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, type, status, date, max_amount, max_hours', 'safe', 'on'=>'search'),
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
			'applicationDomain' => array(self::HAS_ONE, 'ApplicationDomain', 'application_id'),
			'applicationPicks' => array(self::HAS_MANY, 'ApplicationPicks', 'application_id'),
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
			'type' => 'Type',
			'status' => 'Status',
			'date' => 'Date',
			'max_amount' => 'Max Amount',
			'max_hours' => 'Max Hours',
			'system_pick_amount' => 'System Picks',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('max_amount',$this->max_amount,true);
		$criteria->compare('max_hours',$this->max_hours,true);
		$criteria->compare('system_pick_amount',$this->system_pick_amount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}