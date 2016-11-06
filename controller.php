<?php
    // PATHS
    define("DOC_ROOT", getcwd() . '/');

    // DB CONFIG
    define("DB_HOST", "sulley.cah.ucf.edu");
    define("DB_USER", "dig4530c_007");
    define("DB_PASS", "knights123!");
    define("DB_NAME", "dig4530c_007");

    // DEBUG FLAGS
    define("IS_ADMIN", true);
    define("NO_DB", false);

    // PAGE SETUP
    define("FEATURE_NUM", 3);
    define("RESULT_NUM", 16);

    // Global pagination variables
    $RESULT_COUNT = 0;
    $RESULT_START = 1;
    $RESULT_END = 16;

    function rwp_head($title) {
        $head = file_get_contents(DOC_ROOT . 'inc/head.php');

        return str_replace('%TITLE%', $title, $head);
    }

    function get_products($query = "") {
        $query = "SELECT * FROM products" . ($query = " " . $query ?: "");

        return safe_query($query);
    }

    function get_paginated_products() {
        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM products2";
        $conditions = array();

        if (isset($_REQUEST['search'])) {
            $conditions[] = "product_name LIKE '%" . $_REQUEST['search'] . "%' OR description LIKE '%" . $_REQUEST['search'] . "%'";
        }

        if (isset($_REQUEST['type'])) {
            $conditions[] = "category = '" . implode("' OR category = '", $_REQUEST['type']) . "'";
        }

        $query .= (!empty($conditions)) ? " WHERE " . implode(" OR ", $conditions) : "";

        if (isset($_REQUEST['sort'])) {
            $query .= " ORDER BY " . $_REQUEST['sort'];
        }

        $query .= " LIMIT " . RESULT_NUM;

        if (isset($_REQUEST['page'])) {
            $current_page = $_REQUEST['page'];
            $query .= " OFFSET " . (($_REQUEST['page'] - 1) * RESULT_NUM);
        }

        $results = array(
            'products' => safe_query($query),
            'pages' => page_pagination('catalog.php'),
        );

        return $results;
    }

    function page_pagination($page) {
        global $RESULT_COUNT, $RESULT_START, $RESULT_END;
        $pagination = array();
        $current_page = 1;
        $page_num = 1;

        if (isset($_REQUEST['page'])) {
            $current_page = $_REQUEST['page'];
            $RESULT_START = ($current_page - 1) * RESULT_NUM + 1;

            unset($_REQUEST['page']);
        }
        $RESULT_END = min($RESULT_START + 15, $RESULT_COUNT);

        $page_url = basename($page) . "?" . http_build_query($_REQUEST);

        if ($RESULT_COUNT > RESULT_NUM) {
            $page_num = ceil($RESULT_COUNT / RESULT_NUM);

            for ($i = 1; $i < $page_num + 1; $i++) {
                $pagination[$i] = array(
                    'current' => ($i === $current_page) ? true : false,
                    'url' => $page_url . "&page=" . $i
                );
            }
        } else {
            $RESULT_END = $RESULT_COUNT;

            $pagination[1] = array(
                'current' => true,
                'url' => $page_url
            );
        }

        return $pagination;
    }

    function get_orders($query = "") {
        $query = "SELECT * FROM orders" . ($query = " " . $query ?: "");

        return safe_query($query);
    }

    function get_categories() {
        $query = "SELECT * FROM categories";

        return safe_query($query);
    }

    function get_reviews($product_id, $limit) {
        return safe_query("SELECT * FROM reviews WHERE product_id = " . $product_id . " LIMIT " . $limit);
    }

    function safe_query($query) {
        global $RESULT_COUNT;
        $statement = false;
        $results = array();

        if (NO_DB) {
            return $results;
        }

        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($connection->connect_error) {
            return admin_error("Connection error: " . $connection->connect_error);
        }

        if (!($statement = $connection->query($query))) {
            return admin_error("Query error: " . $connection->error);
        }

        $RESULT_COUNT = $connection->query("SELECT FOUND_ROWS()")->fetch_assoc();
        $RESULT_COUNT = $RESULT_COUNT['FOUND_ROWS()'];

        while ($row = $statement->fetch_assoc()) {
            $results[] = $row;
        }

        $statement->close();
        $connection->close();

        return $results;
    }

    function admin_error($error = "Unknown error") {
        if (IS_ADMIN) {
            echo $error;
        }

        return false;
    }

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
