<table class="table table-striped">
	<thead>
		<tr>
			<td>Product ID</td>
			<td>Supplier ID</td>
			<td>Product Name</td>
			<td>Category</td>
			<td>Review Count</td>
			<td>Avg. Rating</td>
			<td>SKU</td>
			<td>Stock</td>
			<td>Cost</td>
			<td>Price</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
		<? foreach (get_products() as $product) { ?>
			<tr>
				<td><? echo $product["product_id"]; ?></td>
				<td><? echo $product["supplier_id"]; ?></td>
				<td><? echo $product["product_name"]; ?></td>
				<td><? echo $product["category"]; ?></td>
				<td><? echo $product["review_count"]; ?></td>
				<td><? echo $product["avg_rating"]; ?></td>
				<td><? echo $product["sku"]; ?></td>
				<td><? echo $product["stock"]; ?></td>
				<td><? echo $product["cost"]; ?></td>
				<td><? echo $product["price"]; ?></td>
				<td>
					<button class="btn btn-primary">Order</button>
					<button class="btn btn-danger">Delete</button>
				</td>
			</tr>
		<? } ?>
	</tbody>
</table>