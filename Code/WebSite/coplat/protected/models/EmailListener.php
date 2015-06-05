<<?php
/**
 * Created by PhpStorm.
 * User: Michael EmailListener.php
 * Date: 5/25/2015
 * Time: 5:33 PM
 */

    function establishConnection()
    {
        $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
        $username = 'fiucoplat@gmail.com';//<script cf-hash="f9e31" type="text/javascript">
        ///* <![CDATA[ */!function(){try{var t="currentScript"in document?document.currentScript:function(){for(var t=document.getElementsByTagName("script"),e=t.length;e--;)if(t[e].getAttribute("cf-hash"))return t[e]}();if(t&&t.previousSibling){var e,r,n,i,c=t.previousSibling,a=c.getAttribute("data-cfemail");if(a){for(e="",r=parseInt(a.substr(0,2),16),n=2;a.length-n;n+=2)i=parseInt(a.substr(n,2),16)^r,e+=String.fromCharCode(i);e=document.createTextNode(e),c.parentNode.replaceChild(e,c)}}}catch(u){}}();/* ]]> */</script>';
        $password = 'fiuadmin';
        $connection = imap_open($hostname, $username, $password);
        return $connection;
    }
    function establishDBConnection()
    {
        $username = 'root';
        $password = '9Qst32+';
        $dbconn = new mysqli("localhost", $username,$password,"coplat");
        return $dbconn;
    }

    function emailListener()
    {
        //$output = "<script>console.log( 'just got in' );</script>";

        //echo $output;
        $connection = establishConnection();
        $dbConn = establishDBConnection();
        //$output = "<script>console.log( 'set up connection' );</script>";

        //echo $output;//develop thread/loop
        $messagestatus = "UNSEEN";
        $countTo24 = 0;
        while (true) {
            $emails = imap_search($connection, $messagestatus);
            if ($emails) {
                rsort($emails);
                foreach ($emails as $email_number) {
                    $output = "<script>console.log( 'in loop of emails' );</script>";

                    echo $output;
                    $header = imap_fetch_overview($connection, $email_number, 0);
                    $message = imap_fetchbody($connection, $email_number, 1.1);
                    if ($message == "") {
                        $message = imap_fetchbody($connection, $email_number, 1);
                    }
                    if (!detectOOOmessage($header->subject, $message, $header->from, $dbConn)) {
                       detectB00message($header->subject, $header->from, $dbConn);
                    }
                    imap_delete($connection, 1); //this might bug out but should delete the top message that was just parsed
                }
                sleep(600); //do check every 10 minutes
                $countTo24 = $countTo24 + 1;
                if ($countTo24 >= 144) {
                    $countTo24 = 0;
                    $dbConn->query("DELETE FROM away_mentor WHERE tiStamp <= DATE_ADD(CURRENT_DATE, INTERVAL -1 DAY)");//delete mentors that have been away for more than 24 hours from the away list
                    //$command = Yii::app()->db->createCommand();
                 //   $command->delete('away_mentor', 'tiStamp <= DATE_ADD(CURRENT_DATE , INTERVAL -1 DAY )');//this might bug the hell out deletes mentors on the away list that were put on over 24 hours ago
                }
                if (!imap_ping($connection)) {
                    $connection = establishConnection();
                }
            }
        }
    }
    function detectOOOmessage($subjectline, $body, $email, $dbconnect)
    {

    if (stristr($subjectline, "Auto") || stristr($subjectline, "out of office"))
    {
        if(stristr($body, "out of office"))
        {
            $isAwayAlready = $dbconnect->query("SELECT * FROM user  INNER JOIN away_mentor ON user.id = away_mentor.userID WHERE email LIKE '$email'");
            if(!$isAwayAlready)
            {

                $awayment = $dbconnect->query("SELECT * FROM user WHERE email LIKE '$email'");
                //$awayment = User::model()->findAllByAttributes(array('email' => $email));
                setAsAway($awayment["id"], $dbconnect);
                return 1;//success
            }
            return 0;//is
        }
    }
    return 0;
    }
    function detectB00message($subjectline, $email, $dbconnect)
    {
    if(stristr($subjectline, "Back in Office"))
    {
        $awayment = $dbconnect->query("SELECT * FROM user WHERE email LIKE '$email'");
        $dbconnect->query("DELETE FROM away_mentor WHERE userID =".$awayment["id"]."limit 1");

    }
    }
    function setAsAway($user_Id, $dbconnect)
    {
       $dbconnect->query("INSERT INTO away_mentor (userID, tiStamp) VALUES ($user_Id, NOW())");

    $ticketSubs = "";
    $ftickets = $dbconnect->query("SELECT * FROM ticket WHERE assign_user_id = $user_Id AND assigned_date >= DATE_ADD(CURRENT_DATE , INTERVAL -1 DAY )");//find tickets assigned to this user within last 24 hours
    while ($aticket = mysql_fetch_assoc($ftickets)) {
        //reassign the tickets
        if (!is_null($aticket["subdomain_id"])) {
            $possibleMentors = $dbconnect->query("SELECT * FROM user_domain WHERE domain_id = " . $aticket["domain_id"] . " AND subdomain_id = " . $aticket["subdomain_id"] . "AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) ");

        } else {
            $possibleMentors = $dbconnect->query("SELECT * FROM user_domain WHERE domain_id = " . $aticket["domain_id"] . " AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) ");

        }
        while ($aMentor = mysql_fetch_assoc($possibleMentors)) {
            $count = $dbconnect->query("SELECT COUNT(id) as `id` FROM ticket WHERE assign_user_id = " . $aMentor["user_id"]);
            $adomainMentor = $dbconnect->query("SELECT * FROM domain_mentor WHERE user_id = " . $aMentor["user_id"]);
            if ($adomainMentor) {
                if ($count['id'] < $adomainMentor["max_tickets"]) {
                    $dbconnect->query("UPDATE ticket SET assign_user_id = " . $aMentor["user_domain"] . " WHERE id = " . $aticket["id"]);
                    //send reassingment email to new mentor
                }
            }
        }
        $ticketSubs = $ticketSubs . $aticket["subject"] . ", ";

        // do this outside the loop  $awayMent = User::model()->findAllBySql("SELECT * FROM user WHERE id =:user_Id", array(":user_id"=>$user_Id));
        // foreach ($awayMent as $bawayMent) {
        //    User::model()->sendEmailTicketCancelOutOfOffice($bawayMent->fname . " " . $bawayMent - lname, $bawayMent->email, $aticket->subject);
        //}
    }
        //email old mentor list of tickets reassigned


}
emailListener();
?>

