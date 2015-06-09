<?php

/**
 * This is the model class for table "event_type".
 *
 * The followings are the available columns in table 'event_type':
 * @property integer $id
 * @property string $description
 */
class EventType extends CActiveRecord
{
       const Event_New = 1; //this event does not record old or new values... this event only records when it was created and by whom
       const Event_Commented_By_Mentor = 5; //when commented by mentor, the ticket event should record in the new value, the comment ID for further reference
       const Event_Commented_By_Owner = 4;  //when commented by Owner, the ticket event should record in the new value, the comment ID for further reference
       const Event_Status_Changed = 2;      //when the status changes... it should be recorded the old value and the new value
       const Event_AssignedOrReasignedToUser = 3; //when the ticket is reasigned we just record the old mentor in the old value and the new mentor in the new value
       const Event_Escalated_To = 6; //when the event is escalated, to another ticket
       const Event_Escalated_From = 7; //when the event is escalated from another tikcet
       const Event_Opened_By_Owner = 8; //registers if the ticket was opened by the creator
       const Event_Opened_By_Mentor = 9; //registers if the ticket was opned by the mentor
       const Event_Meeting_Scheduled = 10;
       
       /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EventType the static model class
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
		return 'event_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description', 'required'),
			array('description', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, description', 'safe', 'on'=>'search'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}