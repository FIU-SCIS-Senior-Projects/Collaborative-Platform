<?php

/**
 * This is the model class for table "domain_combined".
 *
 * The followings are the available columns in table 'domain_combined':
 * @property string $id
 * @property string $domain_name
 * @property string $subdomain_name
 * @property string $description
 * @property integer $validator
 * @property string $need
 * @property integer $need_amount
 */
class DomainCombined extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DomainCombined the static model class
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
		return 'domain_combined';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('validator, need_amount', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>11),
			array('domain_name, subdomain_name', 'length', 'max'=>45),
			array('need', 'length', 'max'=>7),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, domain_name, subdomain_name, description, validator, need, need_amount', 'safe', 'on'=>'search'),
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
			'domain_name' => 'Domain Name',
			'subdomain_name' => 'Subdomain Name',
			'description' => 'Description',
			'validator' => 'Validator',
			'need' => 'Need',
			'need_amount' => 'Need Amount',
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
		$criteria->compare('domain_name',$this->domain_name,true);
		$criteria->compare('subdomain_name',$this->subdomain_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('validator',$this->validator);
		$criteria->compare('need',$this->need,true);
		$criteria->compare('need_amount',$this->need_amount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}