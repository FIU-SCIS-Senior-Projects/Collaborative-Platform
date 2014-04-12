<?php

/**
 * This is the model class for table "ticket".
 *
 * The followings are the available columns in table 'ticket':
 * @property string $id
 * @property string $creator_user_id
 * @property string $status
 * @property string $created_date
 * @property string $subject
 * @property string $description
 * @property string $assign_user_id
 * @property string $domain_id
 * @property string $subdomain_id
 * @property string $file
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property Domain $domain
 * @property Subdomain $subdomain
 * @property User $assignUser
 * @property User $creatorUser
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
			array('creator_user_id, status, created_date, subject, description, domain_id', 'required'),
			array('creator_user_id, assign_user_id, domain_id, subdomain_id', 'length', 'max'=>11),
			array('status, subject', 'length', 'max'=>45),
			array('description', 'length', 'max'=>500),
			array('file', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, creator_user_id, status, created_date, subject, description, assign_user_id, domain_id, subdomain_id, file', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'ticket_id'),
			'domain' => array(self::BELONGS_TO, 'Domain', 'domain_id'),
			'subdomain' => array(self::BELONGS_TO, 'Subdomain', 'subdomain_id'),
			'assignUser' => array(self::BELONGS_TO, 'User', 'assign_user_id'),
			'creatorUser' => array(self::BELONGS_TO, 'User', 'creator_user_id'),
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
			'status' => 'Status',
			'created_date' => 'Created Date',
			'subject' => 'Subject',
			'description' => 'Description',
			'assign_user_id' => 'Assign User',
			'domain_id' => 'Domain',
			'subdomain_id' => 'Subdomain',
			'file' => 'File',
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
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('assign_user_id',$this->assign_user_id,true);
		$criteria->compare('domain_id',$this->domain_id,true);
		$criteria->compare('subdomain_id',$this->subdomain_id,true);
		$criteria->compare('file',$this->file,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}