<?php
require_once("init.php");
if (isset($_SESSION['user'])) {
    header("location: index.php");
}
$post_data = json_decode(file_get_contents('php://input'), true);
if (isset($post_data)) {
    $email = filter_var(strtolower($post_data['email']), FILTER_SANITIZE_EMAIL);
    $password = strip_tags($post_data['password']);
    if (empty($email)) {
        $errormsg[0][] = "Email is missing";
    } else {
        $emailInit = $post_data['email'];
    }
    if (empty($password)) {
        $errormsg[1][] = "Password is missing";
    } else {
        $passwordInit = $post_data['password'];
    }
    if (empty($errormsg)) {
        try {
            $query1 = "SELECT * FROM users WHERE email=:email";
            $select_stat = $db->prepare($query1);
            $select_stat->execute([":email" => $email]);
            $row = $select_stat->fetch(PDO::FETCH_ASSOC);


            if (isset($row['password']) and password_verify($password, $row['password'])) {
                $_SESSION['user']['username'] = $row['username'];
                $_SESSION['user']['email'] = $row['email'];
                $_SESSION['user']['userId'] = $row['userId'];
            } else {
                $errormsg[2][] = "wrong email or password";
                $passwordInit = "";
            }
        } catch (PDOEXCEPTION $e) {
            echo $pdoError = $e->getMessage();
        }
    }
    if (isset($errormsg)) {
        echo json_encode($errormsg);
    } else {
        echo null;
    }
    exit();
}
top("login");
headerInit();
navigator();
?>
    <body>
    <div class="container">
        <p class="alert alert-danger" id="loginErr2" style="display: none"></p>
        <?php
        if (isset($_GET['ss'])) {
            echo "<p class=\"alert alert-danger\">" . "Must login to create post" . "</p>";
        }
        ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" id="loginEmail" class="form-control" placeholder="">
        </div>
        <?php
        /*        if (isset($errormsg[0])) {
                    $displayErr = "";
                    foreach ($errormsg[0] as $emailError) {
                        echo "<p class="small text-danger">$emailError</p>";
                    }
                }
                */ ?>
        <p class="small text-danger" id="loginErr0" style="display: none"></p>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="loginPassword" class="form-control" placeholder="">
        </div><!--
        --><?php
        /*        if (isset($errormsg[1])) {
                    $displayErr = "";
                    foreach ($errormsg[1] as $emailError) {
                        echo "<p class=\"small text-danger\">$emailError</p>";
                    }
                }
                */ ?>
        <p class="small text-danger" id="loginErr1" style="display: none"></p>
        <button type="submit" onclick="tryLoggingIn()" name="login_btn" class="btn">Login</button>
        No Account? <a class="register blue" href="register.php">Register Instead</a>
    </div>
    </body>
    <script>
        function tryLoggingIn() {
            let loginEmail = document.querySelector('#loginEmail').value;
            let loginPassword = document.querySelector('#loginPassword').value;
            fetch('login.php', {
                method: 'POST',
                cache: 'no-cache',
                headers: {
                    'Content-Type': 'application/json; charset=utf-8'
                },
                body: JSON.stringify({
                    email: loginEmail,
                    password: loginPassword
                })
            })
                .then((res) => res.text())
                .then((data) => {
                    document.querySelector("#loginErr0").style.display = 'none';
                    document.querySelector("#loginErr0").innerHTML = "";
                    document.querySelector("#loginErr1").style.display = 'none';
                    document.querySelector("#loginErr1").innerHTML = "";
                    document.querySelector("#loginErr2").style.display = 'none';
                    document.querySelector("#loginErr2").innerHTML = "";
                    if (data) {
                        let errMsgJson = JSON.parse(data);
                        for (let errorNum in errMsgJson) {
                            console.log("#loginErr" + String(errorNum))
                            document.querySelector("#loginErr" + String(errorNum)).style.display = 'block';
                            document.querySelector("#loginErr" + String(errorNum)).innerHTML = errMsgJson[errorNum];
                        }
                    } else {
                        window.location.href = 'index.php';
                    }
                });
        }

    </script>
<?php
footerInit();
?>