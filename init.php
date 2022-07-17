<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$connect = mysqli_connect(
    $hostname,
    $username,
    $password,
    $database,
    $port
) or die('There was a problem connecting to the database');


$DB_host = $hostname;
$DB_user = $username;
$DB_password = $password;
$DB_database = $database;
try {
    $db = new PDO("mysql:host={$DB_host}; dbname={$DB_database}", $DB_user, $DB_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOEXCEPTION $e) {
    echo $e->getMessage();
}
function top($title): void
{
    echo '
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="main.css">    
    <script src="main.js"></script>
    <title>' . $title . '</title>
</head>
<body>';
}

function headerInit(): void
{
    echo '
<header class="header">
    <div>
        <a href = "index.php" > <h1 > Forum Board </h1 > </a >
    </div>
</header>
';
}

function navigator($withSearch = 1): void
{
    echo '
<div class="nav t-nav top">
    <div class="left">
    ';
    if (isset($_SESSION['user'])) {
        echo "<div class='profile'>{$_SESSION['user']['username']}</div>";

    }

    echo '
    </div>';
    if ($withSearch == 0) {
        echo '
    <div class="middle">
            <form action="">
        <div class="navSearchBar">
                <input type="text" name="keyword" style="border: 2px solid black; border-radius: 4px">
                <input type="submit" class="btn" value="search"> 
        </div>      
            </form>
        </div>';
    }
    echo '
    <div class="right">
';
    if (isset($_SESSION['user'])) {
        echo "
        <a class=\"btn\" href=\"logout.php\">logout</a>
        ";
    } else {
        echo '
        <a class="btn" href="login.php">login</a>
        <a class="btn" href="register.php">register</a>
        ';
    }
    echo '
    </div>
</div>';
}

function footerInit(): void
{
    echo '
<footer class="foot">
<div style="border-top: 1px solid black; width: 100vw;">created by <a href="https://github.com/hagi0929" class ="blue">hagi0929<a> with ❤️</div>
</footer>
</body>
</html>
';
}

function displayComment($commentAuthor, $commentContent, $commentDate, $commentId)
{
    echo '
<div class="comment">
    <div class="nav t-nav"style="border-bottom: 0">
        <div class="left">
            <span class="commentInfo">' . $commentAuthor . ' </span>
            <span class="commentInfo"> ' . $commentDate . '</span>
        </div>';
    if (isset($_SESSION['user']) and $_SESSION['user']['id'] = $commentAuthor) {

        echo '
        <form id = "modifyComment" action="makeComment.php" method="post">
        <div class="right">
            <input type="hidden" name="commentId" value="commentId">
            <input type="hidden" name="executeType">
            <a class="mini-btn" onclick="Submit(\'modifyComment\',[] , {\'executeType\': \'edit\'})" href="#">edit</a>
            <a class="mini-btn" onclick="Submit(\'modifyComment\',[] , {\'executeType\': \'delete\'})" href="#">delete</a>
        </div>
        </form>
';

    }
    echo '
    </div>
        <span>' . $commentContent . '<span>
</div>
';
}

?>
