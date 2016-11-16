<?php
	define('PAGE_TITLE', 'Admin');
	require('controllers/AdminController.php');

	if (!isset($_SESSION['user_level'])) {
		create_session();
	} else if ($_SESSION['user_level'] < 1) {
		header("Location: signin.php?atype=success&alert=" . urlencode("Please sign in to access this page."));
	} else if ($_SESSION['user_level'] < 2) {
		header("Location: home.php?atype=danger&alert=" . urlencode("You do not have permission to access this page."));
	} else if (!isset($_GET['view'])) {
		header("Location: admin.php?view=catalog");
	}

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
				if (isset($_SESSION['user_level']) && $_SESSION['user_level'] > 1) {
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
