<?php
include_once('init.php');
$rcvPassword = $_POST["Password"];
$rcvID = $_POST["ID"];
$rcvTitle = $_POST["Title"];
$rcvContent = $_POST["Content"];

$article = mysqli_fetch_array(mysqli_query(connect(), "SELECT * FROM articledb where id = " . $rcvID));

$authorID = $article['authorId'];
$authorPassword = mysqli_fetch_array(mysqli_query(connect(), "SELECT password FROM users where userId = " . $authorID))['password'];
if ($rcvPassword == $authorPassword) {
    mysqli_query(connect(), "UPDATE articledb SET title = '" . $rcvTitle . "', content = '" . $rcvContent . "', uploadDate = now() WHERE id = " . $rcvID);
} else {
    echo '<script>alert("access denied")</script>';
}
?>