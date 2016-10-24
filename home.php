<?php require('controller.php'); ?>
<!DOCTYPE html>
<html>
	<?php echo rwp_head('Home'); ?>
	<body>
		<?php include("inc/header.php"); ?>
		<div class="userbar">
			<div class="container">
				<p class="pull-left">Slogan goes here</p>
				<ul class="pull-right">
					<li><a href="client.php">Client</a></li>
				</ul>
			</div>
		</div>

		<div class="container">
			<div id="feat-slider" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#feat-slider" data-slide-to="0" class="active"></li>
			    <li data-target="#feat-slider" data-slide-to="1"></li>
			    <li data-target="#feat-slider" data-slide-to="2"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
				<?php foreach (get_products(3) as $product) { ?>
					<div class="item">
				    	<img src="<?php echo $product->image; ?>" alt="...">
						<div class="carousel-caption">
				        	<h3><?php echo $product->product_name; ?></h3>
							<p><?php echo $product->description; ?></p>
							<span class="label label-success">$<?php echo $product->price; ?></span>
				      	</div>
				    </div>
  				<?php } ?>
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#feat-slider" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#feat-slider" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div><!-- end #feat-slider -->
			<div class="row">
			  <div class="col-md-6"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero quisquam consequatur ea magnam incidunt vel, omnis, ipsa atque illo aliquam quis, at in praesentium excepturi enim maxime voluptatem nisi reiciendis ipsum doloremque distinctio. Reprehenderit id, repellat cumque nihil veritatis vel! Laborum, totam unde, sint minima inventore repellat pariatur perferendis dolores!</p></div>
			  <div class="col-md-6"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut amet praesentium voluptatem tempora ex assumenda reprehenderit, ratione maxime laborum deleniti cumque aspernatur quisquam ipsa beatae. Inventore earum, tenetur voluptatum veniam velit quo soluta sequi esse in cumque repellat reiciendis culpa, dolorum. Rerum ipsam quisquam autem, ad delectus vel earum magnam.</p></div>
			</div>
		</div><!-- end .container -->
		<?php include("inc/footer.php"); ?>
	</body>
</html>
