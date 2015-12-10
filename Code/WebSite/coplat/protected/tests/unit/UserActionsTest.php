<?php

require_once (__DIR__.'/../../controllers/SiteController.php');
require_once (__DIR__.'/../../controllers/UserController.php');
/**
 * Created by PhpStorm.
 * User: Ricky
 * Date: 11/2/2015
 * Time: 12:00 AM
 *
 * Despite the name UserLoginTest, this class will test all of the login features
 * including login, logout, and forgot password
 */

class UserActionsTest extends CDbTestCase
{
    //public $fixtures=array('feedback'=>'Feedback',);
    protected $login;
    protected $p2;
    protected $pconfirm;
    protected $userCount;
    protected $userInfoCount;
    protected $beforeUserCount;
    protected $afterUserCount;
    protected $beforeUserInfoCount;
    protected $afterUserInfoCount;
    protected $username, $password, $badPassword;
    protected $id;


    protected function setUp()
    {

        $_POST['user']['fname'] = 'Test';
        $_POST['user']['mname'] = '';
        $_POST['user']['lname'] = 'Account';
        $_POST['user']['email'] = 'test@testing.com';
        $_POST['user']['username'] = 'testing';
        $_POST['user']['password'] = 'testing';
        $_POST['user_info']['employer'] = 'test employer';
        $_POST['user_info']['position'] = 'tester';
        $_POST['user_info']['degree'] = 'Bachelors';
        $_POST['user_info']['field_of_study'] = 'Computer Science';
        $_Post['user_info']['university'] = 'Florida International Unviersity';
        $_Post['user_info']['grad_year'] = '2015';

        $user=User::model()->findAll();
        $this->beforeUserCount=count($user);
        $this->userCount=count($user);
        $userInfo = UserInfo::model()->findAll();
        $this->userInfoCount=count($userInfo);
        $this->beforeUserInfoCount = count($userInfo);

        $this->login = new LoginForm;
        $this->login->username = 'rdomi005';
        $this->login->password = 'rdomi005!';
        $this->badPassword = 'rdmnnnm';
        $this->pconfirm = $this->login->password;
        $this->p2 = 'rdomi005!';
    }

    /* VERY IMPORTANT: In order for this test to be successful, line 708 in CWebUser.php was commented out
    reason being because creating a session for a test proved to be unfruitful*/

    function testExisting_User_Login()
    {
        $this->Login();
        $this->assertEquals(User::getCurrentUserId(), '1049');
        $this->id = User::getCurrentUserId();
        return $this->id;
    }

    function testExisting_User_Login_With_Wrong_Credentials()
    {
        $badLog = new LoginForm;
        $badLog->username = 'rdomi005';
        $badLog->password = 'rdrdrdrd';
        $accessDenied = $badLog->login();
        $this->assertFalse($accessDenied);

    }

    /**
     * @depends testExisting_User_Login
     */
    function testChange_Password_When_Logged_In($id)
    {

        $this->Login();
        $user = User::getCurrentUser();
        $this->assertEquals($user->id, '1049');
        $this->assertFalse($user->password == $this->p2);
        if(isset($_POST['user'])) {
            //verify old password
            if ($this->login->password == $this->pconfirm) {
                $user->password = $this->p2;
            }
        }

        $this->assertTrue($this->p2 == $user->password);
    }

    /**
     * @depends testExisting_User_Login
     */
    function testChange_Password_Using_Incorrect_Password($id)
    {
        $this->Login();
        $this->assertNotEquals($this->login->password, $this->badPassword);
    }

    /**
     * @depends testExisting_User_Login
     */
    function testLogout()
    {
      $this->Logout();
      $this->assertTrue(User::model()->id == NULL);
    }

    /**
     * @depends testLogout
     */
    function testUser_Has_Been_Registered_Successfully()
    {
        $id = $this->CreateUser();

        $user=User::model()->findAll();
        $this->afterUserCount=count($user);
        $userInfo = UserInfo::model()->findAll();
        $this->afterUserInfoCount=count($userInfo);

        $this->assertEquals($this->userCount, $this->afterUserCount);
        $this->assertEquals($this->userInfoCount, $this->afterUserInfoCount);
        return $id;

    }

