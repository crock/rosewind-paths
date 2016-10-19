<!DOCTYPE html>
<html>
	<?php include("inc/head.php"); ?>
	<body>
		<?php include("inc/header.php"); ?>
		<div class="userbar">
			<div class="container">	
				<p class="pull-left">Slogan goes here</p>
				<ul class="pull-right">
					<li><a href="client.php">Client</a></li>
				</ul>
			</div>
		</div>
		
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
						<button type="button" class="btn btn-primary">Checkout</button>
					</div>
				</div>
			</div>
		</div><!-- end .container -->
		<?php include("inc/footer.php"); ?>
	</body>
</html>