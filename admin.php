<?php
	define('PAGE_TITLE', 'Admin');
	require('controllers/controller.php');
	require('controllers/search.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head('Admin'); ?>

	<body>
		<?php include_once("analyticstracking.php") ?>
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
					    case "analytics":
					        include("models/acp/acp-analytics.php");
					        break;
					    case "support":
					    	include("models/acp/acp-support.php");
					    	break;
					    case "settings":
					    	include("models/acp/acp-settings.php");
					    	break;
					}
				}
			?>
		</div><!-- end .container -->
	</body>
</html>
