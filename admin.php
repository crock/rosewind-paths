<?php
	define('PAGE_TITLE', 'Admin');
	require('controllers/AdminController.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head('Admin'); ?>

	<body>
		<?php include("models/acp/acp-header.php"); ?>

		<div class="container">
			<?		
				if (isset($_GET['view'])) {
					switch($_GET['view']) {
						case "orders":
					        include("models/acp/acp-orders.php");
					        break;
					    case "catalog":
					        include("models/acp/acp-catalog.php");
					        break;
					    case "customers":
					        include("models/acp/acp-customers.php");
					        break;
					}
				}
			?>
		</div><!-- end .container -->
	</body>
</html>
