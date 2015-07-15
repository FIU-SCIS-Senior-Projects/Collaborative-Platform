<?php

/**
 * This is the model class for table "video_conference".
 *
 * The followings are the available columns in table 'video_conference':
 * @property string $id
 * @property string $subject
 * @property string $moderator_id
 * @property string $scheduled_on
 * @property string $scheduled_for
 * @property string $notes
 *
 * The followings are the available model relations:
 * @property User $moderator
 */
class VideoConference extends CActiveRecord
{
    public $dateToString;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return VideoConference the static model class
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
        return 'video_conference';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//          array('id, moderator_id', 'required'),
//          array('id, moderator_id', 'length', 'max'=>11),
            array('subject', 'required'),
            array('subject', 'length', 'max'=>255),
            array('notes', 'length', 'max'=>255),
            array('scheduled_on, scheduled_for', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, subject, moderator_id, scheduled_on, scheduled_for, notes', 'safe', 'on'=>'search'),
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
            'moderator' => array(self::BELONGS_TO, 'User', 'moderator_id'),
            'invitations'=>array(self::HAS_MANY, 'VCInvitation', 'videoconference_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'subject' => 'Subject',
            'moderator_id' => 'Moderator',
            'scheduled_on' => 'Scheduled On',
            'scheduled_for' => 'Date',
            'notes' => 'Notes',
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
        $criteria->compare('subject',$this->subject,true);
        $criteria->compare('moderator_id',$this->moderator_id,true);
        $criteria->compare('scheduled_on',$this->scheduled_on,true);
        $criteria->compare('scheduled_for',$this->scheduled_for,true);
        $criteria->compare('notes',$this->notes,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function currentUserDataProvider()
    {
            // create your second data provider here
            // with filtering based on model's attributes, e.g.:

/*
           // $user = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));




            $criteria = new CDbCriteria;
            $criteria->compare('someAttribute', $this->someAttribute);

            return new CActiveDataProvider('User', array(
                'criteria' => $criteria,
            ));

*/
    }

    public function searchDeleted($id)
    {
        return new CActiveDataProvider($this, array(
            'criteria'=>array(
                'condition'=>'(moderator_id ='.$id.' or x.invitee_id = '.$id.') and t.status LIKE "deleted"',
                'join'=> 'left join (select * from vc_invitation where invitee_id = '.$id.')x on t.id = x.videoconference_id'
            ),
            'sort'=>array(
                'defaultOrder'=>'scheduled_for ASC',

            ),
        ));

    }

    public function searchUpcoming($id)
    {
        return new CActiveDataProvider($this, array(
            'criteria'=>array(
                'condition'=>'(moderator_id ='.$id.' or x.invitee_id = '.$id.') and scheduled_for >= DATE_ADD(NOW() , INTERVAL -1 HOUR )',
                'join'=> 'left join (select * from vc_invitation where invitee_id = '.$id.')x on t.id = x.videoconference_id'
            ),
                'sort'=>array(
                'defaultOrder'=>'scheduled_for ASC',

            ),
        ));

    }

    public function findParticipantsAsString(){
        $moderator = User::model()->findByAttributes(array("id" => $this->moderator_id));
        $str = $moderator->fname . " " .$moderator->lname;
        $invitations = VCInvitation::model()->findAllByAttributes(array("videoconference_id" =>$this->id));
        foreach($invitations as $inv){
            $invitee = User::model()->findByAttributes(array("id" => $inv->invitee_id));
            $str .= ", " . $invitee->fname . " " .$invitee->lname;
        }
        return $str;

    }

    public function findParticipantsHTMLList(){

        $moderator = User::model()->findByAttributes(array("id" => $this->moderator_id));








        $str = "<ul> " .
                    "<li><span style=''>Moderator:</span>" . $moderator->fname . " " .$moderator->lname . "</li>";

        $invitations = VCInvitation::model()->findAllByAttributes(array("videoconference_id" =>$this->id));
        foreach($invitations as $inv){
            $invitee = User::model()->findByAttributes(array("id" => $inv->invitee_id));

            $status = "";
            $title = "";
            if($inv->status == "Rejected"){
                $title='Rejected';
                $status = "<i  style='color:#d9534f;' class='fa fa-ban'></i>";
            }
            else if($inv->status == "Accepted"){
                $title='Accepted';
                $status = "<i style='color:#5cb85c;' class='fa fa-check-circle-o'></i>";
            }
            else {
                $title='Pending user response';
                $status = "<i class='fa fa-question-circle'></i>";
            }



            $str .= "<li title='$title'>" . $invitee->fname . " " .$invitee->lname . " " . $status . "<li>";
        }

        $str .= "</ul>";

        return $str;

    }

    public function findParticipantsSimpleHTMLList(){
        $moderator = User::model()->findByAttributes(array("id" => $this->moderator_id));



        $str = "<ul> " .
            "<li><span style='font-weight: bold;margin-right: 6px;'>Moderator:</span>" . $moderator->fname . " " .$moderator->lname . "</li>";
        $invitations = VCInvitation::model()->findAllByAttributes(array("videoconference_id" =>$this->id));
        foreach($invitations as $inv){
            $invitee = User::model()->findByAttributes(array("id" => $inv->invitee_id));
            $str .= "<li>" . $invitee->fname . " " .$invitee->lname . "</li>";
        }

        $str .= "</ul>";

        return $str;
    }

    public function getDateToString()
    {
        $date = new DateTime($this->scheduled_for);
        $now = new DateTime("now");
        if ($date->format('Y-m-d') == date('Y-m-d'))
        {
           // if($now > $date) {
            //    return "Today, " . date(" g:i A", strtotime($this->scheduled_for)) . " LATE";
           // }
           // else {
                return "Today, " . date(" g:i A", strtotime($this->scheduled_for));
           // }
        }
        else {
            return date("M d, g:i A", strtotime($this->scheduled_for));
        }

    }
    public  function cancel(){
        $this->status = "cancelled";

        $invitations = VCInvitation::model()->findAllByAttributes(array("videoconference_id" =>$this->id));
        foreach($invitations as $inv){
            $invitee = User::model()->findByAttributes(array("id" => $inv->invitee_id));
            VCInvitation::sendCancelNotification($this, $invitee->fname . " " . $invitee->lname, $invitee->email);

        }


        return $this->save();
    }

    public  function delete(){
        $this->status = "deleted";
        return $this->save();
    }
}