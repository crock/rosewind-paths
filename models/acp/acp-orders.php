<?php
	$search_results = get_order_results('admin.php');
?>

<h2>Recent Orders</h2>

<div class="panel panel-default">
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<td>Order ID</td>
					<td>Date Ordered</td>
					<td>Customer Name</td>
					<td>Total Cost</td>
					<td>Items Ordered</td>
					<td>Status</td>
				</tr>
			</thead>
			<tbody>
				<? foreach ($search_results['orders'] as $order) { ?>
					<tr>
						<td><?php echo $order['order_id']; ?></td>
						<td><?php echo $order['order_placed']; ?></td>
						<td><?php echo $order['first_name'] . ' ' . $order['last_name']; ?></td>
						<td><?php echo $order['total']; ?></td>
						<td><?php echo $order['contents']; ?></td>
						<td><?php echo $order['order_status']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="col-xs-12 text-center">
	<ul class="pagination">
		<?php foreach ($search_results['pagination'] as $page_tag) { ?>
			<?php echo $page_tag; ?>
		<?php } ?>
	</ul>
</div>
