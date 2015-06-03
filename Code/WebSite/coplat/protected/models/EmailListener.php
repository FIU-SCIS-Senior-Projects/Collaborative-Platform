<<?php
/**
 * Created by PhpStorm.
 * User: Michael EmailListener.php
 * Date: 5/25/2015
 * Time: 5:33 PM
 */
class EmailListener extends CActiveRecord  //ineed to attach the running of this class to some thing to make sure it does, cause it doo
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return 'email_listener';
    }
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pid', 'required'),
            array('pid', 'integerOnly'=>true),
            array('userID', 'safe', 'on'=>'search'),
        );
    }
    public function attributeLabels()
    {
        return array(
            'pid' => 'Process ID',

        );
    }
 //   public function establishConnection()
   // {
     //   $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
       // $username = 'fiucoplat@gmail.com';
       // $password = 'fiuadmin';
      ///  $connection = imap_open($hostname, $username, $password) or die ("Cannot connect to gmail:" . imap_last_error());
 //       return $connection;
 //   }

//    public function emailListener()
//    {
  //      $connection = establishConnection();
 //       //develop thread/loop
  //      $awayment = new AwayMentor();
  //      $messagestatus = "UNSEEN";
   //     $countTo24 = 0;
   //     while (true) {
   //         $emails = imap_search($connection, $messagestatus);
   //         if ($emails) {
    //            rsort($emails);
   //             foreach ($emails as $email_number) {
   //                 $header = imap_fetch_overview($connection, $email_number, 0);
   //                 $message = imap_fetchbody($connection, $email_number, 1.1);
   //                 if ($message == "") {
   //                     $message = imap_fetchbody($connection, $email_number, 1);
//                    if (!$awayment->detectOOOmessage($header->subject, $message, $header->from)) {
    //                    $awayment->detectB00message($header->subject, $header->from);
   //                 }
   //                 imap_delete($connection, 1); //this might bug out but should delete the top message that was just parsed
   //             }
   //             sleep(600); //do check every 10 minutes
   //             $countTo24 = $countTo24 +1;
   //             if ($countTo24>=144)
   //             {
   //                 $countTo24 = 0;
   //                 $command = Yii::app()->db->createCommand();
   //                 $command->delete('away_mentor', 'tiStamp <= DATE_ADD(CURRENT_DATE , INTERVAL -1 DAY )');//this might bug the hell out deletes mentors on the away list that were put on over 24 hours ago
    //            }
     //           if (!imap_ping($connection)) {
       //             $connection = establishConnection();
        //        }
         //   }
      //  }
   // }
    public function setupKids()
    {
        $pid1 = pcntl_fork();
        if($pid1)
        {
            return 1;//success and go back to what you were doing;
        }
        if($pid1==-1)
        {
            return 0;//didnt work;
        }
        $pid1 = pcntl_fork();
        if($pid1)
        {
            if($pid1 >0) {
                $command = Yii::app()->db->createCommand();
                $command->insert('email_listener', array("pid" => $pid1));//writes to the database letting it know that there SHOULD be a email listener running

                pcntl_waitpid($pid1, $kidStatus);//will just wait untill child dies
                $command = Yii::app()->db->createCommand();
                $command->delete('email_listener', 'pid=:pid1', array('pid1' => $pid1));//removes the child pid from the database letting it know that there DEFINETELY ISNT a child process running;
            }
            if($pid1 = -1)
            {
                exit();
            }
        }
        else{
            $output = "<script>console.log( 'In grandchild' );</script>";

            echo $output;
            exit();
          //  $stat = EmailListener::emailListener();
        }
    }
    public function getStatus()
    {
        $am = AwayMentor::model()->findAllBySql("SELECT * FROM email_lisetner");
        if ($am)
        {
            return 1;
        }
        else{
            $stat = EmailListener::setupKids();
            return $stat;
        }
    }
}

