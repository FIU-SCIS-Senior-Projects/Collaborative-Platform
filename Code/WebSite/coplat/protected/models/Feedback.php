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
 * @property User $creatorUser
 *
 * The following are available model relations
 * @property Feedback_Replies[] $replies
 */
class Feedback extends CActiveRecord
{
	public $creatorName;
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
		return array(
			//array('user_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>255),
			array('description', 'length', 'max'=>5000),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, subject, description, creatorName', 'safe', 'on'=>'search'),
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

			'replies' => array(self::HAS_MANY, 'Feedback_Replies', 'feed_id'),
		);
	}

	public function gitData(){
		$data = Feedback::findAll();
		return $data;
	}

	public function gitReplies()
	{
		return $data = Feedback_Replies::model()->findAllbySQL("Select * from feedback_replies where feed_id = ". $this->id);
	}

	public function getCompiledCreatorID()
	{
		$user = User::getUser($this->user_id);
		return (/*$this->creator_user_id . ' ' .*/
			$user->fname .' ' .
			$user->lname);
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
		$criteria->with = array('creatorUser');

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('creatorUser.fname', $this->creatorName, true, 'OR');
		$criteria->compare('creatorUser.lname', $this->creatorName, true, 'OR');


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'creatorName'=>array(
						'asc'=>'creatorUser.lname',
						'desc'=>'creatorUser.lname DESC',
					),
					'*',
				),
			),
		));
	}
}