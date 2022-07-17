<?php
require_once("init.php");


if (isset($_SESSION['user'])) {
    header("location: welcome.php");
}

$usernameInit = "";
$emailInit = "";
$passwordInit = "";
if (isset($_REQUEST['register_btn'])) {
    if (preg_match("/^[a-zA-Z가-힣 ]*$/", $_REQUEST['username'])){
        $username = strip_tags($_REQUEST['username']);
    }else{
        $errormsg[0][] = "Invalid username: only char allowed";
    }
    $email = filter_var(strtolower($_REQUEST['email']), FILTER_SANITIZE_EMAIL);
    $password = strip_tags($_REQUEST['password']);
    if (empty($username)) {
        $errormsg[0][] = "username required";
    } else {
        $usernameInit = $_REQUEST['username'];
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
            $query1 = "SELECT username, email FROM users WHERE email=:email";
            $select_stat = $db->prepare($query1);
            $select_stat->execute([":email" => $email]);
            $row = $select_stat->fetch(PDO::FETCH_ASSOC);
            if (isset($row["email"])) {
                $errormsg[1][] = "Email address already exists";
            } else{
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $created = new DateTime();
                $query = "INSERT INTO users (username, email, password, created) VALUES (:username, :email, :password, NOW())";
                $insert_stat = $db -> prepare($query);
                $insert_stat->execute([':username' => username, ':email' => $email, ':password' => $hashed_password]);
                header("location: login.php");
            }
        } catch (PDOEXCEPTION $e) {
            echo $pdoError = $e->getMessage();
        }
    }
}
top("register");
headerInit();
navigator();
?>
<body>
<div class="container">

    <form action="register.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Name</label>
            <input type="text" name="username" class="form-control" placeholder="" value="<?= $usernameInit ?>">
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
            <input type="email" name="email" class="form-control" placeholder="" value="<?= $emailInit ?>">
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
    Already Have an Account? <a class="register blue" href="login.php">Login Instead</a>

</div>
</body>
</html>
<?php footerInit(); ?>