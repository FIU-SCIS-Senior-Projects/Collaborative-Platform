<?php

/**
 * This is the model class for table "ticket".
 *
 * The followings are the available columns in table 'ticket':
 * @property string $id
 * @property string $creator_user_id
 * @property string $status
 * @property string $created_date
 * @property string $subject
 * @property string $description
 * @property string $assign_user_id
 * @property string $domain_id
 * @property string $subdomain_id
 * @property string $file
 * @property integer $priority_id
 * @property string $assigned_date
 * @property string $closed_date
 * @property integer $isEscalated
 * @property integer $Mentor1
 * @property integer $Mentor2
 * @property integer $assigned_project_id
 * 
 *
 * The followings are the available model relations:
 * @property Comment[] $comments
 * @property User $creatorUser
 * @property User $assignUser
 * @property Domain $domain
 * @property Subdomain $subdomain
 * @property Priority $priority
 * @property TicketEvents[] $ticketEvents
 */
class Ticket extends CActiveRecord
{
    
    const Status_Close = 'Close';
    const Status_Reject ='Reject';
    const Status_Pending = 'Pending';

    public $creatorName;
    public $assignedName;
    public $domainName;
    public $subDomainName;
    public $createdDateToString;
    public $assignedDateToString;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ticket the static model class
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
		return 'ticket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() 
    { 
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
        return array( 
            array('creator_user_id, status, created_date, subject, description, domain_id, priority_id', 'required'),
            array('priority_id, isEscalated, Mentor1, Mentor2, assigned_project_id', 'numerical', 'integerOnly'=>true),
            array('creator_user_id, assign_user_id, domain_id, subdomain_id', 'length', 'max'=>11),
            array('status, subject', 'length', 'max'=>45),
            array('description', 'length', 'max'=>500),
            array('file', 'length', 'max'=>255),
            array('assigned_date, closed_date', 'safe'),
            // The following rule is used by search(). 
            // Please remove those attributes that should not be searched. 
            array('id, creator_user_id, status, created_date, subject, description, assign_user_id, domain_id, subdomain_id, file, priority_id, assigned_date, closed_date, isEscalated, Mentor1, Mentor2, creatorName, assignedName, domainName, subDomainName, assigned_project_id', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'ticket_id', 'order'=>'added_date DESC'),
			'creatorUser' => array(self::BELONGS_TO, 'User', 'creator_user_id'),
			'assignUser' => array(self::BELONGS_TO, 'User', 'assign_user_id'),
			'domain' => array(self::BELONGS_TO, 'Domain', 'domain_id'),
			'subdomain' => array(self::BELONGS_TO, 'Subdomain', 'subdomain_id'),
			'priority' => array(self::BELONGS_TO, 'Priority', 'priority_id'),
                        'ticketEvents' => array(self::HAS_MANY, 'TicketEvents', 'ticket_id', 'order'=>'event_recorded_date DESC')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'creator_user_id' => 'Creator User',
			'status' => 'Status',
			'created_date' => 'Created Date',
			'subject' => 'Subject',
			'description' => 'Description',
			'assign_user_id' => 'Assigned User',
			'domain_id' => 'Domain',
			'subdomain_id' => 'Subdomain',
			'file' => 'File',
			'priority_id' => 'Priority',
			'assigned_date' => 'Assigned Date',
			'closed_date' => 'Closed Date',	
			'isEscalated' => 'Is Escalated',
			'Mentor1' => 'Mentor1',
			'Mentor2' => 'Mentor2',
                        'assigned_project_id' => 'Assigned to project'
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
		
		$criteria->with = array( 'creatorUser', 'assignUser', 'domain', 'subdomain' );
		
		$criteria->compare('creatorUser.fname', $this->creatorName, true, 'OR');
		$criteria->compare('creatorUser.lname', $this->creatorName, true, 'OR');
		
		$criteria->compare('assignUser.fname', $this->assignedName, true, 'OR');
		$criteria->compare('assignUser.lname', $this->assignedName, true, 'OR');
		
		$criteria->compare('domain.name', $this->domainName, true);
		
		$criteria->compare('subdomain.name', $this->subDomainName, true);
				
        $criteria->compare('id',$this->id,true);
        $criteria->compare('creator_user_id',$this->creator_user_id,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('created_date',$this->created_date,true);
        $criteria->compare('subject',$this->subject,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('assign_user_id',$this->assign_user_id,true);
        $criteria->compare('t.domain_id',$this->domain_id,true);
        $criteria->compare('t.subdomain_id',$this->subdomain_id,true);
        $criteria->compare('file',$this->file,true);
        $criteria->compare('priority_id',$this->priority_id);
        $criteria->compare('assigned_date',$this->assigned_date,true);
        $criteria->compare('closed_date',$this->closed_date,true);
        $criteria->compare('isEscalated',$this->isEscalated);
        //$criteria->compare('Mentor1',$this->Mentor1);
        //$criteria->compare('Mentor2',$this->Mentor2);

        return new CActiveDataProvider($this, array( 
            'criteria'=>$criteria,
        		'sort'=>array(
        				'attributes'=>array(
        						'creatorName'=>array(
        								'asc'=>'creatorUser.lname',
        								'desc'=>'creatorUser.lname DESC',
        						),
        						'assignedName'=>array(
        								'asc'=>'assignUser.lname',
        								'desc'=>'assignUser.lname DESC',
        						),
        						'domainName'=>array(
        								'asc'=>'domain.name',
        								'desc'=>'domain.name DESC',
        						),
        						'subDomainName'=>array(
        								'asc'=>'subdomain.name',
        								'desc'=>'subdomain.name DESC',
        						),
        						'*',
        						
        				),
        		),
        )); 
    }
    public function getCreatedDateToString()
    {
        return date("M d, Y", strtotime($this->created_date));
    }
    public function getAssignedDateToString()
    {
        return date("M d, Y", strtotime($this->assigned_date));
    }
    public function getLatestActivityDate()
    {
        $latestTicketEvent = TicketEvents::model()->findBySql("select max(event_recorded_date) as event_recorded_date, description as id  from (select event_type_id, event_recorded_date from ticket_events where ticket_id = ". $this->id ." and (event_type_id != 9 and event_type_id !=8) order by event_recorded_date desc)x left join event_type on event_type.id = event_type_id; ");
        return "" . $latestTicketEvent->id . " " . date("M d, Y", strtotime($latestTicketEvent->event_recorded_date));
    }
    public function searchClosed($id)
    {
        return new CActiveDataProvider($this, array(
            'criteria'=>array(
                'condition'=>'(assign_user_id ='.$id.' or creator_user_id = '.$id.') and (status Like "close")',
                'with' => array( 'creatorUser', 'assignUser', 'domain', 'ticketEvents' ),
            ),
            'sort'=>array(
                'defaultOrder'=>'t.id ASC',
                'attributes'=>array(
                    '*',
                    'Created By'=>array(
                        'asc'=>'creatorUser.lname',
                        'desc'=>'creatorUser.lname DESC',
                    ),
                    'Assigned To'=>array(
                        'asc'=>'assignUser.lname',
                        'desc'=>'assignUser.lname DESC',
                    ),
                    'domainName'=>array(
                        'asc'=>'domain.name',
                        'desc'=>'domain.name DESC',
                    ),
                ),
            ),
        ));

    }

    public function searchToDo($id)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.


        return new CActiveDataProvider($this, array(
            'criteria'=>array(
                'condition'=>'(assign_user_id ='.$id.' or creator_user_id = '.$id.') and (status Like "pending" or status like "reject")',
                'with' => array( 'creatorUser', 'assignUser', 'domain', 'ticketEvents' ),
            ),
            'sort'=>array(
                'defaultOrder'=>'t.id ASC',
                'attributes'=>array(
                    '*',
                    'Created By'=>array(
                        'asc'=>'creatorUser.lname',
                        'desc'=>'creatorUser.lname DESC',
                    ),
                    'Assigned To'=>array(
                        'asc'=>'assignUser.lname',
                        'desc'=>'assignUser.lname DESC',
                    ),
                    'domainName'=>array(
                        'asc'=>'domain.name',
                        'desc'=>'domain.name DESC',
                    ),
                ),
            ),
        ));
    }
    public function getCompiledCreatorID()
	{
		
		return (/*$this->creator_user_id . ' ' .*/
				$this->creatorUser->fname . ' ' .
				$this->creatorUser->lname);
	}
	
	public function getCompiledAssignedID()
	{
		return (/*$this->assign_user_id . ' ' .*/
				$this->assignUser->fname . ' ' .
				$this->assignUser->lname);
	}
	
	public function getDomainID(){
		return ($this->domain->name);
	}
	
	public function getSubDomainID(){
		$valsd = $this->subdomain_id;
		if ($valsd != null) {
			$subDomainName = $this->subdomain->name;
		} else {
			$subDomainName = '-';
		}
		
		return $subDomainName;
	}

}