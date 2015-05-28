<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 5/25/2015
 * Time: 5:33 PM
 */

    function establishConnection()
    {
        $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
        $username = 'fiucoplat@gmail.com';
        $password = 'fiuadmin';
        $connection = imap_open($hostname, $username, $password) or die ("Cannot connect to gmail:" . imap_last_error());
        return $connection;
    }

    function emailListener()
    {

        $connection = establishConnection();
        //develop thread/loop
        $awayment = new AwayMentor();
        $messagestatus = "UNSEEN";
        while (true) {
            $emails = imap_search($connection, $messagestatus);
            if ($emails) {
                rsort($emails);
                foreach ($emails as $email_number) {
                    $header = imap_fetch_overview($connection, $email_number, 0);
                    $message = imap_fetchbody($connection, $email_number, 1.1);
                    if ($message == "") {
                        $message = imap_fetchbody($connection, $email_number, 1);
                    }
                    if (!$awayment->detectOOOmessage($header->subject, $message, $header->from)) {
                        $awayment->detectB00message($header->subject, $header->from);
                    }
                    imap_delete($connection, 1);
                }
                sleep(600); //do check every 10 minutes
                if (!imap_ping($connection)) {
                    $connection = establishConnection();
                }
            }
        }
    }
emailListener();
?>