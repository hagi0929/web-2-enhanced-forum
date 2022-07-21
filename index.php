<?php
include_once('init.php');
top('Forum Board');
headerInit();
$condition = "";
if (isset($_GET['user'])){
    $condition = "WHERE authorId =".$_GET['user'];
}
if (isset($_GET['keyword'])){
    $condition = "WHERE (title LIKE '%{$_GET['keyword']}%' OR content LIKE '%{$_GET['keyword']}%')";

}
navigator(0);
?>
    <div class="container_contents">
        <div class="wrapper">
            <div class="nav">
                <a class="btn" href="<?php
                if (isset($_SESSION['user'])) {
                    echo "write.php";
                } else {
                    echo "login.php?ss=1";
                }
                ?>">create post</a>
            </div>
            <table>
                <tr>
                    <th class="titleCol">Title</th>
                    <th class="authorCol">Author</th>
                    <th class="dateCol">Time</th>
                </tr>
                <?php
                $filterArticle = "SELECT id, title, authorId, uploadDate FROM article ". $condition . " ORDER BY uploadDate DESC";
                $articleQuery = mysqli_query($connect, $filterArticle);
                while ($articleRow = mysqli_fetch_array($articleQuery)) {
                    $filterUser = "SELECT * FROM users where userId = {$articleRow['authorId']}";
                    $UserQuery = mysqli_query($connect, $filterUser);
                    $userRow = mysqli_fetch_array($UserQuery);
                    echo '<tr>';
                    echo '<td><a href="view.php?id=' . htmlspecialchars($articleRow['id']) . '">' . htmlspecialchars($articleRow['title']) . '</a></td>';
                    echo '<td><a href="index.php?user=' . htmlspecialchars($userRow['userId']) . '">' . htmlspecialchars($userRow['username']) . '</a></td>';
                    echo '<td>' . mb_substr($articleRow['uploadDate'], 0, 10) . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
    </div>
<?php footerInit();?>