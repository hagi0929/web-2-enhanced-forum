<?php
include_once("init.php");
$rcvPassword = $_POST["Password"];
$rcvID = $_POST["ID"];

$article = mysqli_fetch_array(mysqli_query(connect(), "SELECT * FROM articledb where id = " . $rcvID));

$authorID = $article['authorId'];
$authorPassword = mysqli_fetch_array(mysqli_query(connect(), "SELECT password FROM users where userId = " . $authorID))['password'];
if ($rcvPassword == $authorPassword) {
    mysqli_query(connect(), "DELETE FROM articledb where id = " . $rcvID);
header("Location: index.php");
//    header("Location: index.php");
} else {
    echo "<script >alert('access denied')</script>";
header("Location: view.php?id=" . $rcvID);
}
?>

