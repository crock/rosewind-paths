<?php
	define('PAGE_TITLE', 'Admin');
	require('controller.php');
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head('Admin'); ?>
	
	<body>
		<?php include("inc/acp-header.php"); ?>

		<div class="container">
			<?  
				if (isset($_GET['page'])) {	
					switch($_GET['page']) {
						case "orders":
					        include("inc/acp-orders.php");
					        break;
					    case "catalog":
					        include("inc/acp-catalog.php");
					        break;
					    case "analytics":
					        include("inc/acp-analytics.php");
					        break;
					    case "support":
					    	include("inc/acp-support.php");
					    	break;
					    case "settings":
					    	include("inc/acp-settings.php");
					    	break;
					}
				}	
			?>
		</div><!-- end .container -->
	</body>
</html>
