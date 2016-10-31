<?php
	define('PAGE_TITLE', 'Register');
	require('controller.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include("inc/header.php"); ?>

		<div class="container">
			<form id="login-form" method="post" action="register.php">
				
				<div class="form-group">
					<label for="email">Email</label>
					<input class="form-control" type="email" id="email" name="email" placeholder="Email">
					<? if ($_GET["error3"]) { ?>
						<span class="help-block">
							<strong><? echo $_GET["error1"]; ?></strong>
						</span>
					<? } ?>
				</div>
				
				<div class="form-group">
					<label for="username">Username</label>
					<input class="form-control" type="text" id="username" name="username" placeholder="Username">
					<? if ($_GET["error1"]) { ?>
						<span class="help-block">
							<strong><? echo $_GET["error2"]; ?></strong>
						</span>
					<? } ?>
				</div>

				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" type="password" id="password" name="password" placeholder="Password">
					<? if ($_GET["error2"]) { ?>
						<span class="help-block">
							<strong><? echo $_GET["error3"]; ?></strong>
						</span>
					<? } ?>
				</div>
				
				<div class="form-group">
					<label for="password">Confirm Password</label>
					<input class="form-control" type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
					<? if ($_GET["error4"]) { ?>
						<span class="help-block">
							<strong><? echo $_GET["error4"]; ?></strong>
						</span>
					<? } ?>
				</div>
				<button class="btn btn-success" type="submit">Sign In <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
			</form>
		</div>
	</body>
</html>