<?php
include_once('init.php');
top('view profile');
headerInit();
if (isset($_GET['id'])) {
    $articleId = mysqli_real_escape_string($connect, $_GET['id']);
    $filterArticle = "SELECT * FROM article where id =" . $articleId;
    $articleQuery = mysqli_query($connect, $filterArticle);
    $articleRow = mysqli_fetch_array($articleQuery);

    $filterUser = "SELECT userId, username, email FROM users where userId =" . $articleRow['authorId'];
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
            if (isset($_SESSION['user']) and $userRow['userId'] == $_SESSION['user']['userId'] and
                $userRow['email'] == $_SESSION['user']['email'] and
                $userRow['username'] == $_SESSION['user']['username']) {
                echo '<div class="nav">
                <form action="deleteFinal.php" method="post" id="deleteSubmit">
                    <input type="hidden" name="ID" value=' . $articleId . '>
                </form>
                <form action="edit.php" method="post" id="editSubmit">
                    <input type="hidden" name="ID" value=' . $articleId . '>
                </form>
                <a class="btn" href="javascript: Submit(\'deleteSubmit\',[])">Delete</a>
                <a class="btn" href="javascript: Submit(\'editSubmit\',[])">Edit</a>
                </div>';
            }
            ?>
            <div class="view">
                <div class="view-title">
                    <h3><?= $articleRow['title'] ?></h3>
                    <span><a href="index.php?user=<?= $userRow['userId'] ?>"><?= $userRow['username'] ?></a> | <?= $articleRow['uploadDate'] ?></span>
                </div>
                <div class="view-content">
                    <span><?= nl2br($articleRow['content']) ?></span>
                </div>
                <?php
                if (isset($_SESSION['user'])) {
                    echo '<div class="view-title">
                <form action="modifyComment.php" method="post">
                    <input type="hidden" name="userId" value=' . $_SESSION['user']['userId'] . '>
                    <input type="hidden" name="articleId" value=' . $_GET['id'] . '>
                    <input type="hidden" name="executeType" value="1">
                    <textarea rows="3" style="resize: none;" name="content" placeholder="comment here" class="inputBoxContent"></textarea>
                    <div style="display: flex; flex-direction: row; justify-content: flex-end; border-bottom: 1px black solid; padding-bottom: 10px">
                        <input type="submit" class="btn" value="Submit">
                    </div>
                </form>';
                }
                $filterComments = "SELECT comments.content, comments.dateCreated, users.username, comments.id, userId FROM comments LEFT JOIN users on comments.authorId = users.userId WHERE articleId =" . $_GET['id'];
                $commentsQuery = mysqli_query($connect, $filterComments);
                while ($commentsRow = mysqli_fetch_array($commentsQuery)) {
                    displayComment($commentsRow);
                }
                ?>
                <script>

                </script>
            </div>
        </div>
    </div>
<?php footerInit(); ?>