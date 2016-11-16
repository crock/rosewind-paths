<?php
	define('PAGE_TITLE', 'Sign In');
	require('controllers/controller.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

		<div class="container">
			<? if (isset($_GET['atype']) && isset($_GET['alert'])) { ?>
				<div class="alert <?php echo ($_GET['atype'] == 'success') ? 'alert-success' : 'alert-danger'; ?>" role="alert"><?php echo urldecode($_GET['alert']); ?></div>
			<? } ?>

			<form id="login-form" method="post" action="signin.php">
				<div class="form-group">
					<label for="username">Username</label>
					<input class="form-control" type="text" id="username" name="username" placeholder="Username">
				</div>

				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" type="password" id="password" name="password" placeholder="Password">
				</div>

				<input type="hidden" name="sign_in">
				<button class="btn btn-success" type="submit">Sign In <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>

				<h3>New user? Click the button below to register&mdash;it's free!</h3>
				<a href="register.php" class="btn btn-primary">Register</a>
			</form>
		</div>

		<?php include("models/footer.php"); ?>
	</body>
</html>
