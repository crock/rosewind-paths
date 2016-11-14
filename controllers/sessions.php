<?php
    session_start();

    $SUBTOTAL = 0;
    $TOTAL_TAX = 0;
    $TOTAL_PRICE = 0;

    if (empty($_SESSION)) {
        create_session();
    }

    if (isset($_POST['sign_in']) && isset($_POST['username']) && isset($_POST['password'])) {
        sign_in($_POST['username'], $_POST['password']);
    }

    if (isset($_POST['register']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm-password'])) {
        register_user($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm-password']);
    }

    if (isset($_GET['sign_out'])) {
        sign_out();
    }

    if (isset($_GET['add'])) {
        add_to_cart($_GET['add']);

        unset($_GET['add']);
    }

    if (isset($_GET['remove'])) {
        remove_from_cart($_GET['remove']);

        unset($_GET['remove']);
    }

    function create_session($username = 'guest') {
        global $LAST_INSERT_ID;

        $session_create_date = date('Y-m-d H:i:s');

        safe_query("INSERT INTO session_log (username, date_created) VALUES('{$username}', '{$session_create_date}')");

        $_SESSION['session_id'] = $LAST_INSERT_ID;
        $_SESSION['username'] = 'guest';
        $_SESSION['customer_id'] = 0;
        $_SESSION['logged_in'] = false;
        $_SESSION['cart_id'] = 0;
        $_SESSION['cart'] = array();
    }

    function sign_in($username, $password) {
        $password = sha1($password);

        $user_data = safe_query("SELECT * FROM customer_info JOIN carts ON customer_info.cart_id = carts.cart_id WHERE username = '{$username}' AND password = '{$password}'");
        $user_data = $user_data[0];


        if (empty($user_data)) {
            header("Location: signin.php?alert=" . urlencode("Invalid username or password."));
        } else {
            safe_query("UPDATE session_log SET username = '{$username}' WHERE session_log_id = '{$_SESSION['session_id']}'");

            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;
            $_SESSION['cart_id'] = $user_data['cart_id'];
            $_SESSION['customer_id'] = $user_data['customer_info_id'];

            if (empty($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            $_SESSION['cart'] = $_SESSION['cart'] + json_decode($user_data['products'], true);

            header("Location: home.php");
        }
    }

    function register_user($username, $email, $password, $confirm_password) {
        $password = sha1($password);
        $register_errors = array();

        $user_data = safe_query("SELECT * FROM customer_info WHERE username = '{$username}' OR email = '{$email}'");

        if (!empty($user_data)) {
            $register_errors['user'] = "That username or password is taken.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $register_errors['email'] = "Please use a valid email address.";
        }

        if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $email) === false) {
            $register_errors['pass'] = "Passwords must be at least 8 characters in length, contain at least one uppercase and lowercase letter, and contain at least one numeric digit.";
        }

        if ($password !== sha1($confirm_password)) {
            $register_errors['confirm'] = "Passwords do not match.";
        }

        if (!empty($register_errors)) {
            header("Location: register.php" . http_build_query($register_errors));
        } else if (!safe_query("INSERT INTO customer_info (username, email, password) VALUES ('{$username}', '{$email}', '{$password}');")) {
            header("Location: register.php?alert=" . urlencode("An unknown error occured."));
        } else {
            header("Location: signin.php?alert=" . urlencode("You are now registered! Please sign in to your new profile."));
        }
    }

    function sign_out() {
        $sign_out_date = date('Y-m-d H:i:s');

        safe_query("UPDATE session_log SET date_out = '{$date_out}' WHERE session_log_id = '{$_SESSION['session_id']}'");

        session_unset();
        session_destroy();

        $_SESSION['session_id'] = 0;
        $_SESSION['username'] = 'guest';
        $_SESSION['logged_in'] = false;
        $_SESSION['cart_id'] = 0;
        $_SESSION['cart'] = array();
        $_SESSION['customer_info_id'];

        header("Location: home.php?alert=" . urlencode("You have been signed out."));
    }

    function add_to_cart($product_id) {
        global $LAST_INSERT_ID;

        $cart_id = $_SESSION['cart_id'];

        if (isset($_SESSION['cart']['product_id'])) {
            $_SESSION['cart'][$product_id]++;
        } else {
            $_SESSION['cart'][$product_id] = 1;
        }

        if ($cart_id == 0) {
            $cart_create_date = date('Y-m-d H:i:s');

            safe_query("INSERT INTO carts (products, date_created) VALUES ('" . json_encode($_SESSION['cart']) . "', '{$cart_create_date}')");

            $cart_id = $_SESSION['cart_id'] = $LAST_INSERT_ID;

            safe_query("UPDATE session_log SET cart_id = '{$cart_id}' WHERE session_log_id = '{$_SESSION['session_id']}'");

            if ($_SESSION['logged_in']) {
                safe_query("UPDATE customer_info SET cart_id = '{$cart_id}' WHERE username = '{$_SESSION['username']}'");
            }
        } else {
            safe_query("UPDATE carts SET products = '" . json_encode($_SESSION['cart']) . "' WHERE cart_id = '{$cart_id}'");
        }
    }

    function remove_from_cart($product_id) {
        $cart_id = $_SESSION['cart_id'];

        if ($cart_id != 0 && isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);

            safe_query("UPDATE carts SET products = '" . json_encode($_SESSION['cart']) . "' WHERE cart_id = '{$cart_id}'");
        }
    }

    function retrieve_cart() {
        global $SUBTOTAL, $TOTAL_TAX, $TOTAL_PRICE;

        if (empty($_SESSION['cart'])) {
            return array();
        } else {
            $cart_products = get_products("WHERE product_id = '" . implode("' OR product_id = '", array_keys($_SESSION['cart'])) . "'");

            if (!empty($cart_products)) {
                $TOTAL_TAX = 5;

                foreach ($cart_products as $key => $product) {
                    $cart_products[$key]['price'] = number_format($cart_products[$key]['price'], 2, '.', ',');
                    $cart_products[$key]['quantity'] = $_SESSION['cart'][$product['product_id']];
                    $cart_products[$key]['multprice'] = number_format($product['price'] * $cart_products[$key]['quantity'], 2, '.', ',');

                    $SUBTOTAL += $cart_products[$key]['multprice'];
                    $TOTAL_TAX += round($SUBTOTAL * 0.065, 2);
                }

                $TOTAL_PRICE = $SUBTOTAL + $TOTAL_TAX;
            }

            $SUBTOTAL = number_format($SUBTOTAL, 2, '.', ',');
            $TOTAL_TAX = number_format($TOTAL_TAX, 2, '.', ',');
            $TOTAL_PRICE = number_format($TOTAL_PRICE, 2, '.', ',');

            return $cart_products;
        }
    }
?>
