<?php
	define('PAGE_TITLE', 'Catalog');
	require('controllers/controller.php');
	require('controllers/search.php');

	$search_results = get_product_results('catalog.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

		<div class="container">
			<div class="row">
				<div class="product-filters col-lg-3 col-md-4">
  					<div class="well">
						<h3 align="center">Filter Results</h3>
						<form class="form-horizontal">
							<div class="form-group">
								<label for="type1" class="control-label">Category</label>
								<select class="form-control" name="type" id="type1">
									<option value="all">All</option>
									<option value="">1</option>
									<option value="">2</option>
								</select>
							</div>
							<div class="form-group">
								<label for="location1" class="control-label">Sort by</label>
								<select class="form-control" name="sort" id="location1">
									<?php foreach ($SORT_MODES as $value => $name) { ?>
									<option value="<?php echo $value; ?>"<?php echo (isset($_GET['sort']) && $_GET['sort'] == $value) ? ' selected' : ''; ?>><?php echo $name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="pricefrom" class="control-label">Min Price</label>
								<div class="input-group">
									<div class="input-group-addon">$</div>
									<input type="text" class="form-control" name="minpr"<?php if ($_GET['minpr'] && $_GET['minpr']) { echo ' value="' . $_GET['minpr'] . '"'; } ?>>
								</div>
							</div>
							<div class="form-group">
								<label for="priceto" class="control-label">Max Price</label>
								<div class="input-group">
									<div class="input-group-addon">$</div>
									<input type="text" class="form-control" name="maxpr"<?php if ($_GET['maxpr'] && $_GET['maxpr']) { echo ' value="' . $_GET['maxpr'] . '"'; } ?>>
								</div>
							</div>
							<button type="submit" class="btn btn-danger">Apply filters</button>
							<a href="catalog.php" class="btn btn-danger">Clear filters</a>
						</form>
					</div>
				</div>
				<div class="col-lg-9 col-md-8">
					<div class="col-lg-12 product-count">
					<?php if ($RESULT_COUNT == 0) { ?>
						<span>No results found</span>
					<?php } else { ?>
						<span>Showing results <?php echo $RESULT_START; ?>-<?php echo $RESULT_END; ?> of <?php echo $RESULT_COUNT; ?></span>
					<?php } ?>
					</div>
					<?php foreach ($search_results['products'] as $product) { ?>
					<div class="col-lg-4 col-sm-6 product-result">
			        	<div class="thumbnail">
			                <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['product_name']; ?>">
							<div class="product-info">
				                <div class="caption">
									<h4 class="pull-right">$<?php echo $product['price']; ?></h4>
									<h4><a href="product.php?view=<?php echo $product['product_id']; ?>"><?php echo $product['product_name']; ?></a></h4>
									<p><?php echo $product['description']; ?></p>
				                </div>
				                <div class="ratings">
									<p class="pull-left">
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
									</p>
									<p class="pull-right">15 reviews</p>
				                </div>
							</div>
			        	</div>
			        </div>
					<?php } ?>
					<div class="col-xs-12 text-center">
						<ul class="pagination">
							<?php foreach ($search_results['pagination'] as $page_tag) { ?>
								<?php echo $page_tag; ?>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<?php include("models/footer.php"); ?>
	</body>
</html>
