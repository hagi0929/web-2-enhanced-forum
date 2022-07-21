
<tr>
    <th class="titleCol">Title</th>
    <th class="authorCol">Author</th>
    <th class="dateCol">Time</th>
</tr>
<?php
require_once('init.php');
$post_data = json_decode(file_get_contents('php://input'), true);
$condition = mysqli_real_escape_string($connect, $post_data['condition']);
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
