<?php
require_once("init.php");

if (isset($_SESSION['id']) ) {
$userVerQuery = mysqli_query($connect, "SELECT email FROM users WHERE userId=".$_SESSION['id']);
$rowUserVer = mysqli_fetch_array($userVerQuery);
}
else{
    if(isset($_POST['email'])){
        $rowUserVer = [
            'email' => $_POST['email']
        ];
    }
    else{
        header("location: index.php");
    }
}

if(isset($rowUserVer)){
    $receiverEmail = $rowUserVer['email'];
    $senderEmail = "emailVerification@mathboard.online";
    $emailContent = '
        Thank you for registering to mathboard.online LF(\n)
        
    ';
    $mailHeader = 'verify your email address: mathboard.online';
}