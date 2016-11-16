<?php
	$search_results = get_product_results('admin.php');
?>

<?
	if (isset($_GET['alert'])) {
		switch($_GET['alert']) {
			case "success":
				echo "<div class='alert alert-success' role='alert'>Product has been added or updated successfully!</div>";
				break;
			case "fail":
				echo "<div class='alert alert-danger' role='alert'>Error adding or updating product!</div>";
				break;
		}
	}

?>

<!-- Modal -->
<form method="post" action="admin.php?view=catalog">
	<div class="modal fade" id="add-product" tabindex="-1" role="dialog" aria-labelledby="addProduct">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add Product</h4>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<label for="product_name">Product Name</label>
						<input type="text" class="form-control" name="product_name" />
					</div>

					<div class="form-group">
						<label for="product_desc">Product Description</label>
						<textarea class="form-control" name="product_desc" rows="3"></textarea>
					</div>

					<div class="form-group">
						<label for="product_category">Product Category</label>
						<select class="form-control" name="product_category">
						<?php foreach ($all_categories as $category) { ?>
							<option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
						<?php } ?>
						</select>
					</div>

					<div class="row">
						<div class="form-group col-sm-4">
							<label for="product_cost">Product Cost</label>
							<input type="number" class="form-control" name="product_cost" />
						</div>

						<div class="form-group col-sm-4">
							<label for="product_price">Product Price</label>
							<input type="number" class="form-control" name="product_price" />
						</div>

						<div class="form-group col-sm-4">
							<label for="product_stock">Product Stock</label>
							<input type="number" class="form-control" name="product_stock" />
						</div>
					</div>

					<div class="row">
						<div class="form-group col-sm-6">
							<label for="product_sku">Product SKU</label>
							<input type="text" class="form-control" name="product_sku" />
						</div>

						<div class="form-group col-sm-6">
							<label for="supplier_id">Supplier ID</label>
							<input type="number" class="form-control" name="supplier_id" />
						</div>
					</div>

					<div class="form-group">
						<label for="product_image">Product Image</label>
						<input type="url" class="form-control" name="product_image" />
					</div>

					<input type="hidden" name="add-product-form" />
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Save</button>
				</div>
			</div>
		</div>
	</div>
</form>
<h2>Catalog</h2>

<!-- Button trigger modal -->
<button type="button" id="add-product-btn" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#add-product">
  <i class="fa fa-plus"></i> Add Product
</button>

<div class="panel panel-default">
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<td>Product Name</td>
					<td>Supplier ID</td>
					<td>Category</td>
					<td>SKU</td>
					<td>Stock</td>
					<td>Cost</td>
					<td>Price</td>
					<td>Actions</td>
				</tr>
			</thead>
			<tbody>
				<? foreach ($search_results['products'] as $product) { ?>
					<tr>
						<td><? echo $product["product_name"]; ?></td>
						<td><? echo $product["supplier_id"]; ?></td>
						<td><? echo $product["category"]; ?></td>
						<td><? echo $product["sku"]; ?></td>
						<td><? echo $product["stock"]; ?></td>
						<td><? echo $product["cost"]; ?></td>
						<td><? echo $product["price"]; ?></td>
						<td>
							<a href="admin.php?view=catalog&action=feature&id=<? echo $product["product_id"]; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-star"></span> Feature</a>
							<a href="admin.php?view=catalog&action=stock&id=<? echo $product["product_id"]; ?>" class="btn btn-success"><span class="glyphicon glyphicon-tag"></span> Stock</a>
							<a href="admin.php?view=catalog&action=delete&id=<? echo $product["product_id"]; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Remove</a>
						</td>
					</tr>
				<? } ?>
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
