<?php

/**
 * This is the model class for table "ticket".
 *
 * The followings are the available columns in table 'ticket':
 * @property string $id
 * @property integer $topic_id
 * @property string $status
 * @property string $created_date
 * @property string $last_updated
 * @property string $subject
 * @property string $description
 * @property integer $assign_id
 * @property string $answer
 * @property string $user_role_user_id
 * @property string $user_role_role_id
 *
 * The followings are the available model relations:
 * @property Attachment[] $attachments
 * @property Comment[] $comments
 * @property UserRole $userRoleUser
 * @property UserRole $userRoleRole
 */
class Ticket extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ticket the static model class
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
		return 'ticket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('topic_id, status, created_date, subject, description, user_role_user_id, user_role_role_id', 'required'),
			array('topic_id, assign_id', 'numerical', 'integerOnly'=>true),
			array('status, subject', 'length', 'max'=>45),
			array('description, answer', 'length', 'max'=>500),
			array('user_role_user_id, user_role_role_id', 'length', 'max'=>11),
			array('last_updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, topic_id, status, created_date, last_updated, subject, description, assign_id, answer, user_role_user_id, user_role_role_id', 'safe', 'on'=>'search'),
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
			'attachments' => array(self::HAS_MANY, 'Attachment', 'ticket_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'ticket_id'),
			'userRoleUser' => array(self::BELONGS_TO, 'UserRole', 'user_role_user_id'),
			'userRoleRole' => array(self::BELONGS_TO, 'UserRole', 'user_role_role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'topic_id' => 'Topic',
			'status' => 'Status',
			'created_date' => 'Created Date',
			'last_updated' => 'Last Updated',
			'subject' => 'Subject',
			'description' => 'Description',
			'assign_id' => 'Assign',
			'answer' => 'Answer',
			'user_role_user_id' => 'User Role User',
			'user_role_role_id' => 'User Role Role',
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
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('last_updated',$this->last_updated,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('assign_id',$this->assign_id);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('user_role_user_id',$this->user_role_user_id,true);
		$criteria->compare('user_role_role_id',$this->user_role_role_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}