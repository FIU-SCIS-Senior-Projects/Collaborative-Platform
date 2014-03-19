<?php

/**
 * This is the model class for table "ticket".
 *
 * The followings are the available columns in table 'ticket':
 * @property string $id
 * @property string $creator_user_id
 * @property string $topic_id
 * @property string $status
 * @property string $created_date
 * @property string $last_updated
 * @property string $subject
 * @property string $description
 * @property string $answer
 * @property string $assign_user_id
 *
 * The followings are the available model relations:
 * @property Attachment[] $attachments
 * @property Comment[] $comments
 * @property User $assignUser
 * @property User $creatorUser
 * @property Topic $topic
 */
class Ticke extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ticke the static model class
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
			array('id, creator_user_id, topic_id, status, created_date, subject, description', 'required'),
			array('id, creator_user_id, topic_id, assign_user_id', 'length', 'max'=>11),
			array('status, subject', 'length', 'max'=>45),
			array('description, answer', 'length', 'max'=>500),
			array('last_updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, creator_user_id, topic_id, status, created_date, last_updated, subject, description, answer, assign_user_id', 'safe', 'on'=>'search'),
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
			'assignUser' => array(self::BELONGS_TO, 'User', 'assign_user_id'),
			'creatorUser' => array(self::BELONGS_TO, 'User', 'creator_user_id'),
			'topic' => array(self::BELONGS_TO, 'Topic', 'topic_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'creator_user_id' => 'Creator User',
			'topic_id' => 'Topic',
			'status' => 'Status',
			'created_date' => 'Created Date',
			'last_updated' => 'Last Updated',
			'subject' => 'Subject',
			'description' => 'Description',
			'answer' => 'Answer',
			'assign_user_id' => 'Assign User',
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
		$criteria->compare('creator_user_id',$this->creator_user_id,true);
		$criteria->compare('topic_id',$this->topic_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('last_updated',$this->last_updated,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('assign_user_id',$this->assign_user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}