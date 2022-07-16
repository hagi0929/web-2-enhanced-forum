<?php
include_once('init.php');
top('view profile');
headerInit();
if (isset($_GET['id'])) {
    $articleId = mysqli_real_escape_string($connect, $_GET['id']);
    $filterArticle = "SELECT * FROM articledb where id =" . $articleId;
    $articleQuery = mysqli_query($connect, $filterArticle);
    $articleRow = mysqli_fetch_array($articleQuery);

    $filterUser = "SELECT id, name, email FROM users where id =" . $articleRow['authorId'];
    $userQuery = mysqli_query($connect, $filterUser);
    $userRow = mysqli_fetch_array($userQuery);
} else {
    header("Location:login.php");
}
navigator(1);
?>
    <script src="main.js"></script>
    <div class="container_contents">
        <div class="wrapper">
            <?php
            if (isset($_SESSION['user']) and $userRow['id'] == $_SESSION['user']['id'] and
            $userRow['email'] == $_SESSION['user']['email'] and
            $userRow['name'] == $_SESSION['user']['name']) {
                echo '<div class="nav">
                <form action="deleteFinal.php" method="post" id="deleteSubmit">
                    <input type="hidden" name="ID" value='.$articleId.'>
                </form>
                <form action="edit.php" method="post" id="editSubmit">
                    <input type="hidden" name="ID" value='.$articleId.'>
                </form>
                <a class="btn" href="javascript: Submit(\'deleteSubmit\',[])">Delete</a>
                <a class="btn" href="javascript: Submit(\'editSubmit\',[])">Edit</a>
            </div>';
            }
            ?>
            <div class="view">
                <div class="view-title">
                    <h3><?= $articleRow['title'] ?></h3>
                    <span><?= $userRow['name'] ?> | <?= $articleRow['uploadDate'] ?></span>
                </div>
                <div class="view-content">
                    <span><?= nl2br($articleRow['content']) ?></span>
                </div>
            </div>
        </div>
    </div>
<?php footerInit(); ?>