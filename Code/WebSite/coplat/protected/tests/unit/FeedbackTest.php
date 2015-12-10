<?php
/**
 * Created by PhpStorm.
 * User: Ricky
 * Date: 10/22/2015
 * Time: 2:03 PM
 */
class FeedbackTest extends CDbTestCase
{
    //public $fixtures=array('feedback'=>'Feedback',);
    protected $feedback_id;
    protected $id;
    protected $message;
    protected $dbcount;

    public $fixtures=array(
        'feedback' => 'feedback',
            );

    protected function setup()
    {
        parent::setUp();
        $_POST['feedback']['user_id'] = 8;
        $_POST['feedback']['subject'] = 'test';
        $_POST['feedback']['description'] = 'test';
        $_POST['feedback']['id'] = 17;


        $feedback=Feedback::model()->findAll();
        $this->dbcount=count($feedback);

    }

    function Create()
    {
        $feedback= new Feedback;
        $feedback->attributes=$_POST['feedback'];
        if ($feedback->save()){
            $this->id = $feedback->id;
            $this->feedback_id=$feedback->user_id;
            $this->message=$feedback->description;
        }
        $this->dbcount++;
    }

    function testAfterCreate()
    {
        $this->Create();
        $feedback=Feedback::model()->findAll();
        $this->assertEquals($this->dbcount, count($feedback));

        $feed = Feedback::model();
        $trips = $feed->getCommandBuilder()
            ->createFindCommand($feed->tableSchema, $feed->dbCriteria)
            ->queryAll();
        $ar=array();
        foreach ($feedback as $f)
        {
            $p = basename ($f->id);
            $ar[($p-1)]=$f->attributes;
        }
        $this->assertEquals($ar, $trips);

    }

    function Delete()
    {
        if($this->id)
        {
            $feedback=Feedback::model()->findByPK($this->id)->delete();
            $this->dbcount--;
        }
    }

    function testAfterDelete()
    {
        $this->Create();
        $this->Delete();
        $feedback=Feedback::model()->findAll();
        $this->assertEquals($this->dbcount, count($feedback));
    }

}