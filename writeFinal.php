<?php
include_once('init.php');
$titleRcv = $_POST['Title'];
$contentRcv = $_POST['Content'];
$authorID = $_POST['authorID'];
$filterArticle = "INSERT INTO articledb (title,content,authorId,uploadDate) VALUES ('{$titleRcv}','{$contentRcv}',{$authorID},NOW())";
$query = mysqli_query($connect, $filterArticle);
header("Location: index.php");
?>

