<?php
/**
 * Created by PhpStorm.
 * User: Ricky
 * Date: 11/11/2015
 * Time: 9:33 PM
 */

class SeleniumTest extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser('*chrome');
        $this->setBrowserUrl('http://localhost/coplat/index.php/site/login');
    }

    public function testTitle()
    {
        $this->Login();
        $this->assertTextPresent("Ricky Dominguez Dashboard");

    }

    /**
     * @depends testTitle
     *
     */

    public function testLogout()
    {
        $this->Login();
        $this->Logout();
        $this->assertTextPresent("Welcome to the Collaborative Platform");
    }

    public function Login()
    {
        $this->open('http://localhost/coplat/index.php/site/login');
        $this->type("id=LoginForm_username", "");
        $this->type("id=LoginForm_password", "");
        $this->click("name=yt0");
        $this->clickAndWait("name=yt0");
    }

    public function Logout()
    {
        $this->click("link=Profile");
        $this->clickAndWait("link=Logout (rdomi005)");
    }

}