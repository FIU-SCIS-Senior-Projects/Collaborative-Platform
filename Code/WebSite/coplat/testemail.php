<?php
$to      = 'adurocruor@gmail.com';
$subject = 'a test email';
$message = 'hello';
$headers = 'From: Collaborative Platform <fiucoplat@cp-dev.cs.fiu.edu>' . "\r\n" .
    'Reply-To: fiucoplat@cp-dev.cs.fiu.edu' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
echo $to;
mail($to, $subject, $message, $headers);
?>
