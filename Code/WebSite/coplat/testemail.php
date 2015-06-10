<?php
$to      = 'adurocruor@gmail.com';
$subject = 'a test email';
$message = 'hello';
$headers = 'From: fiucoplat@gmail.com' . "\r\n" .
    'Reply-To: fiucoplat@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers, "-f fiucoplat@gmail.com");
?>