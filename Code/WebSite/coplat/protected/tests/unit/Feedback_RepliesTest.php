<?php
/**
 * Created by PhpStorm.
 * User: Ricky
 * Date: 10/22/2015
 * Time: 6:15 PM
 */
class Feedback_RepliesTest extends CDbTestCase
{
    //public $fixtures=array('feedback'=>'Feedback',);
    protected $feed_id;
    protected $id;
    protected $reply;
    protected $dbcount;

    public $fixtures=array(
        'replies' => 'feedback_replies',
    );

    protected function setup()
    {
        parent::setUp();
        $_POST['feedback_replies']['user_id'] = '8';
        $_POST['feedback_replies']['feed_id'] = '2';
        $_POST['feedback_replies']['reply'] = 'test';
        $_POST['feedback_replies']['id'] = '17';


        $reply=Feedback_Replies::model()->findAll();
        $this->dbcount=count($reply);

    }

    function Create()
    {
        $replies = new Feedback_Replies;
        $replies->attributes=$_POST['feedback_replies'];
        if ($replies->save()){
            $this->id = $replies->id;
            $this->feed_id=$replies->feed_id;
            $this->reply=$replies->reply;
        }
        $this->dbcount++;
    }

    function testAfterCreate()
    {
        $this->Create();
        $reply=Feedback_Replies::model()->findAll();
        $this->assertEquals($this->dbcount, count($reply));

        $feed = Feedback_Replies::model();
        $trips = $feed->getCommandBuilder()
            ->createFindCommand($feed->tableSchema, $feed->dbCriteria)
            ->queryAll();
        $ar=array();
        foreach ($reply as $f)
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
            $reply=Feedback_Replies::model()->findByPK($this->id)->delete();
            $this->dbcount--;
        }
    }

    function testAfterDelete()
    {
        $this->Create();
        $this->Delete();
        $reply=Feedback_Replies::model()->findAll();
        $this->assertEquals($this->dbcount, count($reply));
    }

}