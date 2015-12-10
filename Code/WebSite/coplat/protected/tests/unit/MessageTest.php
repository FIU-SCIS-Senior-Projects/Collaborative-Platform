<?php
/**
 * Created by PhpStorm.
 * User: Ricky
 * Date: 12/1/2015
 * Time: 10:16 PM
 */

class MeetingsTest extends CDbTestCase
{
    function setUp()
    {

    }

    public function testSend_Message()
    {
        $id = $this->createMessage();
        $this->assertNotNull($id);
        $this->deleteMessage($id);

    }

    public function testReply_To_Messages()
    {
        $id = $this->createReply();
        $this->assertNotNull($id);
        return $id;
    }

    /**
     * @depends testReply_To_Messages
     */
    public function testDelete_Messages($id)
    {
        $this->deleteMessage($id);
        $this->assertNull(Message::model()->findByPk($id));
    }

    public function createMessage()
    {
        $_POST['message']['receiver'] = 'user1';
        $_POST['message']['sender'] = 'user2';
        $_POST['message']['subject'] = 'Reply to my message';
        $_POST['message']['message'] = 'Reply to me!!!!';
        $_POST['message']['created_date'] = new CDbExpression('NOW()');

        $message = new Message;
        $message->attributes=$_POST['message'];
        $message->save();

        return $message->id;

    }

    public function createReply()
    {
        $_POST['message']['receiver'] = 'user2';
        $_POST['message']['sender'] = 'user1';
        $_POST['message']['message'] = 'Re: Reply to me!!!!';
        $_POST['message']['subject'] = 'This is my reply!';
        $_POST['message']['created_date'] = new CDbExpression('NOW()');

        $message = new Message;
        $message->attributes=$_POST['message'];
        $message->save();

        return $message->id;
    }

    public function deleteMessage($id)
    {
        $message = Message::model()->findByPk($id)->delete();
    }



}