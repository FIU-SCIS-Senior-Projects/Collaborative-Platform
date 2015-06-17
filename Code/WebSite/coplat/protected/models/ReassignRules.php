<?php

/**
 * This is the model class for table "reassign_rules".
 *
 * The followings are the available columns in table 'reassign_rules':
 * @property integer $rule_id
 * @property string $rule
 * @property integer $setting
 */
class ReassignRules extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReassignRules the static model class
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
		return 'reassign_rules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rule, setting', 'required'),
			array('setting', 'numerical', 'integerOnly'=>true),
			array('rule', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rule_id, rule, setting', 'safe', 'on'=>'search'),
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
			'rule_id' => 'Rule',
			'rule' => 'Rule',
			'setting' => 'Setting',
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

		$criteria->compare('rule_id',$this->rule_id);
		$criteria->compare('rule',$this->rule,true);
		$criteria->compare('setting',$this->setting);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}