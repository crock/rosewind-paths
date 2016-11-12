<?php
    // Get required files
    require('config.php');
    require('authenticate.php');

    // Global vars
    $all_categories = get_categories();

    $parent_categories = array_values(array_filter($all_categories, function($category) {
        if ($category['category_parent'] == 0) {
            return true;
        }
    }));

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
        $results = array();

        if (NO_DB) {
            return $results;
        }

        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($connection->connect_error) {
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
