<?php

/**
 * This is the model class for table "user_domain".
 *
 * The followings are the available columns in table 'user_domain':
 * @property string $id
 * @property string $user_id
 * @property string $domain_id
 * @property string $subdomain_id
 * @property integer $rate
 * @property integer $active
 * @property integer $tier_team
 *
 * The followings are the available model relations:
 * @property Domain $domain
 * @property User $user
 * @property Subdomain $subdomain
 */
class UserDomain extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserDomain the static model class
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
		return 'user_domain';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, domain_id', 'required'),
			array('rate, active, tier_team', 'numerical', 'integerOnly'=>true),
			array('user_id, domain_id, subdomain_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, domain_id, subdomain_id, rate, active, tier_team', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'subdomain' => array(self::BELONGS_TO, 'Subdomain', 'subdomain_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'domain_id' => 'Domain',
			'subdomain_id' => 'Subdomain',
			'rate' => 'Rate',
			'active' => 'Active',
			'tier_team' => 'Tier Team',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('domain_id',$this->domain_id,true);
		$criteria->compare('subdomain_id',$this->subdomain_id,true);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('active',$this->active);
		$criteria->compare('tier_team',$this->tier_team);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getSubdomain(){
		$subdomain = '';
		if (is_null($this->subdomain_id))
			return $subdomain;
		else return $this->subdomain->name;
	}
}