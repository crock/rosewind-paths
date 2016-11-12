<?php
    define('PAGE_TITLE', 'Product');
    require('controllers/controller.php');

    if (!isset($_GET['view'])) {
        header("Location: home.php");
    }

    var_dump(single_product($_GET['view']));
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head('Admin'); ?>

	<body>
        <?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

        <?php include("models/footer.php"); ?>
    </body>
</html>
