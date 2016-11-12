<?php
	define('PAGE_TITLE', 'Home');
	require('controllers/controller.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("analyticstracking.php") ?>
		<?php include("models/header.php"); ?>

		<div class="container">

			<div id="feat-slider" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#feat-slider" data-slide-to="0" class="active"></li>
					<?php for ($i = 1; $i < FEATURE_NUM; $i++) { ?>
					<li data-target="#feat-slider" data-slide-to="<?php echo FEATURE_NUM; ?>"></li>
					<?php } ?>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
				<?php foreach (get_products("ORDER BY RAND() LIMIT " . FEATURE_NUM) as $product) { ?>
					<div class="item">
						<a href="product.php?view=<?php echo $product['product_id']; ?>">
							<img class="img-responsive" src="<?php echo $product['img']; ?>" alt="<?php echo $product['product_name']; ?>">
							<div class="carousel-caption">
								<h3><?php echo $product['product_name']; ?><span class="label label-success">$<?php echo $product['price']; ?></span></h3>
							</div>
						</a>
					</div>
				<?php } ?>
				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#feat-slider" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span></a>
				<a class="right carousel-control" href="#feat-slider" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span></a>
			</div><!-- end #feat-slider -->

			<div class="row">
				<h1 class="col-md-8">Lorem Ipsum and other such things</h1>
				<div class="col-md-1">
				</div>
				<div class="col-md-3 form-group">
					<label for="sel1">Find by category:</label>
					<select class="form-control cat-select" id="sel1">
						<?php foreach ($all_categories as $category) { ?>
							<option value="<?php echo $category['category_slug']; ?>"><?php echo $category['category_name']; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 card">
					<div class="card-block">
						<h4 class="card-title">Packing Lists</h4>
						<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero quisquam consequatur ea magnam incidunt vel, omnis, ipsa atque illo aliquam quis, at in praesentium excepturi enim maxime voluptatem nisi reiciendis ipsum doloremque distinctio. Reprehenderit id, repellat cumque nihil veritatis vel! Laborum, totam unde, sint minima inventore repellat pariatur perferendis dolores!</p>
						<a href="#" class="btn btn-primary list_button">More Lists</a>
					</div>
					<?php if ($lists = get_products("WHERE category = 'food' LIMIT 3")) { ?>
					<div class="row">
						<div class="col-md-4">
							<a href="catalog.php?type=list&item=<?php echo $lists[0]['list_id']; ?>">
								<img class="img-anim-up img-thumb" src="<?php echo $lists[0]['img']; ?>" alt="<?php echo $lists[0]['name']; ?>">
							</a>
						</div>
						<div class="col-md-4">
							<a href="catalog.php?type=list&item=<?php echo $lists[1]['list_id']; ?>">
								<img class="img-anim-up img-thumb" src="<?php echo $lists[1]['img']; ?>" alt="<?php echo $lists[1]['name']; ?>">
							</a>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="col-md-6 card">
					<?php if ($lists) { ?>
					<a href="catalog.php?type=list&item=<?php echo $lists[2]['list_id']; ?>">
						<img class="img-full" src="<?php echo $lists[2]['img']; ?>" alt="<?php echo $lists[2]['name']; ?>">
					</a>
					<?php } ?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">
				</div>
				<div class="col-md-10">
					<img class="img-anim-left img-full" src="" alt="">
				</div>
			</div>
		</div><!-- end .container -->

		<?php include("models/footer.php"); ?>
	</body>
</html>
