<?php
	define('PAGE_TITLE', 'Client');
	require('controllers/controller.php');

	if (!isset($_SESSION['username']) || $_SESSION['username'] == 'guest') {
		header("Location: signin.php?atype=danger&alert=" . urlencode("Please sign in to access this page."));
	}

	$customer = safe_query("SELECT * FROM users WHERE username = '{$_SESSION['username']}'");
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

		<div class="container">

			<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) { ?>
				<h1> <?php echo $_SESSION['username']; ?> </h1>
			<?php } else { ?>
				<h1>Client Name</h1>
			<?php } ?>
			<br/>
			<div id="profile_intro">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero quisquam consequatur ea magnam incidunt vel, omnis, ipsa atque illo aliquam quis, at in praesentium excepturi enim maxime voluptatem nisi reiciendis ipsum doloremque distinctio. Reprehenderit id, repellat cumque nihil veritatis vel! Laborum, totam unde, sint minima inventore repellat pariatur perferendis dolores!
			</div>
			<br/>
			<h2>Shipping Information</h2>
			<!-- Shipping Address -->
			<?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) { ?>
				<?php echo $_SESSION['username']; ?> </p>
				<div class="ship_address">
					<p class="street1">Street Address 1</p>
					<p class="street2">Street Address 2</p>
					<p class="city">City</p>
					<p class="state">State</p>
					<p class="zip">Zip Code</p>
				</div>
			<?php } else { ?>
				<div class="ship_address">
					<p class="street1">Street Address 1</p>
					<p class="street2">Street Address 2</p>
					<p class="city">City</p>
					<p class="state">State</p>
					<p class="zip">Zip Code</p>
				</div>
			<?php } ?>
			<br/>
			<!-- Area for previous orders -->
			<h2>Recent Orders</h2>
			<div class="prev_orders">
				<p>*--Placeholder for order history--*</p>
			</div>
			<hr />
			<h2>Gallery</h2>
			<div class="row gallery">
				<img class="col-sm-4 gallery_img" src="img/autumn-1804592_640.jpg" width="320" height="240"/>
				<img class="col-sm-4 gallery_img" src="img/gibraltar-1351696_640.jpg" width="320" height="240"/>
				<img class="col-sm-4 gallery_img" src="img/mountain-1806236_640.jpg" width="320" height="240"/>
			</div>
		</div><!-- end .container -->
		<?php include("models/footer.php"); ?>
	</body>
</html>
