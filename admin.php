<?php
	define('PAGE_TITLE', 'Admin');
	require('controllers/AdminController.php');
	
	$user_results = get_user_results('admin.php?view=customers');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head('Admin'); ?>

	<body>
		<?php include("models/header.php"); ?>

		<div class="container">
			<?
				if (isset($_GET['alert'])) {
					switch($_GET['alert']) {
						case "success":
							echo "<div class='alert alert-success' role='alert'>Login Successful!</div>";
							break;
						case "fail":
							echo "<div class='alert alert-danger' role='alert'>Error logging in, please try again!</div>";
							break;
					}
				}
				
			?>
			
			<?php		
				if ( isset($_SESSION) && $_SESSION['logged_in'] == true ) {
					if (isset($_GET['view'])) {
						switch($_GET['view']) {
							case "orders":
						        include("models/acp/acp-orders.php");
						        break;
						    case "catalog":
						        include("models/acp/acp-catalog.php");
						        break;
						    case "users":
						        include("models/acp/acp-users.php");
						        break;
						}
					} else {
						echo "No view matching query";
					}
				} else {
					include("models/acp/acp-login.php");
				}
			?> 
		</div><!-- end .container -->
	</body>
</html>
