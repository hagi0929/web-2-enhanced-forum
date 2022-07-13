<?php
require_once("connection.php");

session_start();

if (isset($_SESSION['user'])) {
    header("location: welcome.php");
}

$nameInit = "";
$emailInit = "";
$passwordInit = "";
if (isset($_REQUEST['register_btn'])) {
    $name = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var(strtolower($_REQUEST['email']), FILTER_SANITIZE_EMAIL);
    $password = strip_tags($_REQUEST['password']);
    if (empty($name)) {
        $errormsg[0][] = "Name required";
    } else {
        $nameInit = $_REQUEST['name'];
    }

    if (empty($email)) {
        $errormsg[1][] = "Email required";
    } else {
        $emailInit = $_REQUEST['email'];
    }

    if (empty($password)) {
        $errormsg[2][] = "Password required";
    } else if (mb_strlen($password) < 8) {
        $errormsg[2][] = "Password needs to be more than 8 characters";
        $passwordInit = $_REQUEST['password'];
    } else {
        $passwordInit = $_REQUEST['password'];
    }
    if (empty($errormsg)) {
        try {
            $query1 = "SELECT name, email FROM users WHERE email=:email";
            $select_stat = $db->prepare($query1);
            $select_stat->execute([":email" => $email]);
            $row = $select_stat->fetch(PDO::FETCH_ASSOC);
            if (empty($row["email"]) or $row["email"] !== $email) {
                $errormsg[1][] = "Email address already exists";
            } else{
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $created = new DateTime();
                $query = "INSERT INTO users (name, email, password, created) VALUES (:name, :email, :password, NOW())";
                $insert_stat = $db -> prepare($query);
                $insert_stat->execute([':name' => $name, ':email' => $email, ':password' => $hashed_password]);
                header("location: index.php");
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
    <title>Register</title>
</head>
<body>
<div class="container">

    <form action="register.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Jane Doe" value="<?= $nameInit ?>">
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
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="jane@doe.com" value="<?= $emailInit ?>">
        </div>
        <?php
        if (isset($errormsg[1])) {
            $displayErr = "";
            foreach ($errormsg[1] as $emailError) {
                echo "<p class=\"small text-danger\">$emailError</p>";
            }
        }
        ?>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="" value="<?= $passwordInit ?>">
        </div>
        <?php
        if (isset($errormsg[2])) {
            $displayErr = "";
            foreach ($errormsg[2] as $emailError) {
                echo "<p class=\"small text-danger\">$emailError</p>";
            }
        }
        ?>
        <button type="submit" name="register_btn" class="btn btn-primary">Register Account</button>
    </form>
    Already Have an Account? <a class="register" href="index.php">Login Instead</a>

</div>
</body>
</html>