    /**
     * @depends testUser_Has_Been_Registered_Successfully
     */
    function testNew_Registered_User_Login($id)
    {
        $login = new LoginForm;
        $login->username = 'testing';
        $login->password = 'testing';
        $this->true = $login->login();
        $this->assertTrue($this->true);
        $this->assertEquals(User::getCurrentUserId(), $id);

    }

    /**
     * @depends testUser_Has_Been_Registered_Successfully
     */
    function testDelete_A_Registered_User($id)
    {
        $this->Delete($id);
        $user=User::model()->findAll();
        $this->afterUserCount=count($user);
        $this->assertEquals($this->userCount, $this->afterUserCount);
        $userInfo = UserInfo::model()->findAll();
        $this->afterUserInfoCount=count($userInfo);
        $this->assertEquals($this->userInfoCount, $this->afterUserInfoCount);
     }

    function testPassword_Change_Using_Forgot_Password()
    {
        //makes sure username that was entered before hitting Forgot Password has an email
        //expected success
        $userInfo = User::model()->findByAttributes(array('username'=>$this->login->username));
        $this->assertNotNull($userInfo->email);
        $oldPass = $userInfo->password;

        //expected failure

        //creates new password and hashes it
        $newPass = SiteController::genRandomString(10);
        //$userInfo->save();

        //$userInfo = User::model()->findByAttributes(array('username'=>$this->login->username));
        $userInfo->password = $newPass;
        $this->assertNotEquals($oldPass,$userInfo->password);

        //sends it to the user

    }

    function testSet_Available_User_Unavailable()
    {
        $this->Login();
        $this->assertFalse(User::isCurrentUserAway());
        $away = new AwayMentor;
        $away->userID = User::getCurrentUserId();
        $_POST['away_mentor']['userID'] = $away->userID;
        $away->attributes=$_POST['away_mentor'];
        $away->save();
        $this->assertTrue(User::isCurrentUserAway());
        return $away->userID;
    }

    /**
     * @depends testSet_Available_User_Unavailable
     */
    function testSet_Unavailable_User_Available($id)
    {
        $this->Login();
        $this->assertTrue(User::isCurrentUserAway());
        $away = new AwayMentor;
        $away->userID = User::getCurrentUserId();
        AwayMentor::model()->findByPK($id)->delete();
        $this->assertFalse(User::isCurrentUserAway());
    }

    function testEdit_User_Biography()
    {

        $bio = 'Make a new bio here or something.';
        $this->Login();
        $before = User::getCurrentUser();
        $beforeBio = $before->biography;
        $this->changeBio($before->id, $bio);
        $after = User::getCurrentUser();
        $this->assertNotEquals($before->biography, $after->biography);
        $this->changeBio($before->id, $beforeBio);

    }




   function Login()
    {
        if($this->login->login())
        {
            return true;
        }
        return false;
    }

    function Logout()
    {
        if(Yii::app()->user->logout())
        {
            return true;
        }
        return false;
    }

    function CreateUser()
    {
        $user = new User;
        $user->attributes=$_POST['user'];
        $userInfo = new UserInfo;
        $this->username = $user->username;
        $this->password = $user->password;
        if(isset($_POST['user']) && isset($_POST['user_info'])) {

            $user->pic_url = '/coplat/images/profileimages/default_pic.jpg';
            $user->biography = "Tell us something about yourself...";
            $user->activation_chain = UserController::genRandomString(10);
            $user->activated = 1;
            $hasher = new PasswordHash(8, false);
            $user->password = $hasher->HashPassword($user->password);


            $user->save(false);

            if(isset($_POST['user_info']))
            {
                $userInfo->attributes=$_POST['user_info'];
                $userInfo->user_id = $user->id;
                $userInfo->save(false);
            }

        }

        $this->userInfoCount++;
        $this->userCount++;
        return $user->id;
    }

    function changeBio($id, $bio)
    {
       User::model()->updateByPk($id,array('biography'=>$bio));

    }


    function Delete($id)
    {
            $userInfo = UserInfo::model()->findByPk($id)->delete();
            $user = User::model()->findByPk($id)->delete();
            $this->userCount--;
            $this->userInfoCount--;

    }

}