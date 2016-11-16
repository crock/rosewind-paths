<h2>Users</h2>
<? if ($_SESSION['user_level'] < 3) { ?>
	<div class="alert alert-warning" role="alert">As a privileged user, you may view the users table but you cannot edit permissions.</div>
<? } ?>
<div class="panel panel-default">
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<td>User ID</td>
					<td>User Type</td>
					<td>Username</td>
					<td>Email</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
				<? foreach ($user_results['users'] as $user) { ?>
					<tr>
						<td><? echo $user["id"]; ?></td>
						<td>
							<select class="form-control" name="user_type" form="change_type"<?php echo ($_SESSION['user_level'] < 3) ? ' disabled' : ''; ?>>
								<option value="<? echo $user["user_type"]; ?>" selected="selected"><? echo $user["user_type"]; ?></option>
								<?
									$types = array("guest" => "guest","member" => "member","privi" => "privi","admin" => "admin");
									$x = $user['user_type'];
									unset($types[$x]);
								?>
							<? foreach($types as $key => $value) { ?>
								<option value="<? echo $value . '-' . $user["id"]; ?>"><? echo $key; ?></option>
							<? } ?>
							</select>
						</td>
						<td><? echo $user["username"]; ?></td>
						<td><? echo $user["email"]; ?></td>
						<td>
							<a form="change_type" type="submit" name="update[]" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> Update</a>
							<a form="change_type" type="submit" name="delete[]" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Remove</a>
						</td>
					</tr>
				<? } ?>
			</tbody>
		</table>
		<form action="admin.php?view=catalog" method="post" id="change_type"<?php echo ($_SESSION['user_level'] < 3) ? ' disabled' : ''; ?>></form>
	</div>
</div>
<div class="col-xs-12 text-center">
	<ul class="pagination">
		<?php foreach ($user_results['pagination'] as $page_tag) { ?>
			<?php echo $page_tag; ?>
		<?php } ?>
	</ul>
</div>
