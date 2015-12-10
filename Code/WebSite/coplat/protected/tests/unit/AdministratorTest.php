<?php
/**
 * Created by PhpStorm.
 * User: Ricky Dominguez
 * Date: 11/1/2015
 * Time: 9:17 PM
*/

/**This unit test tests the Administrator model
 * and views to make sure that the classes are in order*/

class AdministratorTest extends CDbTestCase
{
    //public $fixtures=array('feedback'=>'Feedback',);
    protected $user_id;
    protected $dbcount;
    protected $int = 0;

    //create an admin
    //retrieve all current admin ID's
    //count them and store the variable
    protected function setup()
    {
        parent::setUp();
        $_POST['administrator']['user_id'] = 8;

        $admin=Administrator::model()->findAll();
        $this->dbcount=count($admin);

    }

    //creates a new admin user then increments the dbcount by 1
    function Create()
    {
        $admin = new Administrator();
        $admin->attributes=$_POST['administrator'];
        if ($admin->save()) {
            $this->user_id=$admin->user_id;
        }
        $this->dbcount++;
    }

    //Tests to make sure that the creation worked.
    function testAfterCreate()
    {
        $this->Create(); //creates admin user
        $admin = Administrator::model()->findAll();
        $this->assertEquals($this->dbcount, count($admin)); //make sure that our dbcount and our database have the same amount of entries

        //Creates a table from the administrator model
        //then breaks the database queries into an array
        //compares the values on both to ensure theyre the same.
        $administrator = Administrator::model();
        $trips = $administrator->getCommandBuilder()
            ->createFindCommand($administrator->tableSchema, $administrator->dbCriteria)
            ->queryAll();
        $ar = array();
        foreach ($admin as $f) {
            $p = $this->int;
            $this->int++;
            $ar[($p)] = $f->attributes;
        }
        $this->assertEquals($ar, $trips);
        $this->Delete(); //deletes the entry we made to reset the database
    }

    //Deletes the entry we hardcoded and sets the count to one lower
    function Delete()
    {
        if($this->user_id)
        {
            $admin=Administrator::model()->findByPk($this->user_id)->delete();
            $this->dbcount--;
        }
    }

    //creates user, deletes it, fetches db entries and makes sure our count is the same
    function testAfterDelete()
    {
        $this->Create();
        $this->Delete();
        $admin=Administrator::model()->findAll();
        $this->assertEquals($this->dbcount, count($admin));
    }

}
?>