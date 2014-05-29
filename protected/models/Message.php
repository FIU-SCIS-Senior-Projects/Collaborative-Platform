<?php

/**
 * This is the model class for table "email".
 *
 * The followings are the available columns in table 'email':
 * @property integer $id
 * @property string $receiver
 * @property string $sender
 * @property string $subject
 * @property string $message
 * @property string $created_date
 * @property string $userImage
 * @property integer $been_read
 * @property integer $been_deleted
 *
 * The followings are the available model relations:
 * @property User $receiver0
 * @property User $sender0
 */
class Message extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Email the static model class
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
		return 'message';
	}
	
	public static function getTrashEmails($user)
	{
		$deleted = array();
		foreach ($user->messages as $message)
			if ($message->been_deleted)
			   $deleted[] = $message;
		
		return $deleted;
	}
	
	/**
	 * Returns the JavaScript needed for performing client-side validation.
	 * @param CModel $object the data object being validated
	 * @param string $attribute the name of the attribute to be validated.
	 * @return string the client-side validation script.
	 */
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('receiver', 'required'),
			array('receiver, sender', 'length', 'max'=>45),
			array('message, created_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, receiver, sender, subject, message, created_date, been_read, been_deleted', 'safe', 'on'=>'search'),
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
			'receiver0' => array(self::BELONGS_TO, 'User', 'receiver'),
			'sender0' => array(self::BELONGS_TO, 'User', 'sender'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'receiver' => 'To',
			'sender' => 'Sender',
			'subject' => 'Subject',
			'message' => 'Body',
			'created_date' => 'Date',
			'been_read' => 'Been Read',
			'been_deleted' => 'Been Deleted',
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
		$criteria->compare('receiver',$this->receiver,true);
		$criteria->compare('sender',$this->sender,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('subject', $this->subject, true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('been_read',$this->been_read);
		$criteria->compare('been_deleted',$this->been_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}