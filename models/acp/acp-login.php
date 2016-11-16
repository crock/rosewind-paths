<form id="acp-login-form" method="post" action="admin.php">
	<div class="form-group">
		<label for="username">Username</label>
		<input class="form-control" type="text" id="username" name="username" placeholder="Username">
	</div>

	<div class="form-group">
		<label for="password">Password</label>
		<input class="form-control" type="password" id="password" name="password" placeholder="Password">
	</div>

	<? if (isset($_GET['error'])) { ?>
		<span class="help-block"><strong>The username or password you entered is invalid.</strong></span>
	<? } ?>

	<input type="hidden" name="acp-login">
	<button class="btn btn-success" type="submit">Sign In <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
</form>