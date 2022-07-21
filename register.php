<?php
require_once("init.php");


if (isset($_SESSION['user'])) {
    header("location: index.php");
}

$usernameInit = "";
$emailInit = "";
$passwordInit = "";
$post_data = json_decode(file_get_contents('php://input'), true);
if (isset($post_data)) {
    if (preg_match("/^[a-zA-Z가-힣 ]*$/", $post_data['username'])) {
        $username = strip_tags($post_data['username']);
    } else {
        $errormsg[0][] = "Invalid username: only char allowed";
    }
    $email = filter_var(strtolower($post_data['email']), FILTER_SANITIZE_EMAIL);
    $password = strip_tags($post_data['password']);
    if (empty($username)) {
        $errormsg[0][] = "username required";
    } else {
        $usernameInit = $post_data['username'];
    }

    if (empty($email)) {
        $errormsg[1][] = "Email required";
    }
    else if(!preg_match("/([a-zA-Z0-9!#$%&’?^_`~-])+@([a-zA-Z0-9-])+(.com)+/", $email)){
        $errormsg[1][] = "Email is not valid";
    }
    else {
        $emailInit = $post_data['email'];
    }

    if (empty($password)) {
        $errormsg[2][] = "Password required";
    } else if (mb_strlen($password) < 8) {
        $errormsg[2][] = "Password needs to be more than 8 characters";
        $passwordInit = $post_data['password'];
    } else {
        $passwordInit = $post_data['password'];
    }
    if (empty($errormsg)) {
        try {
            $query1 = "SELECT username, email FROM users WHERE email=:email";
            $select_stat = $db->prepare($query1);
            $select_stat->execute([":email" => $email]);
            $row = $select_stat->fetch(PDO::FETCH_ASSOC);
            if (isset($row["email"])) {
                $errormsg[1][] = "Email address already exists";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $created = new DateTime();
                $query = "INSERT INTO users (username, email, password, created) VALUES (:username, :email, :password, NOW())";
                $insert_stat = $db->prepare($query);
                $insert_stat->execute([':username' => $username, ':email' => $email, ':password' => $hashed_password]);
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
top("register");
headerInit();
navigator();
?>
    <body>
    <div class="container">

            <div class="mb-3">
                <label for="username" class="form-label">Name</label>
                <input type="text" id="registerName" name="username" class="form-control" placeholder="" value="<?= $usernameInit ?>">
            </div>
            <?php
/*            if (isset($errormsg[0])) {
                $displayErr = "";
                foreach ($errormsg[0] as $emailError) {
                    echo "<p class=\"small text-danger\">$emailError</p>";
                }
            }
            */?>
            <p class="small text-danger" id="loginErr0" style="display: none"></p>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" id="registerEmail" name="email" class="form-control" placeholder="" value="<?= $emailInit ?>">
            </div>
            <?php
/*            if (isset($errormsg[1])) {
                $displayErr = "";
                foreach ($errormsg[1] as $emailError) {
                    echo "<p class=\"small text-danger\">$emailError</p>";
                }
            }
            */?>
            <p class="small text-danger" id="loginErr1" style="display: none"></p>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="registerPassword" name="password" class="form-control" placeholder="" value="<?= $passwordInit ?>">
            </div>
            <?php
/*            if (isset($errormsg[2])) {
                $displayErr = "";
                foreach ($errormsg[2] as $emailError) {
                    echo "<p class=\"small text-danger\">$emailError</p>";
                }
            }
            */?>
            <p class="small text-danger" id="loginErr2" style="display: none"></p>
            <button type="submit" onclick="tryRegister()" name="register_btn" class="btn">Register Account</button>
        Already Have an Account? <a class="register blue" href="login.php">Login Instead</a>

    </div>
    </body>
    <script>
        function tryRegister() {
            let registerName = document.querySelector('#registerName').value;
            let registerEmail = document.querySelector('#registerEmail').value;
            let registerPassword = document.querySelector('#registerPassword').value;
            fetch('register.php', {
                method: 'POST',
                cache: 'no-cache',
                headers: {
                    'Content-Type': 'application/json; charset=utf-8'
                },
                body: JSON.stringify({
                    username: registerName,
                    email: registerEmail,
                    password: registerPassword
                })
            })
                .then((res) => res.text())
                .then((data) => {
                    console.log(data)
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
<?php footerInit(); ?>