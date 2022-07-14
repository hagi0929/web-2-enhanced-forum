<?php
include_once("init.php");
$rcvID = $_POST["ID"];
echo $rcvID;
$article = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM articledb where id = " . $rcvID));

$authorID = $article['authorId'];
$filterUser = "SELECT id, name, email FROM users where id =" . $article['authorId'];
$userQuery = mysqli_query($connect, $filterUser);
$userRow = mysqli_fetch_array($userQuery);

if (isset($_SESSION['user']) and $userRow['id'] == $_SESSION['user']['id'] and
            $userRow['email'] == $_SESSION['user']['email'] and
            $userRow['name'] == $_SESSION['user']['name']) {
    mysqli_query($connect, "DELETE FROM articledb where id = " . $rcvID);
    header("Location: index.php");
} else {
    echo "<script >alert('access denied')</script>";
    header("Location: view.php?id=" . $rcvID);
}
?>

