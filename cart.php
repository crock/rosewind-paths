<?php
	define('PAGE_TITLE', 'Cart');
	require('controllers/controller.php');

	$cart_products = get_cart();
	$running_total = 0;
	$running_taxes = 5;
	$real_total = 0;
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

		<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
				<?php foreach ($cart_products as $product) {
					$product['quantity'] = $_SESSION['cart'][$product['product_id']];
					$product['multprice'] = $product['price'] * $product['quantity'];

					$running_total += $product['multprice'];
					$running_taxes += round($product['multprice'] * 0.065, 2);
					$real_total = $running_total + $running_taxes;
				?>
					<tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="<?php echo $product['img']; ?>" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#"><?php echo $product['product_name']; ?></a></h4>
                                <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
                                <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $product['quantity']; ?>">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>$<?php echo $product['price']; ?></strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>$<?php echo $product['multprice']; ?></strong></td>
                        <td class="col-sm-1 col-md-1">
                        <button type="button" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button></td>
                    </tr>
				<?php } ?>
				</tbody>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>$<?php echo $running_total; ?></strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Shipping + tax</h5></td>
                        <td class="text-right"><h5><strong>$<?php echo $running_taxes; ?></strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong>$<?php echo $real_total; ?></strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
						<a href="catalog.php">
	                        <button type="button" class="btn btn-default">
	                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
	                        </button>
						</a>
						</td>
                        <td>
                        <button type="button" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
		<?php include("models/footer.php"); ?>
	</body>
</html>
