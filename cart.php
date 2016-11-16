<?php
	define('PAGE_TITLE', 'Cart');
	require('controllers/controller.php');

	$cart_products = retrieve_cart();
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

		<div class="container">
			<h2>Shopping Cart</h2>
			<? if (empty($cart_products)) { ?>
				<div class="alert alert-info" role="alert">You have nothing in your cart.</div>
			<? } ?>
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-hover">
				    	<thead>
							<tr>
								<th class="col-xs-5">Product</th>
		                        <th class="col-xs-1">Quantity</th>
		                        <th class="col-xs-2 text-right">Price</th>
		                        <th class="col-xs-2 text-right">Total</th>
								<th class="col-xs-2"></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($cart_products as $product) { ?>
							<tr>
								<td class="col-xs-4 col-md-5">
									<div class="col-xs-12 col-md-3">
			                            <img class="thumbnail" src="<?php echo $product['img']; ?>" alt="<?php echo $product['product_name']; ?>" width="75" height="75">
			                        </div>
									<div class="col-xs-12 col-md-9">
										<h4 class="media-heading"><a href="#"><?php echo $product['product_name']; ?></a></h4>
										<span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
									</div>
								</td>
		                        <td class="col-xs-2 col-md-1">
									<input class="form-control" type="text" value="<?php echo $product['quantity']; ?>">
								</td>
		                        <td class="col-xs-2 text-right"><h4>$<?php echo $product['price']; ?></h4></td>
		                        <td class="col-xs-2 text-right"><h4>$<?php echo $product['multprice']; ?></h4></td>
								<td class="col-xs-2 text-right">
									<button type="submit" class="btn btn-danger" name="remove" value="<?php echo $product['product_id']; ?>" form="removefromcart"><span class="glyphicon glyphicon-remove pull-left"></span><span class="hidden-xs hidden-sm pull-left"> Remove</span></button>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
					<div class="row">
						<div class="col-xs-6 col-sm-7 col-md-8 text-right">
							<h4>Subtotal:</h4>
							<h4>Shipping + Tax:</h4>
							<h3>Total:</h3>
						</div>
						<div class="col-xs-4 col-sm-3 col-md-2 text-right">
							<h4>$<?php echo $SUBTOTAL; ?></h4>
							<h4>$<?php echo $TOTAL_TAX; ?></h4>
							<h3><b>$<?php echo $TOTAL_PRICE; ?></b></h3>
						</div>
						<div class="col-xs-2 col-md-2">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-sm-8 col-lg-9 text-right">
					<a href="catalog.php" class="btn btn-default btn-lg" role="button"><span class="glyphicon glyphicon-th-list"></span> Back to Catalog </a>
				</div>
				<div class="col-xs-6 col-sm-4 col-lg-3 text-right">
					<?php if (isset($_SESSION['cart_contents']) && !empty($_SESSION['cart_contents'])) { ?>
					<a href="checkout.php" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-ok"></span> Proceed to Checkout</a>
					<?php } ?>
				</div>
			</div>
		</div>
		<form id="removefromcart"></form>

		<?php include("models/footer.php"); ?>
	</body>
</html>
