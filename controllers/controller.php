<?php
    // Get required files
    require('config.php');
    require('sessions.php');

    // Global vars
    $all_categories = get_categories();

    $parent_categories = array_values(array_filter($all_categories, function($category) {
        if ($category['category_parent'] == 0) {
            return true;
        }
    }));

    $LAST_INSERT_ID = 0;

    function rwp_head($title) {
        $head = file_get_contents(DOC_ROOT . 'models/head.php');

        return str_replace('%TITLE%', $title, $head);
    }

    function get_products($query = "") {
        $query = "SELECT * FROM products" . ($query = " " . $query ?: "");
        $products = safe_query($query);

        return $products;
    }

    function single_product($product_id) {
        $products = get_products("WHERE product_id = '{$product_id}'");

        return $products[0];
    }

    function get_orders($customer_id) {
        $query = "SELECT * FROM orders WHERE id = '{$customer_id}'";

        return safe_query($query);
    }

    function get_categories($query = "") {
        $query = "SELECT * FROM categories" . ($query = " " . $query ?: "");

        return safe_query($query);
    }

    function get_reviews($product_id) {
        return safe_query("SELECT * FROM reviews WHERE product_id = '{$product_id}' LIMIT 10");
    }

    function get_shopping_cart() {
        if (isset($_SESSION['cart'])) {
            $query = "WHERE product_id = '" . implode("' OR product_id = '", array_keys($_SESSION['cart'])) . "'" . ($query = " " . $query ?: "");

            return get_products($query);
        }
    }

    function safe_query($query, $count_results = false) {
        global $RESULT_COUNT, $LAST_INSERT_ID;
        $statement = false;
        $result_rows = array();

        if (NO_DB) {
            return $result_rows;
        }

        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($connection->connect_error) {
            return admin_error("Connection error: " . $connection->connect_error);
        }

        $query = stripslashes($connection->escape_string($query));

        if (!($results = $connection->query($query))) {
            return admin_error("Query error: " . $connection->error);
        } else if ($results === true) {
            $LAST_INSERT_ID = $connection->insert_id;
	        $connection->close();

	        return true;
        }

        if ($count_results) {
            $RESULT_COUNT = $connection->query("SELECT FOUND_ROWS()")->fetch_assoc();
            $RESULT_COUNT = $RESULT_COUNT['FOUND_ROWS()'];
        }

        while ($row = $results->fetch_assoc()) {
            $result_rows[] = $row;
        }

        $results->close();
        $connection->close();

        return $result_rows;
    }

    function admin_error($error = "Unknown error") {
        if (DEBUG) {
            echo $error;
        }

        return false;
    }

?>
