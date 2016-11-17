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
			<h2>Sign In</h2>

			<? if (isset($_GET['atype']) && isset($_GET['alert'])) { ?>
				<div class="alert <?php echo (($_GET['atype'] == 'success') ? 'alert-success' : 'alert-danger'); ?>" role="alert"><?php echo urldecode($_GET['alert']); ?></div>
			<? } ?>

			<div class="row">
				<div class="col-sm-9 col-md-8">
					<div class="row">
						<div class="panel panel-default">
							<div class="panel-body">
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

									<h3>New user? Click the register button below &mdash; it's free!</h3>
								</form>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-sm-8 text-right">
							<button class="btn btn-success btn-lg" type="submit" form="login-form">Sign In <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
						</div>
						<div class="col-xs-6 col-sm-4 text-right">
							<a href="register.php" class="btn btn-primary btn-lg">Register <span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-md-4">
				</div>
			</div>
		</div>

		<?php include("models/footer.php"); ?>
	</body>
</html>
