<?php

/**
 * This is the model class for table "application_personal_mentor_pick".
 *
 * The followings are the available columns in table 'application_personal_mentor_pick':
 * @property string $id
 * @property string $app_id
 * @property string $user_id
 * @property string $approval_status
 *
 * The followings are the available model relations:
 * @property ApplicationPersonalMentor $app
 * @property User $user
 */
class ApplicationPersonalMentorPick extends CActiveRecord
{
	public $approval_status2;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicationPersonalMentorPick the static model class
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
		return 'application_personal_mentor_pick';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, user_id, approval_status', 'required'),
			array('app_id, user_id', 'length', 'max'=>11),
			array('approval_status', 'length', 'max'=>18),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, app_id, user_id, approval_status', 'safe', 'on'=>'search'),
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
			'app' => array(self::BELONGS_TO, 'ApplicationPersonalMentor', 'app_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'app_id' => 'App',
			'user_id' => 'User',
			'approval_status' => 'Approval Status',
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
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('approval_status',$this->approval_status,true);		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}