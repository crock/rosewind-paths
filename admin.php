<?php
	define('PAGE_TITLE', 'Admin');

	$admin_view = $_GET['view'];

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

	$user_results = get_user_results('admin.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head('Admin'); ?>

	<body>
		<?php include("models/header.php"); ?>

		<div class="container">
			<?php
				if (isset($admin_view)) {
					switch($admin_view) {
						case 'orders':
					        include("models/acp/acp-orders.php");
					        break;
					    case 'catalog':
					        include("models/acp/acp-catalog.php");
					        break;
					    case 'users':
					        include("models/acp/acp-users.php");
					        break;
						default:
							include("models/acp/acp-catalog.php");
					}
				}
			?>
		</div><!-- end .container -->

		<?php include("models/footer.php"); ?>
	</body>
</html>
