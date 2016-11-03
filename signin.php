<?php
	define('PAGE_TITLE', 'Sign In');
	require('controller.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include("inc/header.php"); ?>

		<div class="container">
			<? if ($_GET["alert"] != NULL) { ?>
				<div class="alert alert-success" role="alert"><? echo $_GET["alert"]; ?></div>
			<? } ?>
			
			<form id="login-form" method="post" action="signin.php">
				<div class="form-group">
					<label for="username">Username</label>
					<input class="form-control" type="text" id="username" name="username" placeholder="Username">
					<? if ($_GET["error1"]) { ?>
						<span class="help-block">
							<strong><? echo $_GET["error1"]; ?></strong>
						</span>
					<? } ?>
				</div>

				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" type="password" id="password" name="password" placeholder="Password">
					<? if ($_GET["error2"]) { ?>
						<span class="help-block">
							<strong><? echo $_GET["error2"]; ?></strong>
						</span>
					<? } ?>
				</div>
				<input type="hidden" name="signin">
				<button class="btn btn-success" type="submit">Sign In <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
			</form>
		</div>
	</body>
</html>
