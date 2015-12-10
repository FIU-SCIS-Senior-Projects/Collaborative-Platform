<?php


/**
 * Created by PhpStorm.
 * User: Ricky
 * Date: 10/5/2015
 * Time: 3:52 PM
 */

class DbTest extends CTestCase
{
    //public $fixtures=array('feedback'=>'Feedback',);
    protected $feedback_id;
  protected function setup()
  {
      parent::setUp();
      $_POST['feedback']['user_id'] = 8;
      $_POST['feedback']['subject'] = 'test 3';
      $_POST['feedback']['description'] = 'test 3';
      $_POST['feedback']['id'] = 17;
  }

    public function testInsert(){
        $feedback= new Feedback;
        $feedback->attributes=$_POST['feedback'];
        if ($feedback->save()){
            $this->feedback_id=$feedback->user_id;
            $this->assertEquals($_POST['feedback'], $feedback->attributes);
        }
    }

    function testDB()
    {
        $feedback=Feedback::model()->findAll();
        $this->assertEquals(4,count($feedback));
    }

}
