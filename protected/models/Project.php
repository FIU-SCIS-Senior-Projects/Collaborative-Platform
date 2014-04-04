<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $start_date
 * @property string $due_date
 * @property integer $mentor_id
 *
 * The followings are the available model relations:
 * @property ProjectmentorProject[] $projectmentorProjects
 */
class Project extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Project the static model class
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
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('mentor_id', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>11),
			array('title, description', 'length', 'max'=>45),
			array('start_date, due_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, start_date, due_date, mentor_id', 'safe', 'on'=>'search'),
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
			'projectmentorProjects' => array(self::HAS_MANY, 'ProjectmentorProject', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'start_date' => 'Start Date',
			'due_date' => 'Due Date',
			'mentor_id' => 'Mentor',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('mentor_id',$this->mentor_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}