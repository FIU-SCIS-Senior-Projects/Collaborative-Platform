<?php

/**
 * This is the model class for table "vc_invitation".
 *
 * The followings are the available columns in table 'vc_invitation':
 * @property string $videoconference_id
 * @property string $invitee_id
 * @property string $status
 *
 * The followings are the available model relations:
 * @property User $invitee
 */
class VCInvitation extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return VCInvitation the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'vc_invitation';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('videoconference_id, invitee_id', 'required'),
            array('videoconference_id, invitee_id', 'length', 'max' => 11),
            array('status', 'length', 'max' => 32),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('videoconference_id, invitee_id, status', 'safe', 'on' => 'search'),
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
            'invitee' => array(self::BELONGS_TO, 'User', 'invitee_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'videoconference_id' => 'Videoconference',
            'invitee_id' => 'Invitee',
            'status' => 'Status',
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

        $criteria = new CDbCriteria;

        $criteria->compare('videoconference_id', $this->videoconference_id, true);
        $criteria->compare('invitee_id', $this->invitee_id, true);
        $criteria->compare('status', $this->status, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

/*
    public static function sendInvitationEmail($meeting_id, $moderator_id, $invitee_name, $invitee_email)
    {

        $moderator = User::model()->findByPk($moderator_id);
        $moderator_name = $moderator->fname . " " . $moderator->lname;

        $join = CHtml::link('here', Yii::app()->createAbsoluteUrl('videoConference/join/' . $meeting_id, array(), 'https'));
        $accept = CHtml::link('accept', Yii::app()->createAbsoluteUrl('videoConference/accept/' . $meeting_id, array(), 'http'));
        $reject = CHtml::link('reject', Yii::app()->createAbsoluteUrl('videoConference/reject/' . $meeting_id, array(), 'http'));


        //$link = <a href='" . Yii::app()->getBaseUrl(true). "/index.php/videoConference/join/". $meeting_id . "'>here</a>.";
        $message = "You have been invited to a video conference by " . $moderator_name . ".<br>You can join " . $join .
            "<br>Please " . $accept . "  or " . $reject;;
        $html = User::replaceMessage($invitee_name, $message);

        $email = Yii::app()->email;
        $email->to = $invitee_email;
        $email->from = 'Collaborative Platform <fiucoplat@cp-dev.cs.fiu.edu>';
        $email->subject = 'New Video Conference Invitation';
        $email->message = $html;
        $email->send();
    }
*/

    public static function sendInvitationEmail($vc, $invitee_name, $invitee_email)
    {

        $moderator = User::model()->findByPk($vc->moderator_id);
        $moderator_name = $moderator->fname . " " . $moderator->lname;

        $btnstyle = "padding:4px 6px;font-size:small;margin-right: 4px;color: #ffffff;text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);border-radius: 1px;";


        $accept = CHtml::link('Accept', Yii::app()->createAbsoluteUrl('videoConference/accept/' . $vc->id), array('role' => "button", "class" => "",'style' => $btnstyle . "background-color:#5bb75b;"), 'http');
        $reject = CHtml::link('Reject', Yii::app()->createAbsoluteUrl('videoConference/reject/' . $vc->id), array('role' => "button", "class" => "",'style' => $btnstyle . "background-color:#da4f49;"), 'http');
        $join =   CHtml::link('Join Now', Yii::app()->createAbsoluteUrl('videoConference/join/' . $vc->id), array('role' => "button", "class" => "",'style' => $btnstyle . "background-color:#006dcc;"), 'https');
        $subject = CHtml::link($vc->subject, Yii::app()->createAbsoluteUrl('videoConference/' . $vc->id), array('style' => "color: #31708f;"), 'http');


        $html = "Dear " . $invitee_name . ",<br><br>You have been invited by " . $moderator_name . " to the following video conference:  <br> ";

        $dt = new DateTime($vc->scheduled_for);
        $user_friendly_date = $dt->format("m/d/Y h:i A");


        $html .= "<div style='background-color:#d9edf7;margin-top:20px;padding:10px;width:400px;border-radius: 2px;'>
                    %SUBJECT%
                    <p style='margin:0;'>%DATE%</p>
                    <hr style='border-top: 1px solid #19536c;border-bottom: 0px;margin: 5px 0px;'>
                    %PARTICIPANTS%
                    <hr style='border-top: 1px solid #19536c;border-bottom: 0px;margin: 5px 0px;'>
                    <p style='margin:0;'><span style='font-weight: bold;margin-right: 6px;'>Notes:</span>%NOTE%</p>
                    <hr style='border-top: 1px solid #19536c;border-bottom: 0px;margin: 5px 0px;margin-bottom: 7px;'>
                    %JOIN%%ACCEPT%%REJECT%
                </div>";

        $html = str_replace("%SUBJECT%", $subject, $html);
        $html = str_replace("%DATE%", $user_friendly_date, $html);
        $html = str_replace("%NOTE%", $vc->notes, $html);
        $html = str_replace("%PARTICIPANTS%", $vc->findParticipantsSimpleHTMLList(), $html);
        $html = str_replace("%JOIN%", $join, $html);
        $html = str_replace("%ACCEPT%", $accept, $html);
        $html = str_replace("%REJECT%", $reject, $html);



        $email = Yii::app()->email;
        $email->to = $invitee_email;
        $email->from = 'Collaborative Platform <fiucoplat@cp-dev.cs.fiu.edu>';
        $email->replyTo ='fiucoplat@cp-dev.cs.fiu.edu';
        $email->returnPath = "fiucoplat@cp-dev.cs.fiu.edu";
        $email->subject = 'New Video Conference Invitation';
        $email->message = $html;
        $email->send();


    }

    public static function sendCancelNotification($vc, $invitee_name, $invitee_email)
    {

        $moderator = User::model()->findByPk($vc->moderator_id);
        $moderator_name = $moderator->fname . " " . $moderator->lname;

        $btnstyle = "padding:4px 6px;font-size:small;margin-right: 4px;color: #ffffff;text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);border-radius: 1px;";


        $subject = CHtml::link($vc->subject, Yii::app()->createAbsoluteUrl('videoConference/' . $vc->id), array('style' => "color: #31708f;"), 'http');


        $html = "Dear " . $invitee_name . ",<br><br>The following meeting has been canceled by " . $moderator_name . ":  <br> ";

        $dt = new DateTime($vc->scheduled_for);
        $user_friendly_date = $dt->format("m/d/Y h:i A");


        $html .= "<div style='background-color:#f4ffbc;margin-top:20px;padding:10px;width:400px;border-radius: 2px;'>
                    <p style='font-weight: bold'>Status: Cancelled</p>
                    %SUBJECT%
                    <p style='margin:0;'>%DATE%</p>
                    <hr style='border-top: 1px solid #19536c;border-bottom: 0px;margin: 5px 0px;'>
                    %PARTICIPANTS%
                    <hr style='border-top: 1px solid #19536c;border-bottom: 0px;margin: 5px 0px;'>
                    <p style='margin:0;'><span style='font-weight: bold;margin-right: 6px;'>Notes:</span>%NOTE%</p>
                </div>";

        $html = str_replace("%SUBJECT%", $subject, $html);
        $html = str_replace("%DATE%", $user_friendly_date, $html);
        $html = str_replace("%NOTE%", $vc->notes, $html);
        $html = str_replace("%PARTICIPANTS%", $vc->findParticipantsSimpleHTMLList(), $html);



        $email = Yii::app()->email;
        $email->to = $invitee_email;
        $email->from = 'Collaborative Platform <fiucoplat@cp-dev.cs.fiu.edu>';
        $email->replyTo ='fiucoplat@cp-dev.cs.fiu.edu';
        $email->returnPath = "fiucoplat@cp-dev.cs.fiu.edu";
        $email->subject = 'Canceled Video Conference';
        $email->message = $html;
        $email->send();


    }

    public static function sendUpdateNotification($vc, $invitee_name, $invitee_email)
    {

        $moderator = User::model()->findByPk($vc->moderator_id);
        $moderator_name = $moderator->fname . " " . $moderator->lname;

        $btnstyle = "padding:4px 6px;font-size:small;margin-right: 4px;color: #ffffff;text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);border-radius: 1px;";


        $accept = CHtml::link('Accept', Yii::app()->createAbsoluteUrl('videoConference/accept/' . $vc->id), array('role' => "button", "class" => "",'style' => $btnstyle . "background-color:#5bb75b;"), 'http');
        $reject = CHtml::link('Reject', Yii::app()->createAbsoluteUrl('videoConference/reject/' . $vc->id), array('role' => "button", "class" => "",'style' => $btnstyle . "background-color:#da4f49;"), 'http');
        $join =   CHtml::link('Join Now', Yii::app()->createAbsoluteUrl('videoConference/join/' . $vc->id), array('role' => "button", "class" => "",'style' => $btnstyle . "background-color:#006dcc;"), 'https');
        $subject = CHtml::link($vc->subject, Yii::app()->createAbsoluteUrl('videoConference/' . $vc->id), array('style' => "color: #31708f;"), 'http');


        $html = "Dear " . $invitee_name . ",<br><br>The following meeting has been modified by " . $moderator_name . ":  <br> ";

        $dt = new DateTime($vc->scheduled_for);
        $user_friendly_date = $dt->format("m/d/Y h:i A");


        $html .= "<div style='background-color:#d9edf7;margin-top:20px;padding:10px;width:400px;border-radius: 2px;'>
                    %SUBJECT%
                    <p style='margin:0;'>%DATE%</p>
                    <hr style='border-top: 1px solid #19536c;border-bottom: 0px;margin: 5px 0px;'>
                    %PARTICIPANTS%
                    <hr style='border-top: 1px solid #19536c;border-bottom: 0px;margin: 5px 0px;'>
                    <p style='margin:0;'><span style='font-weight: bold;margin-right: 6px;'>Notes:</span>%NOTE%</p>
                    <hr style='border-top: 1px solid #19536c;border-bottom: 0px;margin: 5px 0px;margin-bottom: 7px;'>
                    %JOIN%%ACCEPT%%REJECT%
                </div>";

        $html = str_replace("%SUBJECT%", $subject, $html);
        $html = str_replace("%DATE%", $user_friendly_date, $html);
        $html = str_replace("%NOTE%", $vc->notes, $html);
        $html = str_replace("%PARTICIPANTS%", $vc->findParticipantsSimpleHTMLList(), $html);
        $html = str_replace("%JOIN%", $join, $html);
        $html = str_replace("%ACCEPT%", $accept, $html);
        $html = str_replace("%REJECT%", $reject, $html);



        $email = Yii::app()->email;
        $email->to = $invitee_email;
        $email->from = 'Collaborative Platform <fiucoplat@cp-dev.cs.fiu.edu>';
        $email->returnPath = "fiucoplat@cp-dev.cs.fiu.edu";
        $email->replyTo ='fiucoplat@cp-dev.cs.fiu.edu';
        $email->subject = 'Video Conference Invitation Update';
        $email->message = $html;
        $email->send();
    }

}


