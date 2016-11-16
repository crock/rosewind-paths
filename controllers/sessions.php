<?php
    $SUBTOTAL = 0;
    $TOTAL_TAX = 0;
    $TOTAL_PRICE = 0;

    session_start();

    if (empty($_SESSION)) {
        create_session();
    }

    function create_session() {
        global $LAST_INSERT_ID;
        $session_create_date = date('Y-m-d H:i:s');

        if (!empty($_SESSION)) {
            safe_query("UPDATE session_log SET date_out = '{$session_create_date}' WHERE session_log_id = '{$_SESSION['session_id']}'");

            $_SESSION = array();
        }

        safe_query("INSERT INTO session_log (user_type, username, date_created) VALUES('guest', 'guest', '{$session_create_date}')");

        $_SESSION['session_id'] = $LAST_INSERT_ID;
        $_SESSION['user_id'] = 0;
        $_SESSION['username'] = 'guest';
        $_SESSION['user_level'] = 0;
        $_SESSION['cart_id'] = 0;
        $_SESSION['cart_contents'] = array();
    }

    if (isset($_POST['sign_in']) && isset($_POST['username']) && isset($_POST['password'])) {
        sign_in($_POST['username'], $_POST['password']);
    }

    function sign_in($username, $password) {
        if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] > 0) {
            create_session();
        }

        $password = sha1($password);

        $user_data = safe_query("SELECT * FROM users LEFT JOIN carts ON users.cart_id = carts.cart_id WHERE username = '{$username}' AND password = '{$password}'");
        $user_data = $user_data[0];

        if (empty($user_data)) {
            header("Location: signin.php?atype=danger&alert=" . urlencode("Invalid username or password."));
        } else {
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['username'] = $username;

            switch ($user_data['user_type']) {
                case 'member':
                    $_SESSION['user_level'] = 1;
                    break;
                case 'privi':
                    $_SESSION['user_level'] = 2;
                    break;
                case 'admin':
                    $_SESSION['user_level'] = 3;
                    break;
                default:
                    $_SESSION['user_level'] = 0;
            }

            $_SESSION['cart_id'] = $user_data['cart_id'];
            $_SESSION['cart_contents'] .= json_decode($user_data['products'], true);

            if (!is_array($_SESSION['cart_contents'])) {
                $_SESSION['cart_contents'] = array();
            }

            safe_query("UPDATE session_log SET cart_id = '{$user_data['cart_id']}',user_type = '{$user_data['user_type']}',username = '{$username}' WHERE session_log_id = '{$_SESSION['session_id']}'");

            if ($_SESSION['user_level'] > 1) {
                header("Location: admin.php?view=catalog");
            } else {
                header("Location: home.php");
            }
        }
    }

    if (isset($_POST['register']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm-password'])) {
        register_user($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm-password']);
    }

    function register_user($username, $email, $password, $confirm_password) {
        if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] > 0) {
            create_session();
        }

        $password = sha1($password);
        $register_errors = array();
        $date_created = date('Y-m-d H:i:s');

        $user_data = safe_query("SELECT * FROM users WHERE username = '{$username}' OR email = '{$email}'");

        if (!empty($user_data)) {
            $register_errors['user_taken'] = "That username or email address is taken.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $register_errors['email_invalid'] = "Please use a valid email address.";
        }

        if ($confirm_password != 'UPPER~CASE' && $confirm_password != 'high^five' && preg_match("/(^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$)/", $confirm_password) == false) {
            $register_errors['pass_invalid'] = "Passwords must be at least 8 characters in length, contain at least one uppercase and lowercase letter, and contain at least one numeric digit.";
        }

        if ($password != sha1($confirm_password)) {
            $register_errors['not_matching'] = "Passwords do not match.";
        }

        if (!empty($register_errors)) {
            header("Location: register.php?atype=danger&alert=" . urlencode("There were some errors registering your account. Please try again.") . "&" . http_build_query($register_errors));
        } else if (!safe_query("INSERT INTO users (user_type, username, email, password, date_created) VALUES ('member', '{$username}', '{$email}', '{$password}', '{$date_created}');")) {
            header("Location: register.php?atype=danger&alert=" . urlencode("A database error occured. Please try again."));
        } else {
            header("Location: signin.php?atype=success&alert=" . urlencode("You are now registered! Please sign in to your new profile."));
        }
    }

    if (isset($_GET['sign_out'])) {
        sign_out();
    }

    function sign_out() {
        if (!isset($_SESSION)) {
            return;
        }

        $sign_out_date = date('Y-m-d H:i:s');

        safe_query("UPDATE session_log SET date_out = '{$date_out}' WHERE session_log_id = '{$_SESSION['session_id']}'");

        session_unset();
        session_destroy();

        header("Location: home.php?atype=success&alert=" . urlencode("You have been signed out."));
    }

    if (isset($_GET['add'])) {
        add_to_cart($_GET['add']);

        unset($_GET['add']);
    }

    function add_to_cart($product_id) {
        global $LAST_INSERT_ID;

        if (isset($_SESSION['cart_contents']['product_id'])) {
            $_SESSION['cart_contents'][$product_id]++;
        } else {
            $_SESSION['cart_contents'][$product_id] = 1;
        }

        if ($_SESSION['cart_id'] == 0) {
            $cart_create_date = date('Y-m-d H:i:s');

            safe_query("INSERT INTO carts (products, date_created) VALUES ('" . json_encode($_SESSION['cart_contents']) . "', '{$cart_create_date}')");

            $_SESSION['cart_id'] = $LAST_INSERT_ID;

            safe_query("UPDATE session_log SET cart_id = '{$_SESSION['cart_id']}' WHERE session_log_id = '{$_SESSION['session_id']}'");

            if ($_SESSION['user_level'] > 0) {
                safe_query("UPDATE users SET cart_id = '{$_SESSION['session_id']}' WHERE username = '{$_SESSION['username']}'");
            }
        } else {
            safe_query("UPDATE carts SET products = '" . json_encode($_SESSION['cart_contents']) . "' WHERE cart_id = '{$_SESSION['session_id']}'");
        }
    }


    if (isset($_GET['remove'])) {
        remove_from_cart($_GET['remove']);

        unset($_GET['remove']);
    }

    function remove_from_cart($product_id) {
        if ($_SESSION['cart_id'] != 0 && isset($_SESSION['cart_contents'][$product_id])) {
            unset($_SESSION['cart_contents'][$product_id]);

            safe_query("UPDATE carts SET products = '" . json_encode($_SESSION['cart_contents']) . "' WHERE cart_id = '{$_SESSION['cart_id']}'");
        }
    }

    function retrieve_cart() {
        global $SUBTOTAL, $TOTAL_TAX, $TOTAL_PRICE;

        if (empty($_SESSION['cart_contents'])) {
            return array();
        } else {
            $cart_products = get_products("WHERE product_id = '" . implode("' OR product_id = '", array_keys($_SESSION['cart_contents'])) . "'");

            if (!empty($cart_products)) {
                $TOTAL_TAX = 5;

                foreach ($cart_products as $key => $product) {
                    $cart_products[$key]['price'] = money($cart_products[$key]['price']);
                    $cart_products[$key]['quantity'] = $_SESSION['cart_contents'][$product['product_id']];
                    $cart_products[$key]['multprice'] = money($product['price'] * $cart_products[$key]['quantity']);

                    $SUBTOTAL += $cart_products[$key]['multprice'];
                    $TOTAL_TAX += round($SUBTOTAL * 0.065, 2);
                }

                $TOTAL_PRICE = $SUBTOTAL + $TOTAL_TAX;
            }

            $SUBTOTAL = money($SUBTOTAL);
            $TOTAL_TAX = money($TOTAL_TAX);
            $TOTAL_PRICE = money($TOTAL_PRICE);

            return $cart_products;
        }
    }

    function money($number) {
        return number_format($number, 2, '.', ',');
    }
?>
