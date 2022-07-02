<?php
function connect(): bool|mysqli
{
    return mysqli_connect(
        'localhost',
        'datagrip',
        '63254088',
        'datagrip');
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
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="main.js"></script>
    <title>' . $title . '</title>
</head>
<body>';
}

function headerInit(): void
{
    echo '<header class="header">
    <div>
        <h1>Forum Board</h1>
    </div>
</header>';
}

function navBar($type): void
{
}

function footerInit(): void
{
    echo '
<footer>

</footer>
</body>
</html>
';
}

function loadJS(): void
{
echo "<script src='main.js'></script>";
}
?>