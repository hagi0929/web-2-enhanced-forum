<?php
require_once("connection.php");

session_start();

if (isset($_SESSION['user'])) {
    header("location: welcome.php");
}

$emailInit = "";
$passwordInit = "";
if (isset($_REQUEST['login_btn'])) {
    $email = filter_var(strtolower($_REQUEST['email']), FILTER_SANITIZE_EMAIL);
    $password = strip_tags($_REQUEST['password']);
    if (empty($email)) {
        $errormsg[0][] = "Email is missing";
    } else {
        $emailInit = $_REQUEST['email'];
    }
    if (empty($password)) {
        $errormsg[1][] = "Password is missing";
    } else {
        $passwordInit = $_REQUEST['password'];
    }
    if (empty($errormsg)) {
        try {
            $query1 = "SELECT * FROM users WHERE email=:email";
            $select_stat = $db->prepare($query1);
            $select_stat->execute([":email" => $email]);
            $row = $select_stat->fetch(PDO::FETCH_ASSOC);
            if (isset($row['password']) and password_verify($password, $row['password'])) {
                $_SESSION['user']['name'] = $row['name'];
                $_SESSION['user']['email'] = $row['email'];
                $_SESSION['user']['id'] = $row['id'];
            } else {
                $errormsg[2][] = "wrong email or password";
                $passwordInit = "";
            }
        } catch (PDOEXCEPTION $e) {
            echo $pdoError = $e->getMessage();
        }
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
            crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
<div class="container">
    <?php
    if (isset($errormsg[2])) {
        foreach ($errormsg[2] as $longinError) {
            echo "<p class=\"alert alert-danger\">" . $longinError . "</p>";
        }
    }
    ?>
    <form action="index.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="jane@doe.com" value="<?= $emailInit ?>">
        </div>
        <?php
        if (isset($errormsg[0])) {
            $displayErr = "";
            foreach ($errormsg[0] as $emailError) {
                echo "<p class=\"small text-danger\">$emailError</p>";
            }
        }
        ?>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="" value="<?= $passwordInit ?>">
        </div>
        <?php
        if (isset($errormsg[1])) {
            $displayErr = "";
            foreach ($errormsg[1] as $emailError) {
                echo "<p class=\"small text-danger\">$emailError</p>";
            }
        }
        ?>
        <button type="submit" name="login_btn" class="btn btn-primary">Login</button>
    </form>
    No Account? <a class="register" href="register.php">Register Instead</a>
</div>
</body>

</html>