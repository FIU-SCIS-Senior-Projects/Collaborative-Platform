<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 6/11/2015
 * Time: 1:44 PM
 */
function establishDBConnection()
{
    $username = 'root';
    $password = '9Qst32+';
    $dbconn = new mysqli("localhost", $username, $password, "coplat");
    return $dbconn;
}
function sendTicketReassignment()
{
$dbConnect = establishDBConnection();
    $query = $dbConnect->query("SELECT * from ticket where id = 87")->fetch_assoc();
    $ticket_id = $query["id"];
    $subjectl = $query["subject"];
    $toEmail = "adurocruor@gmail.com";

    $subject = "Ticket Assigned";
    $subectClick = $subjectl;
    $body = "Collaborative Platform has assigned you a new ticket:\n\n" . $subjectClick . "\n\nthat was previously assigned to another mentor.\n Thank you for Making Collaborative Platform Great";
    $headers = 'From: Collaborative Platform <fiucoplat@gmail.com>' . "\r\n" .
        'Reply-To: fiucoplat@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

//send the email using IMAP
    if( $a = mail($toEmail, $subject, $body, $headers))
    {  //  echo "Email sent 3!<br />";
    }
}
sendTicketReassignment();
echo "find";