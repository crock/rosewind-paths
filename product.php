<?php
    define('PAGE_TITLE', 'Product');
    require('controllers/controller.php');

    if (!isset($_GET['view'])) {
        header("Location: home.php");
    }

    $product = single_product($_GET['view']);
	//var_dump($product);
	
	$reviews = get_reviews($product['product_id'],10);
	//var_dump($review);
	
	$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	$username = $_SESSION['username'];
	
	$customer = safe_query("SELECT customer_info_id FROM customer_info WHERE username = '{$username}'");
	//var_dump("SELECT customer_info_id FROM customer_info WHERE username = '{$username}'");
	//var_dump($customer[0]['customer_info_id']);
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head('Admin'); ?>

	<body>
        <?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>
		
		
		<?php
			if (isset($_GET['alert'])) {
				switch($_GET['alert']) {
					case "success":
						echo "<div class='alert alert-success' role='alert'>Review added successfully</div>";
						break;
					case "fail":
						echo "<div class='alert alert-danger role='alert'>Error</div>";
						break;
						
				}
			}
		?>
		
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
							</div>
						
						<?php
							$product_id = $product['product_id'];
						?>
							
						</div>
						<div class="details col-md-6">
							<h3 class="product-title">
								<?php
									echo $product['product_name'];
								?>
							</h3>
							<div class="rating">
								<div class="stars">
									<!-- Retrive review value from tables via product_id and reflect rating -->
									<?php
										//echo $product['product_id'];
										
										$rates = "SELECT AVG(rating) FROM reviews WHERE product_id = $product_id";
										$average = safe_query($rates);
										$val = ROUND($average[0]['AVG(rating)']);
										//echo "Average: " . $val;
										//echo "Average: " . ROUND($average[0]['AVG(rating)']);
										//echo $review['rating'];*/
										
										if ($val == 1){
											echo '
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
										';}
										else if ($val == 2){
											echo '
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
										';}
										else if ($val == 3){
											echo '
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star"></span>
												<span class="fa fa-star"></span>
										';}
										else if ($val == 4){
											echo '
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star"></span>
										';}
										else if ($val == 5){
											echo '
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
												<span class="fa fa-star checked"></span>
								';}
									?>
									<!--
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									-->
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
								<form action="product.php?view=<?php echo $product_id ?>" method="post">
									<input id="ratings-hidden" name="rating" type="hidden"> 
									<textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
					
									<div class="text-right">
										<input type="hidden" id="star_number" value=""/>
										<div class="stars starrr" data-rating="0"></div>
										<a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
										<span class="glyphicon glyphicon-remove"></span> Cancel</a>
										<button class="btn btn-success btn-lg" id="submit" type="submit" name="submit">Save</button>
									</div>
								</form>
								
							<!-- Insert review into review database -->
							<?php								
								if (isset($_POST["rating"])){
									$new_review = $_POST['comment'];
									$star_value = $_POST['rating'];
									$date_created = date('Y-m-d H:i:s');
										
									$sql = "INSERT INTO reviews (customer_id, product_id, comment, rating, date_created) VALUES ('{$customer[0]['customer_info_id']}', '{$product_id}', '{$new_review}', '{$star_value}', '{$date_created}')";
									$result = safe_query($sql);
									
									$sql2 = "UPDATE products SET review_count = review_count + 1 WHERE product_id = '{$product_id}'";
									$result2 = safe_query($sql2);
								}									
							?>
							</div>
						</div>
					</div>
					<hr/>
					<div class="row" id="review-area">
						<!-- This will be where reviews for said product will be pulled and displayed, separated by horizontal rules -->
						<!-- Create loop through review database with product_id and list reviews, review count, and allow adding new reviews -->
						<?php
							foreach ($reviews as $review) {
								echo "<div class='prev_review'>";
								echo "<p class='review_text'>";
									echo $review['comment'];
								echo "</p>";
									if ($review['rating'] == 1){
										echo '
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
									';}
									else if ($review['rating'] == 2){
										echo '
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
									';}
									else if ($review['rating'] == 3){
										echo '
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<span class="fa fa-star"></span>
									';}
									else if ($review['rating'] == 4){
										echo '
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
									';}
									else if ($review['rating'] == 5){
										echo '
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
							';}
							echo "</div>";
							echo "<hr/>";}
						?>
					</div> <!-- End review area -->
				</div>
			</div>
		</div>

        <?php include("models/footer.php"); ?>
    </body>
</html>
