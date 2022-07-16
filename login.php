<?php
require_once("init.php");
if (isset($_SESSION['user'])) {
    header("location: index.php");
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
                header("location: index.php");

            } else {
                $errormsg[2][] = "wrong email or password";
                $passwordInit = "";
            }
        } catch (PDOEXCEPTION $e) {
            echo $pdoError = $e->getMessage();
        }
    }
}
top("login");
headerInit();
navigator();
?>
<body>
<div class="container">
    <?php
    if (isset($errormsg[2])) {
        foreach ($errormsg[2] as $longinError) {
            echo "<p class=\"alert alert-danger\">" . $longinError . "</p>";
        }
    }
    if (isset($_GET['ss'])){
        echo "<p class=\"alert alert-danger\">" . "Must login to create post" . "</p>";
    }
    ?>
    <form action="login.php" method="post">
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
    No Account? <a class="register blue" href="register.php">Register Instead</a>
</div>
</body>
<?php
footerInit();
?>