<?php
	define('PAGE_TITLE', 'Catalog');
	require('controller.php');

	$search_results = get_paginated_products();
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include("inc/header.php"); ?>

		<div class="container">
			<div class="col col-sm-3">

			</div>
			<div class="col col-sm-6">

			</div>
			<div class="col col-sm-3">
				<div class="form-group">
					<label for="sel2">Sort by:</label>
					<select class="form-control order-select" id="sel2">
						<option value="avg_rating-desc">Average rating</option>
						<option value="price-desc">Price (high to low)</option>
						<option value="price-asc">Price (low to high)</option>
					</select>
				</div>
			</div>
			<div class="col col-md-3 col-lg-2">
				<form class="search-filters">
					<ul>
					<?php foreach (get_categories("ORDER BY category_parent") as $category) { ?>
						<li><input id="<?php echo $category['category_slug']; ?>" type="checkbox" name="type[]" value="<?php echo $category['category_slug']; ?>"/><label for="<?php echo $category['category_slug']; ?>"><?php echo $category['category_name']; ?></label></li>
					<?php } ?>
					</ul>
					<input type="text" name="minpr" placeholder="0.00">
					<input type="text" name="maxpr" placeholder="1000.00">
					<button type="submit" class="btn btn-primary">Search</button>
				</form>
			</div>
			<div class="col col-md-9 col-lg-10">
				<div class="col col-sm-6">
					<?php if (isset($_REQUEST['search'])) { ?>
						<span>Search results for "<?php echo $_REQUEST['search']; ?>"</span><a href="catalog.php">Reset search</a>
					<?php } ?>
				</div>
				<div class="col col-sm-6 text-right">
					<?php if (empty($search_results['products'])) { ?>
						<span>No results found.</span>
					<?php } else { ?>
						<span>Showing <?php echo $RESULT_START; ?>-<?php echo $RESULT_END; ?> of <?php echo $RESULT_COUNT; ?> results.</span>
					<?php } ?>
				</div>

					<?php foreach ($search_results['products'] as $product) { ?>
							<div class="col col-sm-6 col-md-4 col-lg-3">
								<a href="#" target="_blank">
		                            <div class="workItem" style="background: url(http://placehold.it/250x250);">
										<img class="img-responsive" src="<?php echo $product['img']; ?>" alt="<?php echo $product['product_name']; ?>">
		                                <div class="workItemOverlay">
		                                    <span class="workItemOverlayText"><span class="workItemOverlayTextName"><?php echo $product['product_name']; ?></span><br><span class="workItemOverlayTextCategory"><?php echo $product['category']; ?></span></span>
		                                </div>
		                            </div>
		                        </a>
							</div>
					<?php } ?>
					<div class="col col-sm-12">
					<?php foreach ($search_results['pagination'] as $page_num => $page_tag) { ?>
						<a class="<?php echo ($page_tag['current']) ? 'current' : ''; ?>" href="<?php echo $page_tag['url']; ?>"><?php echo $page_num; ?></a>
					<?php } ?>
					</div>
				</div>
			</div>


			<!-- Product Cards -->
			<!-- Products can be put into these cards in a loop from what returns from the search -->
			<div class="card_container">
				<div class="card">
				  <img class="card-img-top" src="http://www.placecage.com/300/150" alt="Card image cap" />
				  <div class="card-block">
					<h4 class="card-title">Product title</h4>
					<p class="card-text">Product description.</p>
					<h4 class="card-price">$Price</h4>
					<a href="#" class="btn btn-primary add-to-cart">Add to Cart</a>
				  </div>
				</div>
				<div class="card">
				  <img class="card-img-top" src="http://www.placecage.com/300/150" alt="Card image cap" />
				  <div class="card-block">
					<h4 class="card-title">Product title</h4>
					<p class="card-text">Product description.</p>
					<h4 class="card-price">$Price</h4>
					<a href="#" class="btn btn-primary add-to-cart">Add to Cart</a>
				  </div>
				</div>
				<div class="card">
				  <img class="card-img-top" src="http://www.placecage.com/300/150" alt="Card image cap" />
				  <div class="card-block">
					<h4 class="card-title">Product title</h4>
					<p class="card-text">Product description.</p>
					<h4 class="card-price">$Price</h4>
					<a href="#" class="btn btn-primary add-to-cart">Add to Cart</a>
				  </div>
				</div>
			</div>
		</div><!-- end .container -->


		<?php include("inc/footer.php"); ?>
	</body>
</html>
