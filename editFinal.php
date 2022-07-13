<?php
include_once('init.php');
$filtered = array(
    "Password" => is_null(mysqli_real_escape_string(connect(), $_POST["Password"])) ? "" : mysqli_real_escape_string(connect(), $_POST["Password"]),
    "ID" => mysqli_real_escape_string(connect(), $_POST["ID"]),
    "Title" => mysqli_real_escape_string(connect(), $_POST["Title"]),
    "Content" => mysqli_real_escape_string(connect(), $_POST["Content"])
);
$article = mysqli_fetch_array(mysqli_query(connect(), "SELECT * FROM articledb where id ={$filtered["ID"]}"));
$authorID = mysqli_real_escape_string(connect(), $article['authorId']);
var_dump(is_null($article['Password']) ? "" : $article['Password']);
$authorPassword = mysqli_fetch_array(
    mysqli_query(
        connect(), "SELECT password FROM users where userId = {$authorID}"
    )
)['password'];
if ( (is_null($article['Password']) ? "" : $article['Password']) == $authorPassword) {
    mysqli_query(connect(), "UPDATE articledb SET title = '" . $filtered["Title"] . "', content = '" . $filtered["Content"] . "', uploadDate = now() WHERE id = " . $filtered["ID"]);
    header("Location:view.php?id={$filtered["ID"]}");
} else {
    echo '<script>alert("access denied")</script>';
    header("Location:view.php?id={$filtered["ID"]}");
}
?>