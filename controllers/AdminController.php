<?php
	session_start();
	
	// Get required files
	require('controller.php');
	require('search.php');
	
	// Global Variables
	$orders = array();

	if (empty($_SESSION)) {
        create_admin_session();
    }
	
	function create_admin_session($username = 'privi') {
        global $LAST_INSERT_ID;

        $session_create_date = date('Y-m-d H:i:s');

        safe_query("INSERT INTO admin_session_log (username, date_created) VALUES('{$username}', '{$session_create_date}')");

        $_SESSION['session_id'] = $LAST_INSERT_ID;
        $_SESSION['username'] = $username;
        $_SESSION['admin_id'] = 0;
        $_SESSION['logged_in'] = false;
    }
	
	function acp_login() {
		
	}
    	
	function get_recent_orders() {
		$orders = get_orders("WHERE order_placed >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY");
		
	}
	
	function get_catalog() {
		
	}
	
	function get_customers() {
		$status = false;
		
		
	}
	
	function order_product($id) {
		
	} 
	
	function toggle_product($id, $action) {
		$status = false;
		
		if ($action == "delete") {
			$status = safe_query("UPDATE products SET status = '0' WHERE product_id='$id'");
		} else if ($action == "stock") {
			$status = safe_query("UPDATE products SET status = '1' WHERE product_id='$id'");
		} else {
			$status = false;
		}

		if ($status) {
			return header("Location: admin.php?alert=success&view=catalog");
		} else {
			return header("Location: admin.php?alert=fail&view=catalog");
		}
	}
	
	function add_product($data) {
		$suppid = $data['supplier_id'];
		$name = $data['product_name'];
		$desc = $data['product_desc'];
		$cat = $data['product_category'];
		$sku = $data['product_sku'];
		$cost = $data['product_cost'];
		$price = $data['product_price'];
		$img = $data['product_image'];
		
		$status = safe_query("INSERT INTO products (supplier_id,product_name,description,category,sku,stock,cost,price,img) VALUES ('$suppid','$name','$desc','$cat','$sku','$stock','$cost','$price','$img')");

		if ($status) {
			return header("Location: admin.php?alert=success&view=catalog");
		} else {
			return header("Location: admin.php?alert=fail&view=catalog");
		}
	}
	
	
	// Calling functions
	if (isset($_POST['add-product-form'])) {
		add_product($_POST);
	}
	
	if (isset($_GET['action']) && $_GET['action'] == "order") {
		order_product($_GET['id']);
	}
	
	if (isset($_GET['action'])) {
		toggle_product($_GET['id'], $_GET['action']);
	}
	
	