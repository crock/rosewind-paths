<?php
    // Global pagination variables
    $RESULT_START = 1;
    $RESULT_END = RESULT_NUM;
    $RESULT_COUNT = 0;
    $SORT_MODES = array(
        'default'           => 'Default',
        'price-desc'        => 'Price (high to low)',
        'price-asc'         => 'Price (low to high)',
        'avg_rating-desc'   => 'Average rating'
    );

    function get_product_results($page) {
        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM products";
        $wheres = array();
        $ands = array("status > '0'");

        if (isset($_GET['q']) && $_GET['q']) {
            $wheres[] = "product_name LIKE '%{$_GET['q']}%' OR description LIKE '%{$_GET['q']}%' OR category LIKE '%{$_GET['q']}%'";
        }

        if (isset($_GET['type']) && $_GET['type'] != 'all') {
            $wheres[] = "categories.category_slug = '{$_GET['type']}'";

            $query .= " INNER JOIN categories ON products.category = categories.category_id";
        }

        if (isset($_GET['minpr']) && $_GET['minpr']) {
            $ands[] = "price >= '{$_GET['minpr']}'";
        }

        if (isset($_GET['maxpr']) && $_GET['maxpr']) {
            $ands[] = "price <= '{$_GET['maxpr']}'";
        }

        $query .= " WHERE";

        if (!empty($wheres)) {
            $query .= " " . implode(" OR ", $wheres);

            $query .= " AND";
        }

        if (!empty($ands)) {
            $query .= " " . implode(" AND ", $ands);
        }

        if (isset($_GET['sort']) && $_GET['sort'] != 'default') {
            $sort_parts = explode('-', $_GET['sort']);

            $query .= " ORDER BY {$sort_parts[0]}";

            if ($sort_parts[1] === 'desc') {
                $query .= " DESC";
            }
        }

        $query .= " LIMIT " . RESULT_NUM;

        if (isset($_GET['page'])) {
            $current_page = $_GET['page'];
            $query .= " OFFSET " . (($_GET['page'] - 1) * RESULT_NUM);
        }

        $results = array(
            'products' => safe_query($query, true),
            'pagination' => result_pagination($page),
        );

        if ($results['products'] === false) {
            $results['products'] = array();
        }

        return $results;
    }

    function get_user_results($page) {
        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM users";

        if (isset($_GET['page'])) {
            $current_page = $_GET['page'];
            $query .= " OFFSET " . (($_GET['page'] - 1) * RESULT_NUM);
        }

        $query .= " LIMIT " . RESULT_NUM;

        $results = array(
            'users' => safe_query($query, true),
            'pagination' => result_pagination($page)
        );

        if ($results['users'] === false) {
            $results['users'] = array();
        }

        return $results;
    }

    function get_order_results($page) {
        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM orders";

        if (isset($_GET['page'])) {
            $current_page = $_GET['page'];
            $query .= " OFFSET " . (($_GET['page'] - 1) * RESULT_NUM);
        }

        $query .= " LIMIT " . RESULT_NUM;

        $results = array(
            'orders' => safe_query($query, true),
            'pagination' => result_pagination($page)
        );

        if ($results['orders'] === false) {
            $results['orders'] = array();
        }

        return $results;
    }

    function result_pagination($page) {
        global $RESULT_START, $RESULT_END, $RESULT_COUNT;
        $pagination = array();
        $current_page = 1;

        $result_pages = ceil($RESULT_COUNT / RESULT_NUM);

        if ($result_pages > 1) {
            if (isset($_GET['page'])) {
                $current_page = $_GET['page'];
                unset($_GET['page']);

                $RESULT_START = ($current_page - 1) * RESULT_NUM + 1;
            }

            $RESULT_END = min($RESULT_START + RESULT_NUM - 1, $RESULT_COUNT);
            $page_url = basename($page) . "?" . http_build_query($_GET);

            if ($current_page > 1) {
                $pagination[] = '<li title="Previous page"><a href="' . $page_url . '&page=' . ($current_page - 1)  . '"><</a></li>';
            }

            for ($i = 1; $i < $result_pages + 1; $i++) {
                $pagination[] = '<li title="Page ' . $i . '"' . (($i == $current_page) ? ' class="active"' : '') . '><a href="' . $page_url . '&page=' . $i . '">' . $i . '</a></li>';
            }

            if ($current_page < $result_pages) {
                $pagination[] = '<li title="Next page"><a href="' . $page_url . '&page=' . ($current_page + 1) . '">></a></li>';
            }
        } else {
            $RESULT_END = min($RESULT_END, $RESULT_COUNT);
        }

        return $pagination;
    }
?>
