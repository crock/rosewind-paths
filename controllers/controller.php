<?php
	session_start();
    // Get required files
    require('config.php'); 
    require('authenticate.php');

    function rwp_head($title) {
        $head = file_get_contents(DOC_ROOT . 'models/head.php');

        return str_replace('%TITLE%', $title, $head);
    }

    function get_products($query = "") {
        $query = "SELECT * FROM products" . ($query = " " . $query ?: "");

        return safe_query($query);
    }

    function single_product($product_id) {
        return get_products("WHERE product_id = '{$product_id}'");
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
        $result_rows = array();

        if (NO_DB) {
            return $result_rows;
        }

        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($connection->connect_error) {
            return admin_error("Connection error: " . $connection->connect_error);
        }

        if (!($results = $connection->query($query))) {
            return false;
        } else if ($results === true) {
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
        if (IS_ADMIN) {
            echo $error;
        }

        return false;
    }

?>
