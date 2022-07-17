<?php
include_once('init.php');
$titleRcv = htmlspecialchars($_POST['Title']);
$contentRcv = htmlspecialchars($_POST['Content']);
$authorID = htmlspecialchars($_POST['authorID']);

$write = "INSERT INTO article (title,content,authorId,uploadDate) VALUES ('{$titleRcv}','{$contentRcv}',{$authorID},NOW())";
$query = mysqli_query($connect, $write);
header("Location: index.php");
?>

