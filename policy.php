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
			<h1>Our Policies </h1>
				<ul>
					<li class="policy_list"><h3>Tax Policy:</h3> A warehouse will be needed to store merchandise so we will have to file for a sales tax permit, this charging tax on all products with the exception of food. For shipping out of the state of Florida, taxes will vary based upon customers in other states.
					</li>
					<li class="policy_list"><h3 id="shipping_policy">Shipping Policy and Charges:</h3> Free shipping for orders $50.00 and more. 1-2 day shipping ($9.99); 3-5 day shipping ($5.99); 6-10 day shipping ($2.99). Deliveries will be made by the services of UPS or Fedex if we have our own warehouse or FBA. International shipping will not be provided.
					</li>
					<li class="policy_list"><h3>Return Policy:</h3> Broken/damaged items can be returned within five days. Once item is received you will get your money back and an email confirmation. If you get the wrong order we will be happy to receive your return and give you to correct order with no shipping cost. Customers can return items to this location: 4000 Central Florida Blvd, Orlando FL, 32816.
					</li>
					<li class="policy_list"><h3 id="privacy_policy">Privacy Policy:</h3> Credit/debit card and personal information are not saved in our database. This is something we do not take lightly as we want our customers to have safe, fraudulent-free purchases. Customers will re-enter their information for every purchase and are able to change information such as address, phone number, email, etc. There is, however, an option for those who would like to have their information saved so they do not have to re-enter it for every single purchase.
					</li>
					<li class="policy_list"><h3 id="security_statement">Security Statement:</h3> To create an account a username, email address, and password must be created. In order to login an email address or username with the password must be entered. If a user forgot his/her username/password there will be an option to change it by entering an email address for a link to get a new password. Passwords are case-sensitive and must be at least seven characters long with upper and lower case letters and have at least one extra character.
					</li>
			</ul>
		</div><!-- end .container -->
		<?php include("models/footer.php"); ?>
	</body>
</html>
