<?php
    function authenticate_user($data) {
        $user = $data['username'];
        $pass = sha1($data['password']);

        $query = safe_query("SELECT username,password FROM customer_info WHERE username='$user'");

        $errors = array();

        if ($query[0]["username"] != $user) {
            $errors[0] = "Invalid username";
        }

        if ($query[0]["password"] != $pass) {
            $errors[1] = "Invalid password";
        }

        if (empty($errors)) {
            session_start();

            $_SESSION["loggedIn"] = true;

            header("Location: home.php");
        } else {
            header("Location: signin.php?error1={$errors[0]}&error2={$errors[1]}");
        }
    }

        if ( isset($_POST['signin']) ) {
            authenticate_user($_POST);
        }

    function register($data) {
        $errors = array();
        $result = array();
        $username = $data["username"];
        $email = $data["email"];
        $password = $data["password"];

        // Error Checking
        $dbemail = safe_query("SELECT * FROM customer_info WHERE email='$email'");
        if ($dbemail != NULL) {
            $errors[0] = "Email already exists";
        }
        $dbuser = safe_query("SELECT * FROM customer_info WHERE username='$username'");
        if ($dbuser != NULL) {
            $errors[1] = "Username already exists";
        }
        if ($password == NULL) {
            $errors[2] = "Password cannot be blank";
        }
        if ($password != $data["confirm-password"]) {
            $errors[3] = "Passwords do not match";
        }

        $password = sha1($data["password"]);

        if(empty($errors)) {
            $result = safe_query("INSERT INTO customer_info (username, email, password) VALUES ('{$username}', '{$email}', '{$password}');");
            if (!empty($result)) {
                header("Location: signin.php?alert=Thanks for registering! Please sign in.");
            } else {
                header("Location: register.php?alert=Error registering. Please try again!");
            }

        } else {
            header("Location: register.php?error1={$errors[0]}&error2={$errors[1]}&error3={$errors[2]}&error4={$errors[3]}");
        }

    }

        if ( isset($_POST['register']) ) {
            register($_POST);
        }

    function logout() {
        session_destroy();
        header("Location: home.php");
    }
?>
