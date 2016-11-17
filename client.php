<?php
	define('PAGE_TITLE', 'Client');
	require('controllers/controller.php');

	if (!isset($_SESSION['username']) || $_SESSION['username'] == 'guest') {
		header("Location: signin.php?atype=danger&alert=" . urlencode("Please sign in to access this page."));
	}

	$customer = safe_query("SELECT * FROM users WHERE username = '{$_SESSION['username']}'");
	$customer = $customer[0];

	$orders = safe_query("SELECT * FROM orders WHERE customer_info_id = '{$customer['id']}'");
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

		<div class="container">
			<h2>Welcome, <?php echo $customer['username']; ?>!</h2>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-5">
							<h3>Shipping Information</h3>
							<br>
							<!-- Shipping Address -->
							<div class="ship_address">
								<h4>Shipping address: <?php echo $customer['shipping_address']; ?></h4>
								<h4>Country: United States</h4>
								<h4>State: Florida</h4>
							</div>
							<br>
							<h3>Billing Information</h3>
							<br>
							<!-- Billing Address -->
							<div class="bill_address">
								<h4>Billing address: <?php echo $customer['billing_address']; ?></h4>
								<h4>Country: United States</h4>
								<h4>State: Florida</h4>
							</div>
						</div>
						<div class="col-sm-7">
							<h3>Recent Orders</h3>
							<?php if (sizeof($orders) > 0) { ?>
							<table class="table">
								<thead>
									<tr>
										<td>Order Placed</td>
										<td>Total Cost</td>
										<td>Status</td>
									</tr>
								</thead>
								<tbody>
							<?php foreach ($orders as $order) { ?>
									<tr>
										<td><?php echo $order['order_placed']; ?></td>
										<td>$<?php echo money($order['total']); ?></td>
										<td>Placed</td>
									</tr>
							<?php } ?>
								</tbody>
							</table>
							<?php } else { ?>
								<h4>No recent orders.</h4>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- end .container -->
		<?php include("models/footer.php"); ?>
	</body>
</html>
