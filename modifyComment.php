<?php
include_once("init.php");

var_dump($_SESSION);
$userId = htmlspecialchars($_POST['userId']);
if (isset($_SESSION['user']) and $_SESSION['user']['userId'] == $userId) {
    echo $_POST['executeType'];
    if ($_POST['executeType'] == "0") {
        $sqlDelete = "DELETE FROM comments WHERE id=".htmlspecialchars($_POST['commentId']);
        $deleteQuery = mysqli_query($connect, $sqlDelete);
    }
    else{
        $articleId = htmlspecialchars($_POST['articleId']);
        $content = htmlspecialchars($_POST['content']);
        $writeComment = "INSERT INTO comments (articleId, authorId, content, dateCreated) VALUES ('{$articleId}', '{$userId}', '{$content}', NOW())";
        $createQuery = mysqli_query($connect, $writeComment);
    }
}
header("location:" . $_SERVER['HTTP_REFERER']);