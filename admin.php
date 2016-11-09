<?php
	define('PAGE_TITLE', 'Admin');
	require('controllers/controller.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head('Admin'); ?>

	<body>
		<?php include("models/acp/acp-header.php"); ?>

		<div class="container">
			<?
				if (isset($_GET['page'])) {
					switch($_GET['page']) {
						case "orders":
					        include("inc/acp/acp-orders.php");
					        break;
					    case "catalog":
					        include("inc/acp/acp-catalog.php");
					        break;
					    case "analytics":
					        include("inc/acp/acp-analytics.php");
					        break;
					    case "support":
					    	include("inc/acp/acp-support.php");
					    	break;
					    case "settings":
					    	include("inc/acp/acp-settings.php");
					    	break;
					}
				}
			?>
		</div><!-- end .container -->
	</body>
</html>
