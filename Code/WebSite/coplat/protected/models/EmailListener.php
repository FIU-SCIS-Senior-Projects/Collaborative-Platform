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
    $dbconn = new mysqli("localhost", $username, $password, "coplat");
    return $dbconn;
}

function emailListener()
{
    //$output = "<script>console.log( 'just got in' );</script>";

    //echo $output;
    $connection = establishConnection();
    $dbConn = establishDBConnection();
    //$output = "<script>console.log( 'set up connection' );</script>";
    //$dbConn->query("INSERT INTO away_mentor (userID, tiStamp) VALUES (99897, NOW())");//test the db connection
    //echo $output;//develop thread/loop
    $messagestatus = "UNSEEN";
    $countTo24 = 0;
        echo "in check loop";
        $emails = imap_search($connection, $messagestatus);
        if ($emails) {
            rsort($emails);
            foreach ($emails as $email_number) {
                echo "in email loop";
                $header = imap_headerinfo($connection, $email_number);
                $message = imap_fetchbody($connection, $email_number, 1.1);
                if ($message == "") {
                    $message = imap_fetchbody($connection, $email_number, 1);
                }
                $emailaddress = substr($header->senderaddress, stripos($header->senderaddress, "<")+1, stripos($header->senderaddress, ">")- (stripos($header->senderaddress, ">")+1));
                if (!detectOOOmessage($header->subject, $message, $emailaddress)) {
                    detectB00message($header->subject, $emailaddress);
                }
                imap_delete($connection, 1); //this might bug out but should delete the top message that was just parsed
            }
        }

        $dbConn->query("DELETE FROM away_mentor WHERE tiStamp <= DATE_ADD(CURRENT_DATE, INTERVAL -1 DAY) limit 1");//delete mentors that have been away for more than 24 hours from the away list
        while (mysql_affected_rows()>0)
        {
            $dbConn->query("DELETE FROM away_mentor WHERE tiStamp <= DATE_ADD(CURRENT_DATE, INTERVAL -1 DAY) limit 1");
        }
}

function detectOOOmessage($subjectline, $body, $email)
{
    if (stristr($subjectline, "Auto") || stristr($subjectline, "out of office")) {
        if (stristr($body, "out of office")) {
            echo "it found an out of office message";
            $dbconnect = establishDBConnection();
            $isAwayAlready = $dbconnect->query("SELECT * FROM user  INNER JOIN away_mentor ON user.id = away_mentor.userID WHERE email LIKE '$email'");
            //if (!$isAwayAlready) {
                echo "the mentor isnt away so it should try to set them as away";
                $awayment1 = $dbconnect->query("SELECT * FROM user WHERE email LIKE '$email'");
                //$awayment = User::model()->findAllByAttributes(array('email' => $email));
                $awayment = $awayment1->fetch_assoc();
                echo "calling the setAsAway function with " .$awayment["id"];
                setAsAway($awayment["id"]);
                return 1;//success
            //}
            return 0;//is
        }
    }
    return 0;
}

function detectB00message($subjectline, $email)
{
    $dbconnect = establishDBConnection();
    if (stristr($subjectline, "Back in Office")) {
        $awayment1 = $dbconnect->query("SELECT * FROM user WHERE email LIKE '$email'");
        $awayment = $awayment1->fetch_assoc();
        $dbconnect->query("DELETE FROM away_mentor WHERE userID =" . $awayment["id"] . "limit 1");

    }
}

