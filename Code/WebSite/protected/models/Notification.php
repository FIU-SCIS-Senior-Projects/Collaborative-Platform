<?php

/**
 * This is the model class for table "notification".
 *
 * The followings are the available columns in table 'notification':
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $datetime
 * @property integer $been_read
 * @property string $message
 */
class Notification extends CActiveRecord
{
	public $keyid;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notification the static model class
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
		return 'notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, sender_id, receiver_id, datetime, been_read', 'required'),
			array('id, sender_id, receiver_id, been_read', 'numerical', 'integerOnly'=>true),
			array('message', 'length', 'max'=>5000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sender_id, receiver_id, datetime, been_read, message', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'sender_id' => 'Sender',
			'receiver_id' => 'Receiver',
			'datetime' => 'Datetime',
			'been_read' => 'Been Read',
			'message' => 'Message',
			'link' => 'Link',
			'importancy' => 'Importancy',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('receiver_id',$this->receiver_id);
		$criteria->compare('datetime',$this->datetime,true);
		$criteria->compare('been_read',$this->been_read);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function getNotificationId($id)
	{
		$no= Notification::model()->findAllByAttributes(array('receiver_id'=>$id), array("order"=>"id desc"));
		
		return $no;
	}	

	public static function markHasBeenRead($id)
	{
		$notification = Notification::model()->findByPk($id);
		$notification->been_read = 1;
		$notification->save(false);
	}
		
}