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
	public static function model($className=__CLASS__)
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
			array('videoconference_id, invitee_id', 'length', 'max'=>11),
			array('status', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('videoconference_id, invitee_id, status', 'safe', 'on'=>'search'),
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

		$criteria=new CDbCriteria;

		$criteria->compare('videoconference_id',$this->videoconference_id,true);
		$criteria->compare('invitee_id',$this->invitee_id,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


    public static function sendInvitationEmail($meeting_id, $moderator_id, $invitee_name, $invitee_email){

        $moderator = User::model()->findByPk($moderator_id);
        $moderator_name = $moderator->fname ." ".  $moderator->lname;

        $link = CHtml::link('here', Yii::app()->createAbsoluteUrl('videoConference/join/' . $meeting_id ,array(),'https'));
        //$link = <a href='" . Yii::app()->getBaseUrl(true). "/index.php/videoConference/join/". $meeting_id . "'>here</a>.";
        $message = "You have been invited to a video conference by " . $moderator_name . ".<br>Please join " . $link ;
        $html = User::replaceMessage($invitee_name, $message);

        $email = Yii::app()->email;
        $email->to = $invitee_email;
        $email->from = 'Collaborative Platform';
        $email->subject = 'New Video Conference Invitation';
        $email->message = $html;
        $email->send();
    }


}