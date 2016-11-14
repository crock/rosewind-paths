<?php
	define('PAGE_TITLE', 'Client');
	require('controllers/controller.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

		<div class="container">
			<h2>Who We Are</h2>
				<p id="intro_paragraph">
					Rosewind Paths is a source for people to discover places they have never yet encountered. Beaches and amusement parks are fun, but why not do something that is a little out of the ordinary?  We are here to help you find exactly just that and show that an adventure can be found in the least expected of places. This will be done with a map and compass to help guide you through your exploration that will lead you into peace, calm, and serenity. For those who want to take a break away from the stresses of the world, Rosewind Paths is the best route to relieve that tension. Our application is also beneficial for families that want to spend a weekend together and bond on a deeper level.
				</p>
			<hr/>
			<h2> Meet the Team </h2>
			<div class="team">
				<ul class="profiles">
					<li><img class="profile_img" src="http://i64.tinypic.com/2cnw4xx.png" alt="member" width="200" height="200"></li>
					<li>
						<h3>Kara Gwin</h3>
						<p class="profile_text">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam volutpat, velit eget egestas dictum, lorem sem imperdiet eros, sit amet scelerisque ligula nisi at enim. Integer dignissim metus a augue malesuada, id mollis massa auctor. Vestibulum id quam in neque accumsan elementum.
						</p>
					</li>
				</ul>
				<ul class="profiles2">
					<li><img class="profile_img" src="http://i64.tinypic.com/2cnw4xx.png" alt="member" width="200" height="200"></li>
					<li>
						<h3>Tiffany Brown</h3>
						<p class="profile_text">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam volutpat, velit eget egestas dictum, lorem sem imperdiet eros, sit amet scelerisque ligula nisi at enim. Integer dignissim metus a augue malesuada, id mollis massa auctor. Vestibulum id quam in neque accumsan elementum.
						</p>
					</li>
				</ul>
				<ul class="profiles3">
					<li><img class="profile_img" src="http://i64.tinypic.com/2cnw4xx.png" alt="member" width="200" height="200"></li>
					<li>
						<h3>Nani Jones</h3>
						<p class="profile_text">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam volutpat, velit eget egestas dictum, lorem sem imperdiet eros, sit amet scelerisque ligula nisi at enim. Integer dignissim metus a augue malesuada, id mollis massa auctor. Vestibulum id quam in neque accumsan elementum.
						</p>
					</li>
				</ul>
				<ul class="profiles4">
					<li><img class="profile_img" src="http://i64.tinypic.com/2cnw4xx.png" alt="member" width="200" height="200"></li>
					<li>
						<h3>Sean McMenamin</h3>
						<p class="profile_text">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam volutpat, velit eget egestas dictum, lorem sem imperdiet eros, sit amet scelerisque ligula nisi at enim. Integer dignissim metus a augue malesuada, id mollis massa auctor. Vestibulum id quam in neque accumsan elementum.
						</p>
					</li>
				</ul>
				<ul class="profiles5">
					<li><img class="profile_img" src="http://i64.tinypic.com/2cnw4xx.png" alt="member" width="200" height="200"></li>
					<li>
						<h3>Alexander Crocker</h3>
						<p class="profile_text">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam volutpat, velit eget egestas dictum, lorem sem imperdiet eros, sit amet scelerisque ligula nisi at enim. Integer dignissim metus a augue malesuada, id mollis massa auctor. Vestibulum id quam in neque accumsan elementum.
						</p>
					</li>
				</ul>
			</div>
			
			<hr/>
			
			<div class="faqs">
				<h2> FAQs </h2>
				<ul class="questions">
					<li><a href="faq.html"> How can I retrieve my login/password? </a></li>
					<li><a href="faq.html"> How can I share my experiences with others? </a></li>
					<li><a href="faq.html"> Do I have to pay to find certain destinations? </a></li>
					<li><a href="faq.html"> What is the best way to get in contact with the company? </a></li>
					<li><a href="faq.html"> How long does shipping/handling take? </a></li>
					<li><a href="faq.html"> What should I do if my order gets lost? </a></li>
					<li><a href="faq.html"> Is there a refund policy? </a></li>
				</ul>
			</div>
		</div><!-- end .container -->
		<?php include("models/footer.php"); ?>
	</body>
</html>
