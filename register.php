<?php
	define('PAGE_TITLE', 'Register');
	require('controllers/controller.php');

	if (isset($_GET['errors'])) {
		$_GET['errors'] = array_flip(unserialize(base64_decode($_GET['errors'])));
	}
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

		<div class="container">
			<?php if (isset($_GET['atype']) && isset($_GET['alert'])) { ?>
				<div class="alert <?php echo ($_GET['atype'] == 'success') ? 'alert-success' : 'alert-danger'; ?>" role="alert"><?php echo urldecode($_GET['alert']); ?></div>
			<? } ?>

			<form id="login-form" method="post" action="register.php">
				<div class="form-group">
					<label for="email">Email</label>
					<input class="form-control" type="email" id="email" name="email" placeholder="Email"<?php echo ((isset($_GET['email'])) ? ' value="' . $_GET[email] . '"' : ''); ?>>
					<? if (isset($_GET['email_invalid'])) { ?>
						<span class="help-block"><strong>The email address you entered is invalid.</strong></span>
					<? } ?>
				</div>

				<div class="form-group">
					<label for="username">Username</label>
					<input class="form-control" type="text" id="username" name="username" placeholder="Username"<?php echo ((isset($_GET['username'])) ? ' value="' . $_GET['username'] . '"' : ''); ?>>
					<? if (isset($_GET['user_taken'])) { ?>
						<span class="help-block"><strong>The username or email address you entered is already in use.</strong></span>
					<? } ?>
				</div>

				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" type="password" id="password" name="password" placeholder="Password">
					<? if (isset($_GET['pass_invalid'])) { ?>
						<span class="help-block"><strong>Your password must be at least 8 characters and contain at least one uppercase letter, one lowercase letter, and one numeric digit.</strong></span>
					<? } ?>
				</div>

				<div class="form-group">
					<label for="password">Confirm Password</label>
					<input class="form-control" type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
					<? if (isset($_GET['not_matching'])) { ?>
						<span class="help-block"><strong>The passwords you entered do not match.</strong></span>
					<? } ?>
				</div>

				<input type="hidden" name="register">
				<button class="btn btn-success" type="submit">Register <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>

				<h3>Already registered? Click the button below to sign in!</h3>
				<a href="signin.php" class="btn btn-primary">Sign In</a>
			</form>
		</div>

		<?php include("models/footer.php"); ?>
	</body>
</html>
