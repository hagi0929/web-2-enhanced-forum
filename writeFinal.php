<?php
include_once('init.php');
$titleRcv = htmlspecialchars($_POST['Title']);
$contentRcv = htmlspecialchars($_POST['Content']);
$authorID = htmlspecialchars($_POST['authorID']);

$filterArticle = "INSERT INTO articledb (title,content,authorId,uploadDate) VALUES ('{$titleRcv}','{$contentRcv}',{$authorID},NOW())";
$query = mysqli_query($connect, $filterArticle);
header("Location: index.php");
?>

