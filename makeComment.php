<?php
include_once('init.php');
echo $_POST['modifyComment'];
if (isset($_SESSION['user']) and isset($modifyComment)) {
    $comment = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM articledb where id = " . $rcvID));
    mysqli_query($connect, "UPDATE articledb SET title = '" . htmlspecialchars($_POST["Title"]) . "', content = '" . htmlspecialchars($_POST["Content"]) . "', uploadDate = now() WHERE id = " . htmlspecialchars($article["id"]));

}
$userId = htmlspecialchars($_POST['userId']);
if (isset($_SESSION['user']) and $_SESSION['user']['id'] == $userId) {
        $articleId = htmlspecialchars($_POST['articleId']);
        $content = htmlspecialchars($_POST['content']);
        $writeComment = "INSERT INTO comments (articleId, authorId, content, dateCreated) VALUES ('{$articleId}', '{$userId}', '{$content}', NOW())";
        $query = mysqli_query($connect, $writeComment);
}
echo "header(location:view.php?id=" . $articleId . ")";
