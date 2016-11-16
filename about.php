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
			<h1>About Us</h1>
			<br>
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
							Back-End Development
						</p>
					</li>
				</ul>
				<ul class="profiles2">
					<li><img class="profile_img" src="http://i64.tinypic.com/2cnw4xx.png" alt="member" width="200" height="200"></li>
					<li>
						<h3>Tiffany Brown</h3>
						<p class="profile_text">
							Content
						</p>
					</li>
				</ul>
				<ul class="profiles3">
					<li><img class="profile_img" src="http://i64.tinypic.com/2cnw4xx.png" alt="member" width="200" height="200"></li>
					<li>
						<h3>Nani Jones</h3>
						<p class="profile_text">
							Front-End Development
						</p>
					</li>
				</ul>
				<ul class="profiles4">
					<li><img class="profile_img" src="http://i64.tinypic.com/2cnw4xx.png" alt="member" width="200" height="200"></li>
					<li>
						<h3>Sean McMenamin</h3>
						<p class="profile_text">
							Front-End Development
						</p>
					</li>
				</ul>
				<ul class="profiles5">
					<li><img class="profile_img" src="http://i64.tinypic.com/2cnw4xx.png" alt="member" width="200" height="200"></li>
					<li>
						<h3>Alexander Crocker</h3>
						<p class="profile_text">
							Back-End Development
						</p>
					</li>
				</ul>
			</div>
			<hr/>
			<h2> Our Policies </h2>
				<ul>
					<li class="policy_list"><h3>Tax policy:</h3> A warehouse will be needed to store merchandise so we will have to file for a sales tax permit, this charging tax on all products with the exception of food. For shipping out of the state of Florida, taxes will vary based upon customers in other states.
					</li>
					<li class="policy_list"><h3 id="shipping_policy">Shipping policy and charges:</h3> Free shipping for orders $50.00 and more. 1-2 day shipping ($9.99); 3-5 day shipping ($5.99); 6-10 day shipping ($2.99). Deliveries will be made by the services of UPS or Fedex if we have our own warehouse or FBA. International shipping will not be provided.
					</li>
					<li class="policy_list"><h3>Return policy:</h3> Broken/damaged items can be returned within five days. Once item is received you will get your money back and an email confirmation. If you get the wrong order we will be happy to receive your return and give you to correct order with no shipping cost. Customers can return items to this location: 4000 Central Florida Blvd, Orlando FL, 32816.
					</li>
					<li class="policy_list"><h3 id="privacy_policy">Privacy policy:</h3> Credit/debit card and personal information are not saved in our database. This is something we do not take lightly as we want our customers to have safe, fraudulent-free purchases. Customers will re-enter their information for every purchase and are able to change information such as address, phone number, email, etc. There is, however, an option for those who would like to have their information saved so they do not have to re-enter it for every single purchase.
					</li>
					<li class="policy_list"><h3 id="security_statement">Security Statement:</h3> To create an account a username, email address, and password must be created. In order to login an email address or username with the password must be entered. If a user forgot his/her username/password there will be an option to change it by entering an email address for a link to get a new password. Passwords are case-sensitive and must be at least seven characters long with upper and lower case letters and have at least one extra character.
					</li>
				</ul>
			<!--
			<hr/>
			<div class="faqs">
				<h2>FAQs</h2>
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
			-->
			<hr/>
			<h2 id="contact_us">Contact Us</h2>
				<ul>
					<li class="address">4000 Central Florida Blvd, Orlando FL, 32816</li>
					<li class="address">(407) 724-8830</li>
					<li class="address">rosewindpaths@gmail.com</li>
				</ul>
			<!-- ADD About Us, Contact Us, and links to other pages through header -->
		</div><!-- end .container -->
		<?php include("models/footer.php"); ?>
	</body>
</html>
