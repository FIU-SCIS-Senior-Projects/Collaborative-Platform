<<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 5/25/2015
 * Time: 5:33 PM
 */
/*
 * Sets up the connection to look at the emails on the gmail account fiucoplat@gmail.com
 * and returns the connection
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
/*
 * Sets up the connection to the database that is running serverside
 * and returns the connection
 */
function establishDBConnection()
{
    $username = 'root';
    $password = '9Qst32+';
    $dbconn = new mysqli("localhost", $username, $password, "coplat");
    return $dbconn;
}
/*
 * Uses the email connection and the database connection,
 * Scans the emails on the email connection and then passes the relevant information to the detectOOOmessage
 * and the dectectBIOmessage functions
 * after which it removes the mentors from the away list that have been on the away list for longer than 24 hours
 * allowing them to be assigned tickets again
 */
function emailListener()
{

    $connection = establishConnection();
    $dbConn = establishDBConnection();

    $messagestatus = "UNSEEN";

        $emails = imap_search($connection, $messagestatus);
        if ($emails) {
            rsort($emails);
            foreach ($emails as $email_number) {
               // echo "in email loop";
                $header = imap_headerinfo($connection, $email_number);
                $message = imap_fetchbody($connection, $email_number, 1.1);
                if ($message == "") {
                    $message = imap_fetchbody($connection, $email_number, 1);
                }
                $emailaddress = substr($header->senderaddress, stripos($header->senderaddress, "<")+1, stripos($header->senderaddress, ">")- (stripos($header->senderaddress, ">")+1));
                if (!detectOOOmessage($header->subject, $message, $emailaddress)) {
                    detectBIOmessage($header->subject, $emailaddress);
                }
                imap_delete($connection, 1); //this might bug out but should delete the top message that was just parsed
            }
        }

        $dbConn->query("DELETE FROM away_mentor WHERE tiStamp <= DATE_ADD(NOW(), INTERVAL -1 DAY) limit 1");//delete mentors that have been away for more than 24 hours from the away list
}
/*
 * Scans the subject and body of the email received and if it meets criteria for being a out of office message
 * passes the relevant details to SetasAway
 */
function detectOOOmessage($subjectline, $body, $email)
{
    if (stristr($subjectline, "Auto") || stristr($subjectline, "out of office")) {
        if (stristr($body, "out of office")) {
           // echo "it found an out of office message";
            $dbconnect = establishDBConnection();
            $isAwayAlready = $dbconnect->query("SELECT * FROM user  INNER JOIN away_mentor ON user.id = away_mentor.userID WHERE email LIKE '$email'");
            if ($isAwayAlready->num_rows<=0) {
              //  echo "the mentor isnt away so it should try to set them as away";
                $awayment1 = $dbconnect->query("SELECT * FROM user WHERE email LIKE '$email'");
                //$awayment = User::model()->findAllByAttributes(array('email' => $email));
                $awayment = $awayment1->fetch_assoc();
             //   echo "calling the setAsAway function with " .$awayment["id"];
                setAsAway($awayment["id"]);
                return 1;//success
            }
            return 0;//is
        }
    }
    return 0;
}
/*
 * Scans the subject of the email message and if it meets the criteria removes the mentor from the away list
 */
function detectBIOmessage($subjectline, $email)
{
    $dbconnect = establishDBConnection();
    if (stristr($subjectline, "Back in Office")) {
        $awayment1 = $dbconnect->query("SELECT * FROM user WHERE email LIKE '$email'");
        $awayment = $awayment1->fetch_assoc();
        $dbconnect->query("DELETE FROM away_mentor WHERE userID =" . $awayment["id"] . " limit 1");

    }
}
/*
 * Using the away mentors id it adds them to the away_mentor table on the database no longer allowing them to be
 * assigned tickets.  It then finds all tickets that have been assigned to this mentor and reassigns them to compatible
 * mentors.
 * Upon each ticket assigned it sends an email to the new mentor notifying them of the new ticket, it compiles a list of
 * the tickets that have been removed from the away mentor and sends an email notifying the mentor of the removal
 *
 * And adds a new event to the tickets noting that it has been assigned to a new mentor
 */
