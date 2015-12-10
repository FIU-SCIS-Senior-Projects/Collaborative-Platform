<?php
require_once(__DIR__.'/../../../PasswordHash.php');
/**
 * Created by PhpStorm.
 * User: Ricky
 * Date: 11/7/2015
 * Time: 11:27 AM
 */

class MentorApplicationTest extends CDbTestCase
{
   protected function setUp()
   {
       $login = new LoginForm;
       $login->username = 'rdomi005';
       $login->password = 'rdomi005!';
       $login->login();

       //personal mentor data
       $_POST['application_personal_mentor']['status'] = 'Admin';
       $_POST['application_personal_mentor']['date_created'] = new CDbExpression('NOW()');
       $_POST['application_personal_mentor']['max_amount'] = '10';
       $_POST['application_personal_mentor']['max_hours'] = '10';
       $_POST['application_personal_mentor']['system_pick_amount'] = '0';
       $_POST['application_personal_mentor_pick']['approval_status']= 'Proposed by Mentor';

       //project mentor data
       $_POST['application_project_mentor']['status'] = 'Admin';
       $_POST['application_project_mentor']['date_created'] = new CDbExpression('NOW()');
       $_POST['application_project_mentor']['max_amount'] = '10';
       $_POST['application_project_mentor']['max_hours'] = '10';
       $_POST['application_project_mentor']['system_pick_amount'] = '0';
       $_POST['application_project_mentor_pick']['approval_status'] = 'Proposed by Mentor';

       //domain mentor data
       $_POST['application_domain_mentor']['status'] = 'Admin';
       $_POST['application_domain_mentor']['date_created'] = new CDbExpression('NOW()');
       $_POST['application_domain_mentor']['max_amount'] = '3';
       $_POST['application_domain_mentor']['max_hours'] = '0';
       $_POST['application_domain_mentor_pick']['domain_id'] = '8';
       $_POST['application_domain_mentor_pick']['approval_status'] = 'Proposed by Mentor';
       $_POST['application_domain_mentor_pick']['proficiency'] = '1';

       //adding a domain
       $_POST['domain']['name'] = 'Baseball';
       $_POST['domain']['description'] = 'The sport of kings';
       $_POST['domain']['validator'] = '5';
       $_POST['domain']['need'] = 'Medium';
       $_POST['domain']['need_amount'] = '5';

       //adding a subdomain
       $_POST['subdomain']['name'] = 'Catching';
       $_POST['subdomain']['description'] = 'A subset of Baseball';
       $_POST['subdomain']['validator'] = '5';
       $_POST['subdomain']['need'] = 'Medium';
       $_POST['subdomain']['need_amount'] = '5';

   }

    function testApply_for_Personal_Mentorship()
    {
        $user = User::getCurrentUserId();
        $personal = new ApplicationPersonalMentor;
        $_POST['application_personal_mentor']['user_id'] = $user;
        $personal->attributes=$_POST['application_personal_mentor'];
        $personal->save();

        $personalp = new ApplicationPersonalMentorPick;
        $_POST['application_personal_mentor_pick']['app_id'] = $personal->id;
        $_POST['application_personal_mentor_pick']['user_id'] = $user;
        $personalp->attributes=$_POST['application_personal_mentor_pick'];
        $personalp->save();

        return $personalp->app_id;
    }

    function testApply_for_Project_Mentorship()
    {
        $user = User::getCurrentUserId();
        $project = new ApplicationProjectMentor;
        $_POST['application_project_mentor']['user_id'] = $user;
        $project->attributes=$_POST['application_project_mentor'];
        $project->save();

        $projectp = new ApplicationProjectMentorPick;
        $_POST['application_project_mentor_pick']['app_id'] = $project->id;
        $_POST['application_project_mentor_pick']['user_id'] = $user;
        $_POST['application_project_mentor_pick']['project_id'] = '133';
        $projectp->attributes=$_POST['application_project_mentor_pick'];
        $projectp->save();
    }

    function testAllow_admin_to_view_pending_application()
    {
        $pending = ApplicationProjectMentor::model()->findAllBySql("Select * from application_project_mentor where status != 'Closed'");
        $pending += ApplicationPersonalMentor::model()->findAllBySql("Select * from application_personal_mentor where status != 'Closed'");
        $pending += ApplicationDomainMentor::model()->findAllBySql("Select * from application_domain_mentor where status != 'Closed'");
        $this->assertNotNull($pending);
    }

    function testApply_for_Domain_Mentorship()
    {
        $user = User::getCurrentUserId();
        $domain = new ApplicationDomainMentor;
        $_POST['application_domain_mentor']['user_id'] = $user;
        $domain->attributes=$_POST['application_domain_mentor'];
        $domain->save();

        $domainp = new ApplicationDomainMentorPick;
        $_POST['application_domain_mentor_pick']['app_id'] = $domain->id;
        $_POST['application_domain_mentor_pick']['user_id'] = $user;
        $domainp->attributes=$_POST['application_domain_mentor_pick'];
        $domainp->save();
    }

    function testAllow_admin_to_view_specified_user()
    {
        $user = User::getUser(1049);
        $this->assertNotNull($user);
    }

    function testAdd_a_Domain()
    {
        $domain = $this->createDomain();
        $this->assertNotNull($domain);
    }

    function testAdd_a_SubDomain()
    {
        $subdomain = $this->createSubDomain();
        $this->assertNotNull($subdomain);
    }

    function testAllow_admin_to_view_specified_domain()
    {
        if(User::isCurrentUserAnAdmin())
        {
            $domain = Domain::model()->findByPk(8);
            $this->assertNotNull($domain);
        }
    }
    function testAllow_admin_to_view_specified_subdomain()
    {
        if(User::isCurrentUserAnAdmin())
        {
            $subdomain = Subdomain::model()->findByPk(3);
            $this->assertNotNull($subdomain);
        }
    }

    /**
     * @depends testApply_for_Personal_Mentorship
     */
    function testAllow_admin_to_approve_items_in_application($id)
    {
        //to avoid redundancy, this will only be tested on 1 application system, but can be applied to all of them by changing the name
       if(User::isCurrentUserAnAdmin())
       {
           $project1 = ApplicationProjectMentor::model()->findAllByPk($id);
           $this->assertEquals('Admin', $project1->status);
           ApplicationProjectMentor::model()->updateByPk($id);
           $project = ApplicationProjectMentor::model()->findAllByPk($id);
           $this->assertEquals('Accepted', $project->status);
       }



    }

    function findSelectedUser($id)
    {
        return User::model()->findByPk($id);
    }

    function createDomain()
    {
        $domain = new Domain;
        $domain->attributes=$_POST['domain'];
        $domain->save();
        return $domain->id;
    }

    function createSubDomain()
    {
        $id = $this->createDomain();
        $subdomain = new Subdomain;
        $_POST['subdomain']['domain_id'] = $id;
        $subdomain->attributes=$_POST['subdomain'];
        $subdomain->save();
        return $subdomain->id;
    }

}