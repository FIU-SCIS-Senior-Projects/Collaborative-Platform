<?php

/**
 * This is the model class for table "subdomain".
 *
 * The followings are the available columns in table 'subdomain':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property integer $validator
 * @property string $domain_id
 *
 * The followings are the available model relations:
 * @property Domain $domain
 * @property Ticket[] $tickets
 * @property UserDomain[] $userDomains
 */
class Subdomain extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Subdomain the static model class
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
		return 'subdomain';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domain_id, name', 'required'),
			array('validator', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('description', 'length', 'max'=>5000),
			array('domain_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, validator, domain_id', 'safe', 'on'=>'search'),
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
			'domain' => array(self::BELONGS_TO, 'Domain', 'domain_id'),
			'tickets' => array(self::HAS_MANY, 'Ticket', 'subdomain_id'),
			'userDomains' => array(self::HAS_MANY, 'UserDomain', 'subdomain_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Sub-Domain',
			'description' => 'Description',
			'validator' => 'Proficiency Cutoff',
			'domain_id' => 'Domain',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('validator',$this->validator);
		$criteria->compare('domain_id',$this->domain_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}