<?php
//require_once(__DIR__ . '/../phpunit.phar');
require_once(__DIR__.'/../../framework/yii.php');

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property string $id
 * @property integer $user_id
 * @property string $subject
 * @property string $description
 *
 * The following are available model relations
 * @property feedbackReplies[] $replies
 */
class Feedback extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Feedback the static model class
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
		return 'feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('user_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>255),
			array('description', 'length', 'max'=>5000),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, subject, description', 'safe', 'on'=>'search'),
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
			'creatorUser' => array(self::BELONGS_TO, 'User', 'user_id'),
			'replies' => array(self::HAS_MANY, 'feedbackreplies', 'feed_id'),
		);
	}

	public function gitData(){
		/*$data = Yii::app()->db
			->createCommand($sql)
			->queryAll();*/
		//if(!User::isCurrentUserAnAdmin()) {
			//$data = Feedback::findAll('user_id=' . User::getCurrentUserId());
		//}
		//else{
			$data = Feedback::findAll();
		//}
		return $data;
	}

	public function gitReplies()
	{
		return $data = FeedbackReplies::model()->findAllbySQL("Select * from feedback_replies where feed_id = ". $this->id);
	}



	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'creatorUser',
			'subject' => 'Subject',
			'description' => 'Description',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'name_search'=>array(
						'asc'=>'creatorUser.lname',
						'desc'=>'creatorUser.lname DESC',
					),
					'*',
				),
			),
		));
	}
}