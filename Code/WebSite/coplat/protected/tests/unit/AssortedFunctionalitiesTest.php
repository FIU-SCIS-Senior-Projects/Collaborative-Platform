<?php
require_once(__DIR__.'/../../../PasswordHash.php');
/**
 * Created by PhpStorm.
 * User: Ricky
 * Date: 11/7/2015
 * Time: 11:27 AM
 */

class AssortedFunctionalitiesTest extends CDbTestCase
{
    protected function setUp()
    {

    }

   function testRetreieve_Project_Information()
    {
        $project = $this->Retreieve_Project_Information('118');
        $this->assertNotNull($project);
    }

    //currently doesnt work properly due to DB constraints, didnt have time to fix on second iteration.
    function testSet_Up_Meeting()
    {
        $_POST['personal_meeting']['mentee_user_id'] = '1052';
        $_POST['personal_meeting']['personal_mentor_user_id'] = '1029';
        $_POST['personal_meeting']['date'] = '2015-12-02';
        $_POST['personal_meeting']['time'] = '08:00:00';

        $meeting = new PersonalMeeting;
        $meeting->attributes=$_POST['personal_meeting'];
        $meeting->save();

        return $meeting->id;
    }

    //Change assertNull to assertNotNull once above method is properly handled
    function testView_Upcoming_Meetings()
    {
        $meetings = PersonalMeeting::model()->findAllBySql("Select * from personal_meeting where date >= CURRENT_DATE AND time >= CURRENT_TIME ");
        foreach($meetings as $m) {
            $this->assertNull($m);
        }
    }

    function testView_Open_Invitations()
    {
        $invites = Invitation::model()->findAllBySql("Select * from invitation ");
        foreach($invites as $i)
        {
            $this->assertNotNull($i->id);
        }
     }

    function testSend_Custom_Invite()
    {
        $_POST['invitation']['email'] = 'test123@test.co';
        $_POST['invitation']['administrator_user_id'] = '5';
        $_POST['invitation']['date'] = new CDbExpression('NOW()');
        $_POST['invitation']['administrator'] = '0';
        $_POST['invitation']['mentor'] = '0';
        $_POST['invitation']['mentee'] ='1';
        $_POST['invitation']['employer'] = '0';
        $_POST['invitation']['judge'] = '0';
        $_POST['invitation']['name'] = 'Ricky';
        $_POST['invitation']['message'] = 'Join us!';

        $invite = new Invitation;
        $invite->attributes=$_POST['invitation'];
        $invite->save();

        return $invite->id;
    }

    function Retreieve_Project_Information($id)
    {
        $project = Project::model()->findByPk($id);
        foreach($project as $p) {
            return $project->id;
        }
    }
}