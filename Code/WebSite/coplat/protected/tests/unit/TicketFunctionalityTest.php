<?php
require_once(__DIR__.'/../../../PasswordHash.php');
/**
 * Created by PhpStorm.
 * User: Ricky
 * Date: 11/3/2015
 * Time: 11:01 AM
 */

class TicketFunctionalityTest extends CDbTestCase
{
    protected $random;

    protected function setUp()
    {
        $login = new LoginForm;
        $login->username = 'rdomi005';
        $login->password = 'rdomi005!';
        $login->login();

        $user = User::getCurrentUser();
        $this->random = rand(1,2);

        $_POST['ticket']['creator_user_id'] = '1049';
        $_POST['ticket']['status'] = 'Pending';
        $_POST['ticket']['subject'] = 'Subject';
        $_POST['ticket']['description'] = 'Description';
        $_POST['ticket']['priority_id'] = '1';
        if($this->random == '1')
        {
            $_POST['ticket']['assigned_project_id'] = '82';
        }
        else{
            $_POST['ticket']['assigned_project_id'] = '1';
        }
        $_POST['ticket']['created_date'] =  new CDbExpression('NOW()');
        $_POST['ticket']['assigned_date'] =  new CDbExpression('NOW()');

        $_POST['comment']['description'] = 'this is a comment';
        $_POST['comment']['added_date'] = new CDbExpression('NOW()');
        $_POST['comment']['ticket_id'] = '188';
        $_POST['comment']['user_added'] = $user->fname.' '.$user->lname;


    }

    function testCreate_A_Ticket()
    {
       $id = $this->CreateGenericTicket();
       $this->assertNotNull($id);
        return $id;
    }

    function testSelect_A_specific_domain_for_a_new_ticket()
    {
        $id = $this->CreateSpecificTicket(14, NULL, true);
        $this->assertNotNull($id);
    }

    function testSelect_A_Specific_SubDomain_For_A_new_Ticket()
    {
        $id = $this->CreateSpecificTicket(8,8, true);
        $this->assertNotNull($id);
    }

    function testAppend_comments_to_a_ticket()
    {
        $id = $this->CreateComment();
        $this->assertNotNull($id);
    }

    /**
     * @depends testCreate_A_Ticket
     */
    function testRetrieve_the_ticket_details($id)
    {
        $this->assertNotNull($id);
    }

    /**
     * @depends testCreate_A_Ticket
     */
    function testEscalate_A_Ticket($id)
    {
        Ticket::model()->updateByPk($id, array('isEscalated'=>'1'));
        $this->assertNotNull(Ticket::model()->findBySql("Select * from ticket where id=$id and isEscalated='1'"));
    }

    /**
     * @depends testCreate_A_Ticket
     */
    function testChange_Ticket_Priority($id)
    {
        Ticket::model()->updateByPk($id, array('priority_id'=>'12'));
        $this->assertNotNull(Ticket::model()->findBySql("Select * from ticket where id=$id and priority_id='12'"));
    }

    /**
     * @depends testCreate_A_Ticket
     */
    function testClose_A_Ticket($id)
    {
       Ticket::model()->updateByPk($id, array('status'=>'Closed', 'closed_date'=>new CDbExpression('NOW()')));
       $this->assertNotNull(Ticket::model()->findBySql("Select * from ticket where id=$id and status='Closed'"));
    }

    /**
     * @depends testCreate_A_Ticket
     */
    function testReject_A_Ticket($id)
    {
        Ticket::model()->updateByPk($id, array('status'=>'Reject', 'closed_date'=>new CDbExpression('NOW()')));
        $this->assertNotNull(Ticket::model()->findBySql("Select * from ticket where id=$id and status='Reject'"));
    }

    function testAuto_Assign_Ticket()
    {
        $this->CreateSpecificTicket(8, NULL, true);
        $ticket = Ticket::model()->findAllBySql("Select * from ticket where assign_user_id=5 and mentor1=7 and mentor2=19");
        $this->assertTrue(is_array($ticket));
        foreach($ticket as $t)
        {
            $user=User::automaticReassignBySystem(8, NULL, 5, 1, 7, 19);
            Ticket::model()->updateByPk($t->id, array('assign_user_id'=>$user));
            $newTicket = Ticket::model()->findAllByPk($t->id);
            foreach($newTicket as $nt) {
                $this->assertEquals($user, $nt->assign_user_id);
            }
        }

    }

    /**
     * @depends testCreate_A_Ticket
     */
    function testReassign_Ticket($id)
    {
        /**can be used to test auto-reassign as well, might need some debugging, some of the syntax might be wrong
         * $ticket = Ticket::model()->findByPk($id);
         * might need a foreach here, might not, foreach would look like foreach($ticket as $t) and then include the bottom part
        * $start = strtotime($ticket->date_created);
        * $end = strtotime(new CDbExpression('NOW()');
        * this one is set for 5 days
        * if($end - $start > 432000)
         * {
        */
        Ticket::model()->updateByPk($id, array('status'=>'Pending', 'assigned_date'=>new CDbExpression('NOW()'), 'assign_user_id'=>'5'));
        $this->assertNotNull(Ticket::model()->findBySql("Select * from ticket where id=$id and status='Pending' and assign_user_id = 5"));

        //}
    }



    /**
     * @depends testCreate_A_Ticket
     */
    function testAssign_Ticket_to_other_project_mentor($id)
    {
        $ticket = Ticket::model()->findAllByPk($id);
        if($ticket != Null)
        {
            foreach($ticket as $t)
            {
                $user1=$t->assign_user_id;
                $this->assertNotNull($user1);
                Ticket::model()->updateByPk($t->id, array('assign_user_id'=>'1049'));
                $newTicket = Ticket::model()->findAllByPk($id);
                foreach($newTicket as $nt)
                {
                    $user2=$nt->assign_user_id;
                    $this->assertNotEquals($user1, $user2);
                }
            }
        }


    }



    function testRetrieve_The_Tickets_Created_by_Their_Mentees()
    {
        $list = User::findMenteeTicketsUnderSpecifiedProject(2);
        $this->assertNotNull($list);
    }


    function CreateGenericTicket()
    {
        $user = User::getCurrentUser();
        $ticket = new Ticket;
        if($this->random==1)
        {
            $_POST['ticket']['assign_user_id'] = '1016';
        }
        else{
            $_POST['ticket']['assign_user_id'] = '5';
        }
        $_POST['ticket']['domain_id'] = '8';
        $ticket->attributes=$_POST['ticket'];
        $ticket->save();
        return $ticket->id;
    }

    function CreateSpecificTicket($domainid, $subdomainid, $autoAssign)
    {
        $user = User::getCurrentUser();
        $ticket = new Ticket;
        if($this->random==1)
        {
            $_POST['ticket']['assign_user_id'] = '1016';
        }
        else{
            $_POST['ticket']['assign_user_id'] = '5';
        }
        if($autoAssign == true)
        {
            $_POST['ticket']['assign_user_id'] = '5';
            $_POST['ticket']['Mentor1'] = '7';
            $_POST['ticket']['Mentor2'] = '19';
        }
        $_POST['ticket']['domain_id'] = $domainid;
        if($subdomainid != NULL)
        {
            $_POST['ticket']['subdomain_id'] = $subdomainid;
        }

        $ticket->attributes=$_POST['ticket'];
        $ticket->save();
        return $ticket->id;
    }



    function CreateComment()
    {
        $comment = new Comment;
        $comment->attributes=$_POST['comment'];
        $comment->save();
        return $comment->id;
    }

}