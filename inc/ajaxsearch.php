<?php
    require_once('../controller.php');

    if (isset($_REQUEST)) {
        $search_results = get_paginated_products();
        var_dump($search_results);
    }
?>
