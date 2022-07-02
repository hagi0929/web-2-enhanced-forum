<?php
include_once('init.php');
$titleRcv = $_POST['Title'];
$contentRcv = $_POST['Content'];
$filterArticle = "INSERT INTO articledb (title,content,authorId,uploadDate) VALUES ('".$titleRcv."','".$contentRcv."',0,now())";
$query = mysqli_query(connect(), $filterArticle);
header("Location: index.php");
?>

