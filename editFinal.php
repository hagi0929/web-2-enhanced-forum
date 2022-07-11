<?php
include_once('init.php');
$filtered = array(
    "Password" => mysqli_real_escape_string(connect(), $_POST["Password"]),
    "ID" => mysqli_real_escape_string(connect(), $_POST["ID"]),
    "Title" => mysqli_real_escape_string(connect(), $_POST["Title"]),
    "Content" => mysqli_real_escape_string(connect(), $_POST["Content"])
);
$article = mysqli_fetch_array(mysqli_query(connect(), "SELECT * FROM articledb where id ={$filtered["ID"]}"));
$authorID = mysqli_real_escape_string(connect(), $article['authorId']);
$authorPassword = mysqli_fetch_array(mysqli_query(connect(), "SELECT password FROM users where userId = {$authorID}")['password']);
if ($article['Password'] == $authorPassword) {
    mysqli_query(connect(), "UPDATE articledb SET title = '" . $filtered["Title"] . "', content = '" . $filtered["Content"] . "', uploadDate = now() WHERE id = " . $filtered["ID"]);
} else {
    echo '<script>alert("access denied")</script>';
}
?>