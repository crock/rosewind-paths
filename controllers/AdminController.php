<?php
	
	// Get required files
	require('controller.php');
	require('search.php');
	
	// Global Variables
	$orders = array();
	$view = $_GET['view'];
	
	function get_recent_orders() {
		$orders = get_orders("WHERE order_placed >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY");
		return $orders;	
	}

	
	function toggle_product($id, $action) {
		$status = false;
		
		if ($action == "delete") {
			$status = safe_query("UPDATE products SET status = '0' WHERE product_id='$id'");
		} else if ($action == "stock") {
			$status = safe_query("UPDATE products SET status = '1' WHERE product_id='$id'");
		} else if ($action == "feature") {
			$status = safe_query("UPDATE products SET status = '2' WHERE product_id='$id'");
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
	
	if (isset($_GET['action'])) {
		toggle_product($_GET['id'], $_GET['action']);
	}	