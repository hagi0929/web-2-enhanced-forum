<?php
include_once('init.php');
$titleRcv = $_POST['Title'];
$contentRcv = $_POST['Content'];
$filterArticle = "INSERT INTO articledb VALUES ()";
$query = mysqli_query(connect(), $filterArticle);
$row = mysqli_fetch_array($query);
?>