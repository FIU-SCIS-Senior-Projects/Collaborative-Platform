<?php

/**
 * This is the model class for table "domain_suggestion".
 *
 * The followings are the available columns in table 'domain_suggestion':
 * @property string $suggestion_id
 * @property string $name
 * @property string $description
 * @property string $status
 * @property string $creator_user_id
 *
 * The followings are the available model relations:
 * @property User $creatorUser
 */
class DomainSuggestion extends CActiveRecord
{
    public $Domain;
    public $name_search;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DomainSuggestion the static model class
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
		return 'domain_suggestion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, creator_user_id', 'required'),
			array('name', 'length', 'max'=>255),
			array('description', 'length', 'max'=>5000),
			array('status', 'length', 'max'=>10),
			array('creator_user_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('suggestion_id, name, description, status, creator_user_id, name_search', 'safe', 'on'=>'search'),
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
			'creatorUser' => array(self::BELONGS_TO, 'User', 'creator_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'suggestion_id' => 'Suggestion',
			'name' => 'Domain Name',
			'description' => 'Description',
			'status' => 'Status',
			'creator_user_id' => 'Creator User',
            'name_search' => 'Creator\'s Name',
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
        $criteria->with = array( 'creatorUser');
        $criteria->compare('creatorUser.fname', $this->name_search, true, 'OR');
        $criteria->compare('creatorUser.lname', $this->name_search, true, 'OR');
        $criteria->compare('suggestion_id',$this->suggestion_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status,true);

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