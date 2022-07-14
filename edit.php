<?php
include_once('init.php');

$rcvID = $_POST["ID"];

$article = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM articledb where id = " . $rcvID));
$authorID = $article['authorId'];
$filterUser = "SELECT id, name, email FROM users where id =" . $article['authorId'];
$userQuery = mysqli_query($connect, $filterUser);
$userRow = mysqli_fetch_array($userQuery);

if (isset($_SESSION['user']) and $userRow['id'] == $_SESSION['user']['id'] and
            $userRow['email'] == $_SESSION['user']['email'] and
            $userRow['name'] == $_SESSION['user']['name']) {
    top("Edit");
    headerInit();
    echo '
<script src="main.js"></script>
    <div class="container_contents">
        <div class="wrapper">
            <form action="editFinal.php" method="POST" id="editFinalSubmit">
                <input type="hidden" name="ID" value=' . $rcvID . '>
                <div class="nav">
                    <a class="btn" href="javascript:Submit(&#39;editFinalSubmit&#39;,[&#39;inputBoxTitleEdit&#39;, &#39;inputBoxContentEdit&#39;])">Submit</a>
                    <a class="btn" href="view.php?id=' . $rcvID . '">Cancel</a>
                </div>
                <div class="editView">
                    <div class="view-title">
                        <input class="inputBoxTitle" id = "inputBoxTitleEdit" name="Title" type="text" placeholder="Title" value="' . $article['title'] . '" required>
                    </div>
                    <div class="view-content">
                        <textarea class="inputBoxContent" id = "inputBoxContentEdit" name="Content" rows="25" placeholder="Content" required>' . $article['content'] . '</textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
';
    footerInit();
} else {
    echo "<script >alert('access denied')</script>";
    header("Location: view.phpid?=" . $rcvID);
}

?>

