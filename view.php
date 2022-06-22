<?php
include_once('init.php');
$articleId = $_GET['id'];
$filterArticle = "SELECT id, title, displayName, uploadDate, userId, displayName, content FROM articledb LEFT JOIN users ON articledb.authorId = users.userId WHERE articledb.id =" . $articleId;
$query = mysqli_query(connect(), $filterArticle);
$row = mysqli_fetch_array($query);
?>

<?php top('view profile');
headerInit(); ?>

<div class="container_contents">
    <div class="wrapper">
        <div class="nav">
            <a class="btn" href="Delete.php">Delete</a>
            <a class="btn" href="Edit.php">Edit</a>
        </div>
        <?php
        echo '
        <div class="view">
            <div class="view-title">
                <h3>' . $row['title'] . '</h3>
                <span>' . $row['displayName'] . ' | ' . $row['uploadDate'] . '</span>
            </div>
            <div class="view-content">
                <span>' . $row['content'] . '</span>
            </div>
        </div>';

        ?>
    </div>
</div>
<footer>

</footer>
</body>
</html>