<?php
    define('DOC_ROOT', getcwd() . '/');

    function rwp_head($title) {
        $head = file_get_contents(DOC_ROOT . 'inc/head.php');

        return str_replace('%TITLE%', $title, $head);
    }
    
    function authenticate_user($data) {
		$default_user = "admin";
		$default_pass = "test123";
		$errors = [];
		
		if($data["username"] != $default_user) {
			$errors += ["Error1" => "User Not Found"];
		}
		if($data["password"] != $default_pass) {
			$errors += ["Error2" => "Incorrect Password"];
		}
		
		if($errors == NULL) {
			session_start();
			$_SESSION["loggedIn"] = true;
			header("Location: home.php");
		} else {
			header("Location: signin.php?error1={$errors['Error1']}?error2={$errors['Error2']}");
		}
    }
    
    if($_POST != NULL) {
	    authenticate_user($_POST);
    }
?>
