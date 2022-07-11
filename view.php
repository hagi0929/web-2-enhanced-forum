<?php
include_once('init.php');
top('view profile');
headerInit();
if (isset($_GET['id'])) {
    $articleId = mysqli_real_escape_string(connect(), $_GET['id']);
} else {
    header("Location:index.php");
}
$filterArticle = "SELECT id, title, displayName, uploadDate, userId, displayName, content FROM articledb LEFT JOIN users ON articledb.authorId = users.userId WHERE articledb.id =" . $articleId;
$query = mysqli_query(connect(), $filterArticle);
$row = mysqli_fetch_array($query); ?>
    <script src="main.js"></script>
    <div class="container_contents">
        <div class="wrapper">
            <div class="nav">
                <form action="deleteFinal.php" method="post" id="deleteSubmit">
                    <input type="hidden" name="ID" value=<?= $articleId ?>>
                </form>
                <form action="edit.php" method="post" id="editSubmit">
                    <input type="hidden" name="ID" value=<?= $articleId ?>>
                </form>
                <a class="btn" href="javascript: passwordNSubmit('deleteSubmit')">Delete</a>
                <a class="btn" href="javascript: passwordNSubmit('editSubmit')">Edit</a>
            </div>
            <div class="view">
                <div class="view-title">
                    <h3><?= $row['title'] ?></h3>
                    <span><?= $row['displayName'] ?> | <?= $row['uploadDate'] ?></span>
                </div>
                <div class="view-content">
                    <span><?= $row['content'] ?></span>
                </div>
            </div>
        </div>
    </div>
<?php footerInit(); ?>