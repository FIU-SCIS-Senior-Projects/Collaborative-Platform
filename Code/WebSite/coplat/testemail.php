<?php
$to      = 'adurocruor@gmail.com';
$subject = 'a test email';
$message = 'hello';
$headers = 'From: Collaborative Platform <fiucoplat@gmail.com>' . "\r\n" .
    'Reply-To: fiucoplat@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
echo $to;
mail($to, $subject, $message, $headers);
?>