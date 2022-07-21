<?php
require_once('init.php');
$articleId = $_GET['articleId'];
$filterComments = "SELECT comments.content, comments.dateCreated, users.username, comments.id, userId, comments.articleId FROM comments LEFT JOIN users on comments.authorId = users.userId WHERE articleId =" . $articleId;
$commentsQuery = mysqli_query($connect, $filterComments);
while ($commentsRow = mysqli_fetch_array($commentsQuery)) {
    displayComment($commentsRow);
}