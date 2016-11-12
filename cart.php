<?php
	define('PAGE_TITLE', 'Cart');
	require('controllers/controller.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

		<div class="container">
			<div class="cart">
				<h1>Your Shopping Cart</h1>
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-sm-6">
								<img src="http://placehold.it/250x250" alt="product image">
							</div>
							<div class="col-sm-6">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem in dolore, fuga dolorum praesentium suscipit ad, architecto incidunt saepe aliquam cum nemo, itaque et esse provident dolores ipsum nihil tenetur ratione explicabo deserunt ullam nostrum sit delectus. Aut nam a asperiores laborum porro, illo deserunt debitis adipisci repellendus, eaque velit!</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<h4 class="subtotal">Subtotal: $100.00</h4>
						<button type="button" class="btn btn-primary checkout">Checkout</button>
					</div>
				</div>
			</div>
		</div><!-- end .container -->
		<?php include("models/footer.php"); ?>
	</body>
</html>
