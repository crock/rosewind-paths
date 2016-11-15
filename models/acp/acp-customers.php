<table class="table table-striped">
	<caption>Catalog</caption>
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
		<? foreach ($search_results['users'] as $user) { ?>
			<tr>
				<td><? echo $user[""]; ?></td>
				<td><? echo $user[""]; ?></td>
				<td><? echo $user[""]; ?></td>
				<td><? echo $user[""]; ?></td>
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
		<?php foreach ($search_results['pagination'] as $page_tag) { ?>
			<?php echo $page_tag; ?>
		<?php } ?>
	</ul>
</div>