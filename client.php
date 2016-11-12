<?php
	define('PAGE_TITLE', 'Client');
	require('controllers/controller.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

		<div class="container">

		</div><!-- end .container -->
		<?php include("models/footer.php"); ?>
	</body>
</html>