function setAsAway($user_Id)
{
    $dbconnect = establishDBConnection();
    $dbconnect->query("INSERT INTO away_mentor (userID, tiStamp) VALUES ($user_Id, NOW())");

    $ticketSubs = "";
    $ftickets = $dbconnect->query("SELECT * FROM ticket WHERE assign_user_id = $user_Id AND assigned_date >= DATE_ADD(NOW() , INTERVAL -1 DAY )");//find tickets assigned to this user within last 24 hours
    while ($aticket = $ftickets->fetch_assoc()) {
      //  echo "a ticket is being looked at from kimora hideki";

        if (!is_null($aticket["subdomain_id"])) {
            $sql = "SELECT * FROM user_domain left join (select assign_user_id, assigned_date from (select * from ticket order by assigned_date desc)x  group by assign_user_id)x on assign_user_id = user_id WHERE domain_id = " . $aticket["domain_id"] . " AND subdomain_id = " . $aticket["subdomain_id"] . " AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) order by assigned_date ASC   ";
            }
        else {
            $sql = "SELECT * FROM user_domain left join (select assign_user_id, assigned_date from (select * from ticket order by assigned_date desc)x  group by assign_user_id)x on assign_user_id = user_id WHERE domain_id = " . $aticket["domain_id"] . " AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) order by assigned_date ASC  ";
            }

        $possibleMentors = $dbconnect->query($sql);
        //if there are no available mentors on the domain associated with the ticket gives the ticket to the admin for
        // manual reassignment
        if ($possibleMentors->num_rows<=0)
        {
           // echo "no possible mentors should assign tickets to admin";
            $ticketSubs = $ticketSubs . $aticket["subject"] . ",\n";
            $dbconnect->query("insert into ticket_events (event_type_id, ticket_id, event_recorded_date, old_value, new_value, comment, event_performed_by_user_id) values (10, ".$aticket["id"].", NOW(), ".$aticket["assign_user_id"].", 5, null, 5)");
            $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = 5 WHERE id = ".$aticket["id"]);//no possible mentor found assign to admin for manual assign.
        }
        else {
            $assigned = 0;
            while ($aMentor = $possibleMentors->fetch_assoc()) {
               // echo"going through posssible mentors";
                $count1 = $dbconnect->query("SELECT COUNT(id) as `id` FROM ticket WHERE assign_user_id = " . $aMentor["user_id"]);
                $adomainMentor1 = $dbconnect->query("SELECT * FROM domain_mentor WHERE user_id = " . $aMentor["user_id"]);
                $count = $count1->fetch_assoc();
                $adomainMentor = $adomainMentor1->fetch_assoc();
                if ($adomainMentor) {
                    if ($count['id'] < $adomainMentor["max_tickets"]) {
                       // echo"this mentor can be assigned new tickets";
                        $dbconnect->query("insert into ticket_events (event_type_id, ticket_id, event_recorded_date, old_value, new_value, comment, event_performed_by_user_id) values (10, ".$aticket["id"].", NOW(), ".$aticket["assign_user_id"].", ".$aMentor["user_id"].", null, 5)");
                        $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = " . $aMentor["user_id"] . " WHERE id = " . $aticket["id"]);
                        $mentorb1 = $dbconnect->query("SELECT * FROM user WHERE id = " . $aMentor["user_id"]);
                        $mentorb = $mentorb1->fetch_assoc();
                        sendTicketReassignment($mentorb["email"], $aticket["subject"]);
                        $assigned =1;
                        // echo"assinged new ticket to mentor";
                        break;
                    }
                } else { //not registered as having a max cket.
                 //   echo"mentor available not on assigned ticket";
                    $dbconnect->query("insert into ticket_events (event_type_id, ticket_id, event_recorded_date, old_value, new_value, comment, event_performed_by_user_id) values (10, ".$aticket["id"].", NOW(), ".$aticket["assign_user_id"].", ".$aMentor["user_id"].", null, 5)");
                    $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = " . $aMentor["user_id"] . " WHERE id = " . $aticket["id"]);
                    $mentorb1 = $dbconnect->query("SELECT * FROM user WHERE id = " . $aMentor["user_id"]);
                    $mentorb = $mentorb1->fetch_assoc();
                    sendTicketReassignment($mentorb["email"], $aticket["subject"]);
                    $assigned=1;
                    break;
                }
            }
            if($assigned != 1)
            {
                $ticketSubs = $ticketSubs . $aticket["subject"] . ",\n";
                $dbconnect->query("insert into ticket_events (event_type_id, ticket_id, event_recorded_date, old_value, new_value, comment, event_performed_by_user_id) values (10, ".$aticket["id"].", NOW(), ".$aticket["assign_user_id"].", 5, null, 5)");
                $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = 5 WHERE id = ".$aticket["id"]);//give to admin for manual reassign
            }
        }
        $ticketSubs = $ticketSubs . $aticket["subject"] . ",\n ";
        // do this outside the loop  $awayMent = User::model()->findAllBySql("SELECT * FROM user WHERE id =:user_Id", array(":user_id"=>$user_Id));
        // foreach ($awayMent as $bawayMent) {
        //    User::model()->sendEmailTicketCancelOutOfOffice($bawayMent->fname . " " . $bawayMent - lname, $bawayMent->email, $aticket->subject);
        //}
    }
    $mentor2 = $dbconnect->query("SELECT * FROM user WHERE id = $user_Id");
    $mentor = $mentor2->fetch_assoc();
    sendTicketCancelEmail($mentor["email"],$ticketSubs);

}
/*
 * Sends the list of removed emails to the mentors email address
 */
