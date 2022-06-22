<?php
include_once('init.php');
?>
<?php top('Forum Board');
headerInit(); ?>
<div class="container_contents">
    <div class="wrapper">
        <div class="nav">
            <a class="btn" href="write.php">create</a>
        </div>
        <table>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Author</th>
                <th>Time</th>
            </tr>
            <?php
            $filterArticle = "SELECT id, title, displayName, uploadDate, userId FROM articledb LEFT JOIN users ON articledb.authorId = users.userId";
            $query = mysqli_query(connect(), $filterArticle);
            while ($row = mysqli_fetch_array($query)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td><a href="view.php?id=' . $row['id'] . '">' . $row['title'] . '</a></td>';
                echo '<td><a href="profile.php?id=' . $row['userId'] . '">' . $row['displayName'] . '</a></td>';
                echo '<td>' . mb_substr($row['uploadDate'], 0, 10) . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>
<footer>

</footer>
</body>
</html>