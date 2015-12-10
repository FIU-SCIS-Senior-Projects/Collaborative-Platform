<?php
require_once(__DIR__.'/../../../PasswordHash.php');
/**
 * Created by PhpStorm.
 * User: Ricky
 * Date: 11/9/2015
 * Time: 9:29 AM
 */

class MeetingsTest extends CDbTestCase
{
    function setUp()
    {
        $login = new LoginForm;
        $login->username = 'rdomi005';
        $login->password = 'rdomi005!';
        $login->login();


        //setting up meeting
        $_POST['video_conference']['subject'] = 'This is not a real subject';
        $_POST['video_conference']['scheduled_on'] = new CDbExpression('NOW()');
        $_POST['video_conference']['scheduled_for'] = new CDbExpression('NOW()');
        $_POST['video_conference']['notes'] = 'This is not a real note';
        $_POST['video_conference']['status'] = 'scheduled';
        $_POST['vc_invitation']['invitee_id'] = '5';
        $_POST['vc_invitation']['status'] = 'Unknown';


    }

    function testSet_Up_Meetings()
    {
        $id = $this->createNewMeeting();
        $this->assertNotNull($id);
    }

    function testRetrieve_All_Upcoming_Meetings()
    {
        $newmeetings = new CActiveDataProvider($this);
        $meetings = new VideoConference;
        $newmeetings = $meetings->searchUpcoming(User::getCurrentUserId());
        $this->assertNotNull($newmeetings->modelClass);

    }

    function testInvite_More_People()
    {
        $id = $this->createNewMeeting();
        $this->inviteMorePeople($id, '1032');
        $query = VCInvitation::model()->findAllBySql("Select * from vc_invitation where videoconference_id = $id and invitee_id = '1032'");
        $this->assertNotNull($query);

    }

    function testAccept_Conference_Invitation()
    {
        $original = $this->createNewMeeting();
        Yii::app()->user->logout();

        $login = new LoginForm;
        $login->username = 'admin';
        $login->password = 'admin';
        $login->login();

        $model = VCInvitation::model()->findAllBySql("Select * from vc_invitation where videoconference_id = $original and invitee_id = '5'");

        foreach ($model as $m)
        {
            if(User::getCurrentUserId() == '5')
            {
                $avatar = VCInvitation::model()->findByAttributes(array('videoconference_id'=>$m->videoconference_id, 'invitee_id'=>'5'));
                $avatar->attributes=array('status'=>'Accepted');
                $avatar->save();
            }
        }
    }

    function testReject_Conference_Invitation()
    {
        $original = $this->createNewMeeting();
        Yii::app()->user->logout();

        $login = new LoginForm;
        $login->username = 'admin';
        $login->password = 'admin';
        $login->login();

        $model = VCInvitation::model()->findAllBySql("Select * from vc_invitation where videoconference_id = $original and invitee_id = '5'");

        foreach ($model as $m)
        {
            if(User::getCurrentUserId() == '5')
            {
                $avatar = VCInvitation::model()->findByAttributes(array('videoconference_id'=>$m->videoconference_id, 'invitee_id'=>'5'));
                $avatar->attributes=array('status'=>'Rejected');
                $avatar->save();
            }
        }
    }

    function testCancel_Conference_Invitation()
    {
        $original = $this->createNewMeeting();

        $model = VCInvitation::model()->findAllBySql("Select * from video_conference where id = $original");

        foreach ($model as $m)
        {
                VideoConference::model()->updateByPk($original, array('status'=>'cancelled'));

        }
    }

    function testEdit_Video_Conference_Information()
    {
        $original = $this->createNewMeeting();

        $model = VCInvitation::model()->findAllBySql("Select * from video_conference where id = $original");

        foreach ($model as $m)
        {
            VideoConference::model()->updateByPk($original, array('subject'=>'This is a new subject', 'notes'=>'This is a new note.'));

        }
    }

    function createNewMeeting()
    {
        $vconference = new VideoConference;
        $moderator = User::model()->findByAttributes(array("username" => Yii::app()->user->getId()));
        $vconference->moderator_id = $moderator->id;
        $vconference->attributes=$_POST['video_conference'];
        $vconference->save();

        $_POST['vc_invitation']['videoconference_id'] = $vconference->id;
        $vinvite = new VCInvitation;
        $vinvite->attributes=$_POST['vc_invitation'];
        $vinvite->save();
        return $vconference->id;
    }

    function inviteMorePeople($id, $invitee)
    {
       $moreInvites = new VCInvitation;
        $moreInvites->videoconference_id = $id;
        $moreInvites->invitee_id = $invitee;
        $moreInvites->status = 'Unknown';
        $moreInvites->save();

    }
}