function sendTicketCancelEmail($toEmail, $subjectlines)
{
   // echo"\n";
   // echo $toEmail .  $subjectlines;
    $subject = "Out of Office Response";
    $body = "Collaborative Platform received an Automated Out of office response from this email.\n\nWe have set you as out of office and you will no longer be assigned tickets automatically.\nThe tickets : \n\n" . $subjectlines . "\n\nHave been reassigned to another mentor\n\nIf this was done in error or you are back in office send an email to fiucoplat@gmail.com with:\n\n\"Back in office\"\n\nin the subject and the system will take you off of the away list, otherwise the system will take you off of the away list automatically after 24 hours\n\nThank you for all your help making Collaborative Platform great";
    $headers = 'From: Collaborative Platform <fiucoplat@gmail.com>' . "\r\n" .
        'Reply-To: fiucoplat@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

//send the email using IMAP
//( $a = mail($toEmail, $subject, $body, $headers))
  //  {  //  echo "Email sent 3!<br />";
    //}
    //else{echo "didnt sent";}
}
/*
 * Sends the information of the ticket that has been reassigned to the new mentor
 */
function sendTicketReassignment($toEmail, $subjectl)
{

    $subject = "Ticket Assigned";
    $body = "Collaborative Platform has assigned you a new ticket:\n\n" . $subjectl . "\n\nthat was previously assigned to another mentor.\n Thank you for Making Collaborative Platform Great";
    $headers = 'From: Collaborative Platform <fiucoplat@gmail.com>' . "\r\n" .
        'Reply-To: fiucoplat@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

//send the email using IMAP
  //  if( $a = mail($toEmail, $subject, $body, $headers))
   // {  //  echo "Email sent 3!<br />";
   // }
}
/*
 * Finds the tickets that have been assigned and haven't had mentor activity on them for more time then the priority
 * the ticket creator specified. The mentor activity that qualifies the ticket to not be reassigned is the mentor adding
 * a comment on the ticket or the mentor scheduling a meeting with the ticket creator.
 *
 * It adds the previous mentor to a list on the database of previous mentors so that the ticket will not be assigned to
 * a the same mentor.
 * If the ticket has been assigned three times and still has failed to have mentor activity it is then assigned to the
 * admin for manual reassignment
 *
 * It then reassigns each ticket notifying the new and old mentors through email
 */
