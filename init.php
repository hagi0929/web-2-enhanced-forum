<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$f = fopen('key.txt', 'r');
$hostname = trim(htmlspecialchars(fgets($f)));
$username = trim(htmlspecialchars(fgets($f)));
$password = trim(htmlspecialchars(fgets($f)));
$database = trim(htmlspecialchars(fgets($f)));
$port = trim(htmlspecialchars(fgets($f)));
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
    if (isset($_SESSION['user'])) {
        echo "
            <div class=\"nav top fixed underline reverse\">
                <a class=\"btn\">{$_SESSION['user']['name']}</a>
                <a class=\"btn\" href=\"logout.php\">logout</a>
            </div>
        ";
    } else {
        echo '
            <div class="nav top fixed underline reverse">
                <a class="btn" href="login.php">login</a>
                <a class="btn" href="register.php">register</a>
            </div>
        ';
    }
    echo '<header class="header">';
    echo '
            <div>
        <a href = "index.php" > <h1 > Forum Board </h1 > </a >
    </div >
</header > ';
}


function footerInit(): void
{
    echo '
<footer class="foot">
<div>created by <a href="https://github.com/hagi0929" class ="blue">hagi0929<a> with ❤️</div>
</footer >
</body >
</html >
';
}

?>