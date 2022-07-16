<?php
include_once('init.php');
$userId = htmlspecialchars($_POST['userId']);
$articleId = htmlspecialchars($_POST['articleId']);
$content = htmlspecialchars($_POST['content']);
$writeComment = "INSERT INTO comments (articleId, authorId, content, dateCreated) VALUES ('{$articleId}', '{$userId}', '{$content}', NOW())";
$query = mysqli_query($connect, $writeComment);
echo "header(location:view.php?id=".$articleId.")";
