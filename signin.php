<?php
	session_start();
	define('PAGE_TITLE', 'Sign In');
	require('controllers/controller.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("analyticstracking.php") ?>
		<?php include("models/header.php"); ?>

		<div class="container">
			<? if ( isset($_GET["alert"]) ) { ?>
				<div class="alert alert-success" role="alert"><? echo $_GET["alert"]; ?></div>
			<? } ?>

			<form id="login-form" method="post" action="signin.php">
				<div class="form-group">
					<label for="username">Username</label>
					<input class="form-control" type="text" id="username" name="username" placeholder="Username">
					<? if ( isset($_GET["error1"]) ) { ?>
						<span class="help-block">
							<strong><? echo $_GET["error1"]; ?></strong>
						</span>
					<? } ?>
				</div>

				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" type="password" id="password" name="password" placeholder="Password">
					<? if ( isset($_GET["error2"]) ) { ?>
						<span class="help-block">
							<strong><? echo $_GET["error2"]; ?></strong>
						</span>
					<? } ?>
				</div>
				<input type="hidden" name="signin">
				<button class="btn btn-success" type="submit">Sign In <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
				
				<h3>New user? Click the button below to register&mdash;it's free!</h3>
				<a href="register.php" class="btn btn-primary">Register</a>
			</form>
		</div>
	</body>
</html>
