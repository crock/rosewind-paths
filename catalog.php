<?php
	define('PAGE_TITLE', 'Catalog');
	require('controller.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include("inc/header.php"); ?>

		<div class="container">
			<div class="products">
				<div><?php
				$search_results = get_paginated_products();

				if (empty($search_results['products'])) { ?>
					<span>No products found.</span>
				</div>
				<?php } else { ?>
					<span>Showing <?php echo $RESULT_START; ?>-<?php echo $RESULT_END; ?> of <?php echo $RESULT_COUNT; ?> products.</span>
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
				<?php }} ?>
			</div>

			<div>
				<?php foreach ($search_results['pages'] as $page_num => $page_tag) { ?>
					<a class="<?php ?>" href="<?php echo $page_tag['url']; ?>"><?php echo $page_num; ?></a>
				<?php } ?>
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
