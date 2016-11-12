<?php
    session_start();

    if (empty($_SESSION)) {
        $date_created = date('Y-m-d H:i:s');

        safe_query("INSERT INTO session_log (username, date_created) VALUES('guest', '{$date_created}')");

        $_SESSION['id'] = $LAST_INSERT_ID;
        $_SESSION['username'] = 'guest';
        $_SESSION['logged_in'] = false;
        $_SESSION['cart_id'] = 0;
        $_SESSION['cart'] = array();
    }

    if (isset($_POST['signin'])) {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);

        $userdata = safe_query("SELECT * FROM customer_info WHERE username = '{$username}' AND password = '{$password}'");

        if (empty($userdata)) {
            header("Location: signin.php?error=invalid");
        } else {
            safe_query("UPDATE session_log SET username = '{$username}' WHERE session_log_id = '{$_SESSION['id']}'");

            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;

            header("Location: home.php");
        }
    }

    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        $errors = array();

        if (safe_query("SELECT * FROM customer_info WHERE username = '{$username}' OR email = '{$email}'")) {
            $errors[] = "user_taken";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "email_invalid";
        }

        if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/", $email) === false) {
            $errors[] = "pass_invalid";
        }

        if ($password !== sha1($_POST['confirm-password'])) {
            $errors[] = "not_matching";
        }

        if (empty($errors)) {
            if (safe_query("INSERT INTO customer_info (username, email, password) VALUES ('{$username}', '{$email}', '{$password}');")) {
                header("Location: signin.php?alert=registered");
            } else {
                header("Location: register.php?alert=error");
            }
        } else {
            header("Location: register.php?email={$email}&username={$username}&errors=" . base64_encode(serialize($errors)));
        }
    }

    if (isset($_GET['signout'])) {
        $date_out = date('Y-m-d H:i:s');

        safe_query("UPDATE session_log SET date_out = '{$date_out}' WHERE session_log_id = '{$_SESSION['id']}'");

        session_unset();
        session_destroy();

        $_SESSION['id'] = 0;
        $_SESSION['username'] = 'guest';
        $_SESSION['logged_in'] = false;

        header("Location: home.php");
    }
?>
