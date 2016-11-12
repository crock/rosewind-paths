<?php
	$items = array();
	
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
	        
			setcookie("user", $user, time() + 300, "/");
            $date_created = date('Y-m-d H:i:s');
            safe_query("INSERT INTO session_log (username, date_created) VALUES('{$user}', '{$date_created}')", false, false);

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
	    session_unset();
        session_destroy();
        header("Location: home.php");
    }
    
    function get_cart() {
	    $items = safe_query("SELECT * FROM carts");
	    
	    if (!empty($items)) {
		    return $items;
	    } else {
			admin_error("No items in cart.");
	    }
    }
    
    function add_to_cart($data) {
	    $product_id = $data["id"];
	    $quantity = 1;
	    $cart_id = 1;
	    $json = "";
	    
	    $q = safe_query("SELECT products FROM carts WHERE cart_id='$cart_id'");
		
		if (!empty($q)) {
			$json = json_decode($q[0]['products'], true);
			$json[$product_id] = "$quantity";
		} else {
			$products = array("$product_id" => "$quantity");
			$products = json_encode($products);
			
			safe_query("INSERT INTO carts (products) VALUES ('{$products}') WHERE cart_id='$cart_id'");	
		}
		
		return true;
	    
    }
    
    	if ($_GET["action"] == "add") {
	    	add_to_cart($_GET);
    	}
    
    function remove_from_cart($data) {
	    
    }
    
     	if ($_GET["action"] == "remove") {
	    	remove_from_cart($_GET);
    	}
    
    function clear_cart() {
	    
    }
    
    	if ($_GET["action"] == "clear") {
	    	clear_cart($_GET);
    	}
?>
