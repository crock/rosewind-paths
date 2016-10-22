<?php
	$username = "al089314";
	$password = "F21FB18857B24B33B5A06409FC6C043E";
		
		$con = new mysqli("localhost",$username,$password,"al089314");
	    
	    if($con->error) {
	        print("Error connecting!  Message: ".$con->error);
	    } else {
	        //print("Connection Successful! \n \r <br/>");
	    }
	
		$selectA = "SELECT * FROM products LIMIT 6,1";
		$selectB = "SELECT * FROM products LIMIT 7,1";
		$selectC = "SELECT * FROM products LIMIT 8,1";
		
		$resultA = $con->query($selectA);
		$resultB = $con->query($selectB);
		$resultC = $con->query($selectC);
		
		$dataA = $resultA->fetch_object();
		$dataB = $resultB->fetch_object();
		$dataC = $resultC->fetch_object();
?>
<!DOCTYPE html>
<html>
	<?php include("inc/head.php"); ?>
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
			    <div class="item active">
			    	<img src="<?php echo $dataA->image; ?>" alt="...">
					<div class="carousel-caption">
			        	<h3><?php echo $dataA->product_name; ?></h3>
						<p><?php echo $dataA->description; ?></p>
						<span class="label label-success">$<?php echo $dataA->price ?></span>
			      	</div>
			    </div>
			    <div class="item">
			      	<img src="<?php echo $dataB->image; ?>" alt="...">
					<div class="carousel-caption">
			        	<h3><?php echo $dataB->product_name; ?></h3>
						<p><?php echo $dataB->description; ?></p>
						<span class="label label-success">$<?php echo $dataB->price ?></span>
			      	</div>
			    </div>
			    <div class="item">
			      	<img src="<?php echo $dataC->image; ?>" alt="...">
					<div class="carousel-caption">
			        	<h3><?php echo $dataC->product_name; ?></h3>
						<p><?php echo $dataC->description; ?></p>
						<span class="label label-success">$<?php echo $dataC->price ?></span>
			      	</div>
			    </div>
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