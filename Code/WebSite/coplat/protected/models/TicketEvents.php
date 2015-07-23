<?php

/**
 * This is the model class for table "ticket_events".
 *
 * The followings are the available columns in table 'ticket_events':
 * @property integer $id
 * @property integer $event_type_id
 * @property string $ticket_id
 * @property string $event_recorded_date
 * @property string $old_value
 * @property string $new_value //in the case of comment, it will hold the comment id
 * @property string $comment
 * @property string $event_performed_by_user_id
 *
 * The followings are the available model relations:
 * @property EventType $eventType
 * @property User $eventPerformedByUser
 * @property Ticket $ticket
 */
class TicketEvents extends CActiveRecord
{
    
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TicketEvents the static model class
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
		return 'ticket_events';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_type_id, ticket_id, event_recorded_date', 'required'),
			array('event_type_id', 'numerical', 'integerOnly'=>true),
			array('ticket_id', 'length', 'max'=>10),
			array('old_value, new_value', 'length', 'max'=>200),
			array('comment', 'length', 'max'=>500),
			array('event_performed_by_user_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_type_id, ticket_id, event_recorded_date, old_value, new_value, comment, event_performed_by_user_id', 'safe', 'on'=>'search'),
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
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'eventPerformedByUser' => array(self::BELONGS_TO, 'User', 'event_performed_by_user_id'),
			'ticket' => array(self::BELONGS_TO, 'Ticket', 'ticket_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_type_id' => 'Event Type',
			'ticket_id' => 'Ticket',
			'event_recorded_date' => 'Event Recorded Date',
			'old_value' => 'Old Value',
			'new_value' => 'New Value',
			'comment' => 'Comment',
			'event_performed_by_user_id' => 'Event Performed By User',
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
		$criteria->compare('event_type_id',$this->event_type_id);
		$criteria->compare('ticket_id',$this->ticket_id,true);
		$criteria->compare('event_recorded_date',$this->event_recorded_date,true);
		$criteria->compare('old_value',$this->old_value,true);
		$criteria->compare('new_value',$this->new_value,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('event_performed_by_user_id',$this->event_performed_by_user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        ///this function is user to record ticket events
        public static function recordEvent($event_type_id,
                                           $ticket_id,
                                           $old_value,
                                           $new_value, 
                                           $comment)
        {
            $resEvent = NULL;
            $newEvent = new TicketEvents();
            
            //Some validation first
            if (!isset($event_type_id))
            {
                throw new CException("Event Type required when loggin ticket events.");
            }
                        
            if (!isset($ticket_id))
            {
                throw new CException("Ticket ID required when loggin ticket events.");
            }            
            
            //Collect and prepare the data
            $newEvent->event_type_id = $event_type_id;
            $newEvent->ticket_id = $ticket_id;
            $newEvent->event_recorded_date = new CDbExpression('NOW()');
            $newEvent->old_value = $old_value;
            $newEvent->new_value = $new_value;
            $newEvent->comment = $comment;
            $newEvent->event_performed_by_user_id = User::getCurrentUserId();
            
            //if save susscessfully, just return the new event
            if ($newEvent->save())
            {
                $resEvent = $newEvent;
            } 
            return $resEvent;
        }
        
        public function getEventDescription()
        {
            $description =  '';
            
            switch ($this->event_type_id)
            {
                case EventType::Event_New:
                    $description = 'Ticket created.';
                    break;
                
                case EventType::Event_Status_Changed:
                    $description = 'Status changed from '. $this->old_value.' to '.$this->new_value;
                    break;
                
                case EventType::Event_AssignedOrReasignedToUser:
                    
                    $oldUser = User::model()->findByPk($this->old_value);
                    $oldUserName = '';
                    if (isset($oldUser))
                    {
                         $oldUserName = $oldUser->getFullName();
                    }                      
                    
                    $newUser = User::model()->findByPk($this->new_value);
                    $newUserName = '';
                    if (isset($newUser))
                    {
                        $newUserName = $newUser->getFullName();
                    }
                        
                    $description = 'Reasigned from user: '.$oldUserName.' to user: '.$newUserName ;
                    break;
                
                case EventType::Event_Commented_By_Owner:
                    $description = 'Commented by owner. Comment #'.$this->new_value.'.';
                    break;
                    
                case EventType::Event_Commented_By_Mentor:
                    $description = 'Commented by mentor. Comment #'.$this->new_value.'.';
                    break;
                    
                case EventType::Event_Escalated_To:
                    $description = 'Escalated to ticket #'.$this->new_value.'.';
                    break;
                    
                case EventType::Event_Escalated_From:
                    $description = 'Escalated from ticket #'.$this->old_value.'.';
                    break;
                
                case EventType::Event_Opened_By_Owner:
                    $description = 'Viewed by Owner';
                    break;
                
                case EventType::Event_Opened_By_Mentor:
                    $description = 'Viewed by Mentor';
                    break;

                case EventType::Event_Ticket_Reassigned:
                    $description ='Reassigned to a new Mentor';
                    break;
                
            }
                           
            return $description;
        }
        
        
}