function setAsAway($user_Id)
{
    $dbconnect = establishDBConnection();
    $dbconnect->query("INSERT INTO away_mentor (userID, tiStamp) VALUES ($user_Id, NOW())");

    $ticketSubs = "";
    $ftickets = $dbconnect->query("SELECT * FROM ticket WHERE assign_user_id = $user_Id AND assigned_date >= DATE_ADD(CURRENT_DATE , INTERVAL -1 DAY )");//find tickets assigned to this user within last 24 hours
    while ($aticket = $ftickets->fetch_assoc()) {
        //reassign the tickets
        if (!is_null($aticket["subdomain_id"])) {
            $sql = "SELECT * FROM user_domain WHERE domain_id = " . $aticket["domain_id"] . " AND subdomain_id = " . $aticket["subdomain_id"] . " AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) ";
            //$possibleMentors = $dbconnect->query("SELECT * FROM user_domain WHERE domain_id = " . $aticket["domain_id"] . " AND subdomain_id = " . $aticket["subdomain_id"] . "AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) ");

        } else {
            $sql = "SELECT * FROM user_domain WHERE domain_id = " . $aticket["domain_id"] . " AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) ";
            //$possibleMentors = $dbconnect->query("SELECT * FROM user_domain WHERE domain_id = " . $aticket["domain_id"] . " AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) ");

        }
        echo $sql;
        $possibleMentors = $dbconnect->query($sql);
        if ($possibleMentors->num_rows<0)
        {
            echo"no result";
        }
        else {
            while ($aMentor = $possibleMentors->fetch_assoc()) {
                $count1 = $dbconnect->query("SELECT COUNT(id) as `id` FROM ticket WHERE assign_user_id = " . $aMentor["user_id"]);
                $adomainMentor1 = $dbconnect->query("SELECT * FROM domain_mentor WHERE user_id = " . $aMentor["user_id"]);
                $count = $count1->fetch_assoc();
                $adomainMentor = $adomainMentor1->fetch_assoc();
                if ($adomainMentor) {
                    if ($count['id'] < $adomainMentor["max_tickets"]) {
                        $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = " . $aMentor["user_id"] . " WHERE id = " . $aticket["id"]);
                        $mentorb1 = $dbconnect->query("SELECT * FROM user WHERE id = " . $aMentor["user_id"]);
                        $mentorb = $mentorb1->fetch_assoc();
                        sendTicketReassignment($mentorb["email"], $aticket["subject"]);
                    }
                } else { //not registered as having a max ticket.
                    $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = " . $aMentor["user_id"] . " WHERE id = " . $aticket["id"]);
                    $mentorb1 = $dbconnect->query("SELECT * FROM user WHERE id = " . $aMentor["user_id"]);
                    $mentorb = $mentorb1->fetch_assoc();
                    sendTicketReassignment($mentorb["email"], $aticket["subject"]);
                }
            }
        }
        $ticketSubs = $ticketSubs . $aticket["subject"] . ", ";
        // do this outside the loop  $awayMent = User::model()->findAllBySql("SELECT * FROM user WHERE id =:user_Id", array(":user_id"=>$user_Id));
        // foreach ($awayMent as $bawayMent) {
        //    User::model()->sendEmailTicketCancelOutOfOffice($bawayMent->fname . " " . $bawayMent - lname, $bawayMent->email, $aticket->subject);
        //}
    }
    $mentor2 = $dbconnect->query("SELECT * FROM user WHERE id = $user_Id");
    $mentor = $mentor2->fetch_assoc();
    sendTicketCancelEmail($mentor["email"],$ticketSubs);

}
function sendTicketCancelEmail($toEmail, $subjectlines)
{
    $subject = "Out of Office Response";
    $body = "Collaborative Platform received an Automated Out of office response from this email.\n
             We have set you as out of office and you will no longer be assigned tickets automatically, The tickets : " . $subjectlines . "
             Have been reassigned to another mentor\n If this was done in error or you are back in office send an email to fiucoplat@gmail.com\n with \"Back in office\" in the subject and the system will take you off of the away list, otherwise the system will take you off of the away list automatically after 24 hours\n\nThank you for all your help making Collaborative Platform great";
    $headers = "From: fiucoplat@gmail.com\r\n".
        "Reply-To: fiucoplat@gmail.com\r\n";
    $cc = null;
    $bcc = null;
    $return_path = "fiucoplat@gmail.com";
//send the email using IMAP
    $a = imap_mail($toEmail, $subject, $body, $headers, $cc, $bcc, $return_path);
    echo "Email sent!<br />";
}
function sendTicketReassignment($toEmail, $subjectl)
{
    $subject = "Ticket Assigned";
    $body = "Collaborative Platform has assigned you a new ticket " . $subjectl . "that was previously assigned to another mentor.\n Thank you for Making Collaborative Platform Great";
    $headers = "From: fiucoplat@gmail.com\r\n".
        "Reply-To: fiucoplat@gmail.com\r\n";
    $cc = null;
    $bcc = null;
    $return_path = "fiucoplat@gmail.com";
//send the email using IMAP
    $a = imap_mail($toEmail, $subject, $body, $headers, $cc, $bcc, $return_path);
    echo "Email sent!<br />";
}
function checkPriorityElapseTickets()
{
    //ADD IN IF ITS BEEN REASSIGNED >3 TIMES ASSIGN TO ADMIN FOR MANUAL REASSIGN
    $dbconnect = establishDBConnection();
    $prio = $dbconnect->query("Select * FROM priority");
    while ($prios = $prio->fetch_assoc())
    {
        switch ($prios["id"])
        {
            case 1:
                $high = $prios["reassignHours"] * -1;
                break;
            case 2:
                $med = $prios["reassignHours"] * -1;
                break;
            case 3:
                $low = $prios["reassignHours"] * -1;
                break;
        }
    }
    $ticketr = $dbconnect->query("Select * FROM ticket where ((priority_id = 1 AND assigned_date <= DATE_ADD(CURRENT_DATE, INTERVAL $high HOUR)) OR (priority_id = 2 AND assigned_date <= DATE_ADD(CURRENT_DATE, INTERVAL $med HOUR)) OR (priority_id = 3 AND assigned_date <= DATE_ADD(CURRENT_DATE, INTERVAL $low HOUR))) AND id NOT IN (SELECT ticket_id as id FROM ticket_events where event_type_id = 5) ");
    //select all tickets without a ticket event 5 or MAYBE 8 (ask juan) over their respective priorities VERY COMPLICATED SQL query
    // reassign tickets
    if($ticketr->num_rows>0) {
        while ($aticket = $ticketr->fetch_assoc()) {
            $mentor = $dbconnect->query("Select * from user WHERE id = ".$aticket["assign_user_id"]);
            $aMentor = $mentor->fetch_assoc();
            sendTicketCancelOutOfTime($aMentor["email"], $aticket["subject"]);
            $dbconnect->query("INSERT INTO previous_mentors (user_id, ticket_id) VALUES(".$aMentor["id"] .", ".$aticket["id"]. ")");
            if (!is_null($aticket["subdomain_id"])) {
                $sql = "SELECT * FROM user_domain WHERE domain_id = " . $aticket["domain_id"] . " AND subdomain_id = " . $aticket["subdomain_id"] . " AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) AND user_id not in (select user_id as user_id from previous_mentors where ticket_id = ". $aticket["id"].")";
                //$possibleMentors = $dbconnect->query("SELECT * FROM user_domain WHERE domain_id = " . $aticket["domain_id"] . " AND subdomain_id = " . $aticket["subdomain_id"] . "AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) ");

            } else {
                $sql = "SELECT * FROM user_domain WHERE domain_id = " . $aticket["domain_id"] . " AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) AND user_id not in (select user_id as user_id from previous_mentors where ticket_id = ". $aticket["id"].")";
                //$possibleMentors = $dbconnect->query("SELECT * FROM user_domain WHERE domain_id = " . $aticket["domain_id"] . " AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) ");

            }
            //echo $sql;
            $possibleMentors = $dbconnect->query($sql);
            if ($possibleMentors->num_rows<=0)
            {
              //assign to admin do this later;
            }
            else {
                while ($aMentor = $possibleMentors->fetch_assoc()) {
                    $count1 = $dbconnect->query("SELECT COUNT(id) as `id` FROM ticket WHERE assign_user_id = " . $aMentor["user_id"]);
                    $adomainMentor1 = $dbconnect->query("SELECT * FROM domain_mentor WHERE user_id = " . $aMentor["user_id"]);
                    $count = $count1->fetch_assoc();
                    $adomainMentor = $adomainMentor1->fetch_assoc();
                    if ($adomainMentor) {
                        if ($count['id'] < $adomainMentor["max_tickets"]) {
                            $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = " . $aMentor["user_id"] . " WHERE id = " . $aticket["id"]);
                            $mentorb1 = $dbconnect->query("SELECT * FROM user WHERE id = " . $aMentor["user_id"]);
                            $mentorb = $mentorb1->fetch_assoc();
                            sendTicketReassignment($mentorb["email"], $aticket["subject"]);
                        }
                    } else { //not registered as having a max ticket.
                        $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = " . $aMentor["user_id"] . " WHERE id = " . $aticket["id"]);
                        $mentorb1 = $dbconnect->query("SELECT * FROM user WHERE id = " . $aMentor["user_id"]);
                        $mentorb = $mentorb1->fetch_assoc();
                        sendTicketReassignment($mentorb["email"], $aticket["subject"]);
                    }
                }
            }
        }
    }
}
function sendTicketCancelOutOfTime($toEmail, $subjectLine)
{
    $subject = "Out of Office Response";
    $body = "Due to the inactivity on the ticket $subjectLine, the ticket has been reassigned.\n\nThank you for all your help making Collaborative Platform great";
    $headers = "From: fiucoplat@gmail.com\r\n".
        "Reply-To: fiucoplat@gmail.com\r\n";
    $cc = null;
    $bcc = null;
    $return_path = "fiucoplat@gmail.com";
//send the email using IMAP
    $a = imap_mail($toEmail, $subject, $body, $headers, $cc, $bcc, $return_path);
    echo "Email sent!<br />";
}
//need to come up with a table for previous mentors--done
//WHEN ASSIGNING TICKETS TO MENTORS JOIN WITH TICKET ONLY WITH ID AND ASSIGNED DATE AND SORT BY ASSIGNED DATE. DONE WOO.
//emailListener();
checkPriorityElapseTickets();

?>