function checkPriorityElapseTickets()
{
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
    $ticketr = $dbconnect->query("Select * FROM ticket t where (status != 'Close' and status != 'Reject' and assign_user_id != 5) AND ((priority_id = 1 AND assigned_date <= DATE_ADD(NOW(), INTERVAL -1 MINUTE)) OR (priority_id = 2 AND assigned_date <= DATE_ADD(NOW(), INTERVAL $med HOUR)) OR (priority_id = 3 AND assigned_date <= DATE_ADD(NOW(), INTERVAL $low HOUR))) AND id NOT IN (SELECT ticket_id as id FROM ticket_events where event_type_id = 5 and event_performed_by_user_id = t.assign_user_id) AND  not exists (Select null from (video_conference inner join vc_invitation on id = videoconference_id) where t.assign_user_id = moderator_id and t.creator_user_id = invitee_id and subject like CONCAT(t.subject,' - Ticket #',t.id)) ");
    //select all tickets without a ticket event 5 or MAYBE 8 (ask juan) over their respective priorities VERY COMPLICATED SQL query
    // reassign tickets
    if($ticketr->num_rows>0) {
        while ($aticket = $ticketr->fetch_assoc()) {
            $mentorToDeleteSHOW = $aticket["assign_user_id"];
            $ticketToDeleteSHOW = $aticket["id"];
            $toManyReassign = $dbconnect->query("SELECT count(ticket_id) as count from previous_mentors where ticket_id = ".$aticket["id"]);
            if($toManyReassign->num_rows>0)
            {
                $reassigns = $toManyReassign->fetch_assoc();
                if($reassigns["count"] >=3)
                {
                    $mentor = $dbconnect->query("Select * from user WHERE id = ".$aticket["assign_user_id"]);
                    $aMentor = $mentor->fetch_assoc();
                    sendTicketCancelOutOfTime($aMentor["email"], $aticket["subject"]);
                    $dbconnect->query("insert into ticket_events (event_type_id, ticket_id, event_recorded_date, old_value, new_value, comment, event_performed_by_user_id) values (10, ".$aticket["id"].", NOW(), ".$aticket["assign_user_id"].", 5, null, 5)");
                    $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = 5 WHERE id = ".$aticket["id"]);//give to admin for manual reassign

                    continue;
                }
            }
            $mentor = $dbconnect->query("Select * from user WHERE id = ".$aticket["assign_user_id"]);
            $aMentor = $mentor->fetch_assoc();
            sendTicketCancelOutOfTime($aMentor["email"], $aticket["subject"]);
            $dbconnect->query("INSERT INTO previous_mentors (user_id, ticket_id) VALUES(".$aMentor["id"] .", ".$aticket["id"]. ")");
            if (!is_null($aticket["subdomain_id"])) {
                $sql = "SELECT * FROM user_domain left join (select assign_user_id, assigned_date from (select * from ticket order by assigned_date desc)x  group by assign_user_id)x on assign_user_id = user_id WHERE domain_id = " . $aticket["domain_id"] . " AND subdomain_id = " . $aticket["subdomain_id"] . " AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) AND user_id not in (select user_id as user_id from previous_mentors where ticket_id = ". $aticket["id"].") order by assigned_date ASC   ";
                }
            else {
                $sql = "SELECT * FROM user_domain left join (select assign_user_id, assigned_date from (select * from ticket order by assigned_date desc)x  group by assign_user_id)x on assign_user_id = user_id  WHERE domain_id = " . $aticket["domain_id"] . " AND tier_team = 1 AND user_id not in (select userID as user_id from away_mentor) AND user_id not in (select user_id as user_id from previous_mentors where ticket_id = ". $aticket["id"].") order by assigned_date ASC   ";
            }
            $possibleMentors = $dbconnect->query($sql);
            if ($possibleMentors->num_rows<=0)
            {
                $dbconnect->query("insert into ticket_events (event_type_id, ticket_id, event_recorded_date, old_value, new_value, comment, event_performed_by_user_id) values (10, ".$aticket["id"].", NOW(), ".$aticket["assign_user_id"].", 5, null, 5)");
                $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = 5 WHERE id = ".$aticket["id"]);//give to admin for manual reassign
            }
            else {
                $assinged = 0;
                while ($aMentor = $possibleMentors->fetch_assoc()) {
                    $count1 = $dbconnect->query("SELECT COUNT(id) as `id` FROM ticket WHERE assign_user_id = " . $aMentor["user_id"]);
                    $adomainMentor1 = $dbconnect->query("SELECT * FROM domain_mentor WHERE user_id = " . $aMentor["user_id"]);
                    $count = $count1->fetch_assoc();
                    $adomainMentor = $adomainMentor1->fetch_assoc();
                    if ($adomainMentor) {
                        if ($count['id'] < $adomainMentor["max_tickets"]) {
                            $dbconnect->query("insert into ticket_events (event_type_id, ticket_id, event_recorded_date, old_value, new_value, comment, event_performed_by_user_id) values (10, ".$aticket["id"].", NOW(), ".$aticket["assign_user_id"].", ".$aMentor["user_id"].", null, 5)");
                            $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = " . $aMentor["user_id"] . " WHERE id = " . $aticket["id"]);
                            $mentorb1 = $dbconnect->query("SELECT * FROM user WHERE id = " . $aMentor["user_id"]);
                            $mentorb = $mentorb1->fetch_assoc();
                            sendTicketReassignment($mentorb["email"], $aticket["subject"]);
                            $assinged = 1;
                            break;
                        }
                    } else { //not registered as having a max ticket.
                        $dbconnect->query("insert into ticket_events (event_type_id, ticket_id, event_recorded_date, old_value, new_value, comment, event_performed_by_user_id) values (10, ".$aticket["id"].", NOW(), ".$aticket["assign_user_id"].", ".$aMentor["user_id"].", null, 5)");
                        $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = " . $aMentor["user_id"] . " WHERE id = " . $aticket["id"]);
                        $mentorb1 = $dbconnect->query("SELECT * FROM user WHERE id = " . $aMentor["user_id"]);
                        $mentorb = $mentorb1->fetch_assoc();
                        sendTicketReassignment($mentorb["email"], $aticket["subject"]);
                        $assinged = 1;
                        break;
                    }
                }
                if($assinged != 1)
                {
                    $dbconnect->query("insert into ticket_events (event_type_id, ticket_id, event_recorded_date, old_value, new_value, comment, event_performed_by_user_id) values (10, ".$aticket["id"].", NOW(), ".$aticket["assign_user_id"].", 5, null, 5)");
                    $dbconnect->query("UPDATE ticket SET assigned_date = NOW(), assign_user_id = 5 WHERE id = ".$aticket["id"]);//give to admin for manual reassign
                }

            }
            $dbconnect->query("DELETE FROM previous_mentors where user_id = $mentorToDeleteSHOW and ticket_id = $ticketToDeleteSHOW"); //  echo "a went through entire thing ticket should be reassigned\n";
        }
    }
}
/*
 * Sends an email to the mentor notifying them that a ticket they were assigned was reassigned to a new mentor because
 * the ticket ran out of time before there was qualifying activity on the ticket.
 */
function sendTicketCancelOutOfTime($toEmail, $subjectLine)
{
    $subject = "Reassign Due to Inactivity";
    $body = "Due to the inactivity on the ticket:\n\n$subjectLine \n\nhas been reassigned.\n\nThank you for all your help making Collaborative Platform great";
    $headers = 'From: Collaborative Platform <fiucoplat@gmail.com>' . "\r\n" .
        'Reply-To: fiucoplat@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

//send the email using IMAP
   // if( $a = mail($toEmail, $subject, $body, $headers))
    //{  //  echo "Email sent 3!<br />";
   // }
}

//emailListener();
checkPriorityElapseTickets();
?>

