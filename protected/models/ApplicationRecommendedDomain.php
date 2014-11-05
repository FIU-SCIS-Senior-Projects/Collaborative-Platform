<?php

/**
 * This is the model class for table "application_recommended_domain".
 *
 * The followings are the available columns in table 'application_recommended_domain':
 * @property string $id
 * @property string $appId
 * @property string $domain
 * @property string $subdomain
 * @property string $description
 * @property string $proficiency
 *
 * The followings are the available model relations:
 * @property ApplicationDomainMentor $app
 */
class ApplicationRecommendedDomain extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApplicationRecommendedDomain the static model class
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
		return 'application_recommended_domain';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('appId, domain, proficiency', 'required'),
			array('appId', 'length', 'max'=>3),
			array('domain, subdomain', 'length', 'max'=>20),
			array('description', 'length', 'max'=>500),
			array('proficiency', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, appId, domain, subdomain, description, proficiency', 'safe', 'on'=>'search'),
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
			'app' => array(self::BELONGS_TO, 'ApplicationDomainMentor', 'appId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'appId' => 'App',
			'domain' => 'Domain',
			'subdomain' => 'Subdomain',
			'description' => 'Description',
			'proficiency' => 'Proficiency',
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
		$criteria->compare('appId',$this->appId,true);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('subdomain',$this->subdomain,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('proficiency',$this->proficiency,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}