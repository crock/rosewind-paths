<?php
    // PATHS
    define("DOC_ROOT", getcwd() . '/');

    // DB VARIABLES
    define("DB_HOST", "sulley.cah.ucf.edu");
    define("DB_USER", "dig4530c_007");
    define("DB_PASS", "knights123!");
    define("DB_NAME", "dig4530c_007");

    // DEBUG FLAGS
    define("IS_ADMIN", true);
    define("NO_DB", true);

    // PAGE SETUP
    define("FEATURE_NUM", 3);

    function rwp_head($title) {
        $head = file_get_contents(DOC_ROOT . 'inc/head.php');

        return str_replace('%TITLE%', $title, $head);
    }

    if (PAGE_TITLE === 'Catalog' && $_GET && $_GET['item']) {

    }

    function get_products($flags = "") {
        return safe_query("SELECT * FROM products2" . ($flags ? " " . $flags : ""));
    }

    function get_orders($limit) {
        return safe_query("SELECT * FROM orders LIMIT " . $limit);
    }

    function get_categories() {
        return safe_query("SELECT * FROM categories");
    }

    function get_reviews($product_id, $limit) {
        return safe_query("SELECT * FROM reviews WHERE product_id = " . $product_id . " LIMIT " . $limit);
    }

    function safe_query($query) {
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
            return admin_error("Query error: " . $connection->error);
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
