<?php
    define("DOC_ROOT", getcwd() . '/');

    define("DB_HOST", "sulley.cah.ucf.edu");
    define("DB_USER", "dig4530c_007");
    define("DB_PASS", "knights123!");
    define("DB_NAME", "dig4530c_007");

    function rwp_head($title) {
        $head = file_get_contents(DOC_ROOT . 'inc/head.php');

        return str_replace('%TITLE%', $title, $head);
    }

    function get_products($limit) {
        return safe_query("SELECT * FROM products LIMIT " . $limit);
    }

    function get_orders($limit) {
        return safe_query("SELECT * FROM orders LIMIT " . $limit);
    }

    function safe_query($query) {
        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $results = false;

        if ($connection->connect_errno) {
            echo "Connection error: " . $connection->connect_error;
        } else if (!($results = $connection->query($query))) {
            echo "Query error: " . $connection->error;
        }

        $connection->close;

        return $results;
    }
?>
