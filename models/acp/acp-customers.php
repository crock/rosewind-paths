<table class="table table-striped">
	<caption>Users</caption>
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
					<select name="user_type">
						<option value="<? echo $user["user_type"]; ?>" selected="selected"><? echo $user["user_type"]; ?></option>
						<?
							$types = array("guest" => "guest","member" => "member","privi" => "privi","admin" => "admin");
							$x = $user['user_type'];
							unset($types[$x]);
						?>	
					<? foreach($types as $key => $value) { ?>
						<option value="<? echo $value; ?>"><? echo $key; ?></option>
					<? } ?>
					</select>
				</td>
				<td><? echo $user["username"]; ?></td>
				<td><? echo $user["email"]; ?></td>
				<td>
					<a href="admin.php?view=customers&action=update&id=<? echo $user["id"]; ?>" class="btn btn-primary">Update</a>
					<a href="admin.php?view=customers&action=delete&id=<? echo $user["id"]; ?>" class="btn btn-danger">Delete</a>
				</td>
			</tr>
		<? } ?>
	</tbody>
</table>
<div class="col-md-12">
	<ul class="pagination">
		<?php foreach ($user_results['pagination'] as $page_tag) { ?>
			<?php echo $page_tag; ?>
		<?php } ?>
	</ul>
</div>