<?php
$to      = 'adurocruor@gmail.com';
$subject = 'a test email';
$message = 'hello';
$headers = 'From: Collaborative Platform' . "\r\n" .
    'Reply-To: fiucoplat@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers, "-f fiucoplat@gmail.com");
?>