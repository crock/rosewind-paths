<?php
	define('PAGE_TITLE', 'Register');
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
				<div class="alert alert-danger" role="alert"><? echo $_GET["alert"]; ?></div>
			<? } ?>

			<form id="login-form" method="post" action="register.php">

				<div class="form-group">
					<label for="email">Email</label>
					<input class="form-control" type="email" id="email" name="email" placeholder="Email">
					<? if ( isset($_GET["error1"]) ) { ?>
						<span class="help-block">
							<strong><? echo $_GET["error1"]; ?></strong>
						</span>
					<? } ?>
				</div>

				<div class="form-group">
					<label for="username">Username</label>
					<input class="form-control" type="text" id="username" name="username" placeholder="Username">
					<? if ( isset($_GET["error2"]) ) { ?>
						<span class="help-block">
							<strong><? echo $_GET["error2"]; ?></strong>
						</span>
					<? } ?>
				</div>

				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" type="password" id="password" name="password" placeholder="Password">
					<? if ( isset($_GET["error3"]) ) { ?>
						<span class="help-block">
							<strong><? echo $_GET["error3"]; ?></strong>
						</span>
					<? } ?>
				</div>

				<div class="form-group">
					<label for="password">Confirm Password</label>
					<input class="form-control" type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
					<? if ( isset($_GET["error4"]) ) { ?>
						<span class="help-block">
							<strong><? echo $_GET["error4"]; ?></strong>
						</span>
					<? } ?>
				</div>
				<input type="hidden" name="register">
				<button class="btn btn-success" type="submit">Register <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
				
				<h3>Already registered? Click the button below to sign in!</h3>
				<a href="signin.php" class="btn btn-primary">Sign In</a>
			</form>
		</div>
	</body>
</html>
