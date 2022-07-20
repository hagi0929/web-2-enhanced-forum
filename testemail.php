<?php
$to = "ministove3yo@gmail.com";
$subject = "testemail";
$message = "fuck you";

$headers = "From: The Sender Name <sender@mathboard.online>";
$headers .= "Reply-To: replyto@mathboard.online";
$headers .= "Content-type: text/html\r\n";
mail($to, $subject, $message, $headers);