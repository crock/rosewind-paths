<?php
    define('PAGE_TITLE', 'Product');
    require('controllers/controller.php');

    if (!isset($_GET['view'])) {
        header("Location: home.php");
    }

    $product = single_product($_GET['view']);
	//var_dump($product);
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head('Admin'); ?>

	<body>
        <?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>
		
		<div class="container">
			<div class="card2">
				<div class="container-fluid">
					<div class="wrapper row">
						<div class="preview col-md-6">
							
							<div class="preview-pic tab-content">
							  <div class="tab-pane active" id="pic-1">
								<?php
									echo '<img src="' . $product['img'] . '" ;/>'
								?>
							  </div>
							  <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
							  <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
							  <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
							  <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div>
							</div>
							
							
						</div>
						<div class="details col-md-6">
							<h3 class="product-title">
								<?php
									echo $product['product_name'];
								?>
							</h3>
							<div class="rating">
								<div class="stars">
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
								</div>
								<span class="review-no">
									<?php
										echo $product['review_count'] . " reviews";
									?>
								</span>
							</div>
							<p class="product-description">
								<?php
									echo $product['description'];
								?>
							</p>
							<h4 class="price">current price:
								<span>
								<?php
									echo "$" . $product['price'] ;
								?>
								</span>
							</h4>
							<!--<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
							<h5 class="sizes">sizes:
								<span class="size" data-toggle="tooltip" title="small">s</span>
								<span class="size" data-toggle="tooltip" title="medium">m</span>
								<span class="size" data-toggle="tooltip" title="large">l</span>
								<span class="size" data-toggle="tooltip" title="xtra large">xl</span>
							</h5>
							<h5 class="colors">colors:
								<span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
								<span class="color green"></span>
								<span class="color blue"></span>
							</h5>-->
							<div class="action">
								<button class="add-to-cart btn btn-default" type="button">add to cart</button>
								<!--<button class="review btn btn-default" type="button">leave a review</button>
								<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>-->
							</div>
						</div>
					</div>
				</div>
				<div class="review-box" id="reviews">
					<div class="well well-sm">
						<div class="text-right">
							<a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
						</div>
					
						<div class="row" id="post-review-box" style="display:none;">
							<div class="col-md-12">
								<form accept-charset="UTF-8" action="" method="post">
									<input id="ratings-hidden" name="rating" type="hidden"> 
									<textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
					
									<div class="text-right">
										<div class="stars starrr" data-rating="0"></div>
										<a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
										<span class="glyphicon glyphicon-remove"></span> Cancel</a>
										<button class="btn btn-success btn-lg" id="save_button" type="submit">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row" id="review-area">
						<!-- This will be where reviews for said product will be pulled and displayed, separated by horizontal rules -->
						<div class="prev_review">
							<p class="review_text">Copper mug beard wayfarers, lyft schlitz salvia kinfolk slow-carb typewriter chillwave poutine fingerstache skateboard letterpress. Next level wayfarers dreamcatcher try-hard brooklyn glossier. Brooklyn hoodie swag letterpress before they sold out edison bulb, sriracha air plant squid taxidermy art party tbh irony quinoa forage. Brooklyn normcore plaid scenester pinterest marfa try-hard, chillwave literally slow-carb cronut twee flannel craft beer. Man braid chicharrones tumblr, narwhal salvia hella health goth swag pitchfork actually disrupt cray kale chips green juice activated charcoal. Ethical succulents four dollar toast, pabst blue bottle prism cronut helvetica actually pok pok mustache man bun salvia. Pok pok vice copper mug mlkshk, godard lyft coloring book cliche bushwick bicycle rights before they sold out microdosing seitan.</p>
							<div class="stars"> <!-- Star rating -->
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
						</div>
						<hr/>
						<div class="prev_review">
							<p class="review_text">Copper mug beard wayfarers, lyft schlitz salvia kinfolk slow-carb typewriter chillwave poutine fingerstache skateboard letterpress. Next level wayfarers dreamcatcher try-hard brooklyn glossier. Brooklyn hoodie swag letterpress before they sold out edison bulb, sriracha air plant squid taxidermy art party tbh irony quinoa forage. Brooklyn normcore plaid scenester pinterest marfa try-hard, chillwave literally slow-carb cronut twee flannel craft beer. Man braid chicharrones tumblr, narwhal salvia hella health goth swag pitchfork actually disrupt cray kale chips green juice activated charcoal. Ethical succulents four dollar toast, pabst blue bottle prism cronut helvetica actually pok pok mustache man bun salvia. Pok pok vice copper mug mlkshk, godard lyft coloring book cliche bushwick bicycle rights before they sold out microdosing seitan.</p>
							<div class="stars"> <!-- Star rating -->
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
						</div>
					</div> <!-- End review area -->
				</div>
			</div>
		</div>

        <?php include("models/footer.php"); ?>
    </body>
</html>
