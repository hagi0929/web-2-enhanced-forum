<?php
include_once("init.php");
$rcvID = $_POST["ID"];
echo $rcvID;
$article = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM article where id = " . $rcvID));

$authorID = $article['authorId'];
$filterUser = "SELECT userId, username, email FROM users where userId =" . $article['authorId'];
$userQuery = mysqli_query($connect, $filterUser);
$userRow = mysqli_fetch_array($userQuery);

if (isset($_SESSION['user']) and $userRow['userId'] == $_SESSION['user']['userId'] and
            $userRow['email'] == $_SESSION['user']['email'] and
            $userRow['username'] == $_SESSION['user']['username']) {
    mysqli_query($connect, "DELETE FROM article where id = " . $rcvID);
    header("Location: index.php");
} else {
    echo "<script >alert('access denied')</script>";
    header("Location: view.php?id=" . $rcvID);
}
?>

