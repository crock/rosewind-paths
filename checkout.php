<?php
	define('PAGE_TITLE', 'Checkout');
	require('controllers/controller.php');

	$cart_products = retrieve_cart();

    if (empty($cart_products)) {
        header("Location: cart.php");
    } else if (isset($_SESSION['username']) && $_SESSION['username'] != 'guest') {
		$customer = safe_query("SELECT * FROM users WHERE username = '{$_SESSION['username']}'");
		$customer = $customer[0];
	}

	if (isset($_POST['checkout']) && isset($_SESSION['cart_contents']) && !empty($_SESSION['cart_contents'])) {
		$customer_info_id = isset($customer['id']) ? $customer['id'] : 0;
		$total = $TOTAL_PRICE;
		$tax = $TOTAL_TAX;
		$contents = json_encode($_SESSION['cart_contents']);
		$order_status = 'placed';
		$order_placed = date('Y-m-d H:i:s');
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$email = $_POST['email'];
		$card_name = $_POST['cardname'];
		$card_number = $_POST['cardnumber'];
		$cvv = $_POST['cvv'];
		$exp_month = $_POST['expmonth'];
		$exp_year = $_POST['expyear'];
		$shipping_address1 = $_POST['shippingaddress1'];
		$shipping_address2 = $_POST['shippingaddress2'];
		$billing_address1 = $_POST['billingaddress1'];
		$billing_address2 = $_POST['billingaddress2'];

		$query = "INSERT INTO orders (customer_info_id, total, tax, contents, order_status, order_placed, first_name, last_name, email, card_name, card_number, cvv, exp_month, exp_year, shipping_address1, shipping_address2, billing_address1, billing_address2) VALUES ('{$customer_info_id}', '{$total}', '{$tax}', '{$contents}', '{$order_status}', '{$order_placed}', '{$first_name}', '{$last_name}', '{$email}', '{$card_name}', '{$card_number}', '{$cvv}', '{$exp_month}', '{$exp_year}', '{$shipping_address1}', '{$shipping_address2}', '{$billing_address1}', '{$billing_address2}')";

		$status = safe_query($query);

		if ($status) {
			$_SESSION['cart_contents'] = array();

			safe_query("UPDATE users SET first_name = '{$first_name}', last_name = '{$last_name}', shipping_address = '{$shipping_address1}', billing_address = '{$billingaddress1}' WHERE customer_id = '{$customer['id']}'");

			header("Location: home.php?atype=success&alert=" . urlencode("Your order has been placed successfully!"));
		} else {
			header("Location: checkout.php?atype=danger&alert=" . urlencode("Something went wrong. Please try your order again!"));
		}
	}
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

        <div class="container">
            <h2>Checkout</h2>

			<? if (isset($_GET['atype']) && isset($_GET['alert'])) { ?>
				<div class="alert <?php echo ($_GET['atype'] == 'success') ? 'alert-success' : 'alert-danger'; ?>" role="alert"><?php echo urldecode($_GET['alert']); ?></div>
			<? } ?>

            <ul class="nav nav-tabs">
			    <li class="active"><a href="#shipping" data-toggle="tab">Shipping</a></li>
                <li><a href="#billing" data-toggle="tab">Billing</a></li>
            </ul>

            <h2 class="bg-success">Order Total: $<?php echo $TOTAL_PRICE; ?></h2>

			<form method="post">
				<div class="tab-content clearfix">
	                <div class="tab-pane active" id="shipping">
						<div class="panel panel-default">
							<div class="panel-body">
			                    <div class="form-group col-md-6">
			                        <h3>Customer Info</h3>
			                        <label class="control-label" for="firstname">* First Name</label>
			                        <input id="firstname" name="firstname" type="text" class="form-control">
			                        <label class="control-label" for="lastname">* Last Name</label>
			                        <input id="lastname" name="lastname" type="text" class="form-control">
			                        <label class="control-label" for="email"> * Email Address</label>
			                        <input id="email" name="email" type="text" class="form-control">
			                    </div>
			                    <div class="form-group col-md-6">
			                        <h3>Shipping Address</h3>
			                        <label class="control-label" for="shippingaddress1">* Street Address 1</label>
			                        <input id="shippingaddress1" name="shippingaddress1" type="text" class="form-control">
			                        <label class="control-label" for="shippingaddress2">Street Address 2</label>
			                        <input id="shippingaddress2" name="shippingaddress2" type="text" class="form-control">
									<label class="control-label" for="shippingcountry">* Locality</label>
			                        <div class="row">
			                            <div class="col-xs-8 col-sm-6 col-md-5">
			                                <select id="shippingcountry" class="form-control" name="shippingcountry">
			                                    <option>United States</option>
			                                </select>
			                            </div>
			                            <div class="col-xs-4 col-sm-2">
			                                <select id="shippingstate" class="form-control" name="shippingstate">
			                                    <option>FL</option>
			                                </select>
			                            </div>
			                            <div class="col-xs-7 col-sm-4 col-md-5">
			                                <input id="shippingzip" class="form-control" type="text" name="shippingzip">
			                            </div>
			                        </div>
			                    </div>
							</div>
						</div>
	                </div>
	                <div class="tab-pane" id="billing">
						<div class="panel panel-default">
							<div class="panel-body">
			                    <div class="form-group col-md-6">
			                        <h3>Card Info</h3>
			                        <label class="control-label" for="cardname">* Name on Card</label>
			                        <input id="cardname" name="cardname" type="text" class="form-control">
			                        <label class="control-label" for="cardnumber">* Card Number</label>
			                        <input id="cardnumber" name="cardnumber" type="text" class="form-control">
									<label class="control-label" for="cvv">CVV</label>
			                        <div class="row">
			                            <div class="col-xs-4 col-sm-3">
			                                <input id="cvv" name="cvv" type="text" placeholder="" class="form-control">
			                            </div>
			                            <div class="col-xs-5 col-sm-4">
			                                <select id="expmonth" class="form-control" name="expmonth">
			                                    <option value="01">01 - January</option>
			                                    <option value="02">02 - February</option>
			                                    <option value="03">03 - March</option>
			                                    <option value="04">04 - April</option>
			                                    <option value="05">05 - May</option>
			                                    <option value="06">06 - June</option>
			                                    <option value="07">07 - July</option>
			                                    <option value="08">08 - August</option>
			                                    <option value="09">09 - September</option>
			                                    <option value="10">10 - October</option>
			                                    <option value="11">11 - November</option>
			                                    <option value="12">12 - December</option>
			                                </select>
										</div>
										<div class="col-xs-3">
											<select id="expyear" class="form-control" name="expyear">
			                                    <option value="16">2016</option>
			                                    <option value="17">2017</option>
			                                    <option value="18">2018</option>
			                                    <option value="19">2019</option>
			                                    <option value="20">2020</option>
			                                    <option value="21">2021</option>
			                                    <option value="22">2022</option>
			                                    <option value="23">2023</option>
			                                    <option value="24">2024</option>
			                                    <option value="25">2025</option>
			                                    <option value="26">2026</option>
			                                    <option value="27">2027</option>
			                                    <option value="28">2028</option>
			                                    <option value="29">2029</option>
			                                    <option value="30">2030</option>
			                                </select>
			                            </div>
			                        </div>
									<label for="acceptterms">I accept the terms and conditions</label>
				                    <input id="acceptterms" type="checkbox" name="acceptterms">
			                    </div>
			                    <div class="form-group col-md-6">
			                        <h3>Billing Address</h3>
									<label class="control-label" for="billingaddress1">* Street Address 1</label>
			                        <input id="billingaddress1" name="billingaddress1" type="text" class="form-control">
			                        <label class="control-label" for="billingaddress2">Street Address 2</label>
			                        <input id="billingaddress2" name="billingaddress2" type="text" class="form-control">
									<label class="control-label" for="billingcountry">* Locality</label>
			                        <div class="row">
			                            <div class="col-xs-8 col-sm-6 col-md-5">
			                                <select id="billingcountry" class="form-control" name="billingcountry">
			                                    <option>United States</option>
			                                </select>
			                            </div>
			                            <div class="col-xs-4 col-sm-2">
			                                <select id="billingstate" class="form-control" name="billingstate">
			                                    <option>FL</option>
			                                </select>
			                            </div>
			                            <div class="col-xs-7 col-sm-4 col-md-5">
			                                <input id="billingzip" class="form-control" type="text" name="billingzip">
			                            </div>
			                        </div>
									<label for="useshipping">Same as shipping address</label>
			                        <input id="useshipping" type="checkbox" name="useshipping">
			                    </div>
							</div>
						</div>
					</div>
	            </div>
				<div class="row">
					<div class="col-xs-6 col-sm-8 col-lg-9 text-right">
						<a href="cart.php" class="btn btn-default btn-lg" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Back to Cart </a>
					</div>
					<div class="col-xs-6 col-sm-4 col-lg-3 text-right">
						<input type="hidden" name="checkout" value="1">
						<button type="submit" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-ok"></span> Confirm Purchase</button>
					</div>
				</div>
			</form>
        </div>

        <?php include("models/footer.php"); ?>
    </body>
</html>
