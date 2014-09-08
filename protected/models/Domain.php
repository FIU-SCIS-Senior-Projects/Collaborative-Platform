<?php

/**
 * This is the model class for table "domain".
 *
 * The followings are the available columns in table 'domain':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property integer $validator
 *
 * The followings are the available model relations:
 * @property Subdomain[] $subdomains
 * @property Ticket[] $tickets
 * @property UserDomain[] $userDomains
 */
class Domain extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Domain the static model class
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
		return 'domain';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('validator', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('description', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, validator', 'safe', 'on'=>'search'),
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
			'subdomains' => array(self::HAS_MANY, 'Subdomain', 'domain_id'),
			'tickets' => array(self::HAS_MANY, 'Ticket', 'domain_id'),
			'userDomains' => array(self::HAS_MANY, 'UserDomain', 'domain_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Domain',
			'description' => 'Description',
			'validator' => 'Validator',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function domainExists($domain)
        {
            $d = Domain::model()->findAllBySql("SELECT name FROM domain WHERE name='$domain'");
            
            return $d;
            /*
            for($i = 0; $i < count($d); $i++)
            {
                if(strcasecmp($domain, $d[$i]->name))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }*/
        }
}