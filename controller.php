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
    define("RESULT_NUM", 12);

    // Global pagination variables
    $RESULT_START = 1;
    $RESULT_END = RESULT_NUM;
    $RESULT_COUNT = 0;

    function rwp_head($title) {
        $head = file_get_contents(DOC_ROOT . 'inc/head.php');

        return str_replace('%TITLE%', $title, $head);
    }

    function authenticate_user($data) {
		$default_user = "admin";
		$default_pass = "test123";
		$errors = array();

		if ($data["username"] != $default_user) {
			$errors[] = "User Not Found";
		}

		if ($data["password"] != $default_pass) {
			$errors[] = "Incorrect Password";
		}

		if (empty($errors)) {
			session_start();

			$_SESSION["loggedIn"] = true;

			header("Location: home.php");
		} else {
			header("Location: signin.php?error1={$errors[0]}&error2={$errors[1]}");
		}
    }

    if ($_POST != NULL) {
	    authenticate_user($_POST);
	}

    function get_products($query = "") {
        $query = "SELECT * FROM products" . ($query = " " . $query ?: "");

        return safe_query($query);
    }

    function get_paginated_products() {
        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM products ";
        $wheres = array();
        $ands = array();

        if (isset($_REQUEST['search'])) {
            $wheres[] = "product_name LIKE '%" . $_REQUEST['search'] . "%' OR description LIKE '%" . $_REQUEST['search'] . "%' OR category LIKE '%" . $_REQUEST['search'] . "%'";
        }

        if (isset($_REQUEST['type'])) {
            $query .= " INNER JOIN categories ON products.category = categories.category_id";
            $wheres[] = "categories.category_slug = '" . $_REQUEST['type'] . "'";
        }

        $query .= (!empty($wheres)) ? " WHERE " . implode(" OR ", $wheres) : "";

        if (isset($_REQUEST['minpr'])) {
            $ands[] = "price >= '" . $_REQUEST['minpr'] . "'";
        }

        if (isset($_REQUEST['maxpr'])) {
            $ands[] = "price <= '" . $_REQUEST['maxpr'] . "'";
        }

        if (!empty($ands)) {
            if (empty($wheres)) {
                $query .= " WHERE ";
            }

            $query .= implode(" AND ", $ands);
        }

        if (isset($_REQUEST['sort'])) {
            $sort_parts = explode('-', $_REQUEST['sort']);

            $query .= " ORDER BY " . $sort_parts[0];

            if ($sort_parts[1] === 'desc') {
                $query .= " DESC";
            }

        }

        $query .= " LIMIT " . RESULT_NUM;

        if (isset($_REQUEST['page'])) {
            $current_page = $_REQUEST['page'];
            $query .= " OFFSET " . (($_REQUEST['page'] - 1) * RESULT_NUM);
        }

        $results = array(
            'products' => safe_query($query, true),
            'pagination' => page_pagination('catalog.php'),
        );

        if ($results['products'] === false) {
            $results['products'] = array();
        }

        return $results;
    }

    function page_pagination($page) {
        global $RESULT_START, $RESULT_END, $RESULT_COUNT;
        $pagination = array();
        $current_page = 1;

        $total_pages = ceil($RESULT_COUNT / RESULT_NUM);

        if (isset($_REQUEST['page'])) {
            $current_page = $_REQUEST['page'];
            $RESULT_START = ($current_page - 1) * RESULT_NUM + 1;

            unset($_REQUEST['page']);
        }

        $RESULT_END = min($RESULT_START + RESULT_NUM - 1, $RESULT_COUNT);

        $page_url = basename($page) . "?" . http_build_query($_REQUEST);

        for ($i = 1; $i < $total_pages + 1; $i++) {
            $pagination[$i] = array(
                'current' => ($i == $current_page) ? true : false,
                'url' => $page_url . "&page=" . $i
            );
        }

        return $pagination;
    }

    function get_orders($query = "") {
        $query = "SELECT * FROM orders" . ($query = " " . $query ?: "");

        return safe_query($query);
    }

    function get_categories($query = "") {
        $query = "SELECT * FROM categories" . ($query = " " . $query ?: "");

        return safe_query($query);
    }

    function get_reviews($product_id, $limit) {
        return safe_query("SELECT * FROM reviews WHERE product_id = " . $product_id . " LIMIT " . $limit);
    }

    function safe_query($query, $count_results = false) {
        global $RESULT_COUNT;
        $statement = false;
        $results = array();

        if (NO_DB) {
            return $results;
        }

        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($connection->connect_errno) {
            return admin_error("Connection error: " . $connection->connect_error);
        }

        if (!($statement = $connection->query($query))) {
            return false;
        }

        if ($count_results) {
            $RESULT_COUNT = $connection->query("SELECT FOUND_ROWS()")->fetch_assoc();
            $RESULT_COUNT = $RESULT_COUNT['FOUND_ROWS()'];
        }

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
?>
