<?php
include_once('init.php');
$rcvID = $_POST['ID'];
$article = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM article where id = " . $rcvID));
$authorID = $article['authorId'];
$filterUser = "SELECT id,username, email FROM users where id =" . $article['authorId'];
$userQuery = mysqli_query($connect, $filterUser);
$userRow = mysqli_fetch_array($userQuery);


if (isset($_SESSION['user']) and $userRow['userId'] == $_SESSION['user']['id'] and
    $userRow['email'] == $_SESSION['user']['email'] and
    $userRow['narname'] == $_SESSION['user']['narname']) {
    mysqli_query($connect, "UPDATE article SET title = '" . htmlspecialchars($_POST["Title"]) . "', content = '" . htmlspecialchars($_POST["Content"]) . "', uploadDate = now() WHERE id = " . htmlspecialchars($article["id"]));
} else {
    echo '<script>alert("access denied")</script>';
}
    header("Location:view.php?id={$article["id"]}");
?>