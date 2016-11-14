<?php
	define('PAGE_TITLE', 'Checkout');
	require('controllers/controller.php');

	$cart_products = retrieve_cart();

    if (empty($cart_products)) {
        header("Location: home.php");
    }
?>

<!DOCTYPE html>
<html>
	<?php echo rwp_head(PAGE_TITLE); ?>

	<body>
		<?php include_once("controllers/tracking.php") ?>
		<?php include("models/header.php"); ?>

        <div class="container">
            <h2>Checkout</h2>
            <ul class="nav nav-tabs">
			    <li class="active"><a href="#shipping" data-toggle="tab">Shipping</a></li>
                <li><a href="#billing" data-toggle="tab">Billing</a></li>
            </ul>

            <h2 class="bg-success">Order Total: $<?php echo $TOTAL_PRICE; ?></h2>

			<div class="tab-content clearfix">
                <div class="tab-pane active" id="shipping">
                    <div class="form-group col-md-6">
                        <h3>Customer Info</h3>
                        <label class="control-label" for="firstname">* First Name</label>
                        <input id="firstname" name="firstname" type="text" class="form-control">
                        <label class="control-label" for="lastname">* Last Name</label>
                        <input id="lastname" name="lastname" type="text" class="form-control">
                        <label class="control-label" for="email"> * Email Address</label>
                        <input id="email" name="email" type="text" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <h3>Shipping Address</h3>
                        <label class="control-label" for="address1">* Street Address 1</label>
                        <input id="address1" name="address1" type="text" class="form-control">
                        <label class="control-label" for="address2">Street Address 2</label>
                        <input id="address2" name="address2" type="text" class="form-control">
                        <div class="row">
                            <div class="col-md-5">
                                <select name="country">
                                    <option>United States</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="state">
                                    <option>FL</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="zip">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="billing">
                    <div class="form-group col-md-6">
                        <h3>Card Info</h3>
                        <label class="control-label" for="cardname">* Name on Card</label>
                        <input id="cardname" name="cardname" type="text" class="form-control">
                        <label class="control-label" for="cardnumber">* Card Number</label>
                        <input id="cardnumber" name="cardnumber" type="text" class="form-control">
                        <div class="row">
                            <div class="col-md-3 offset-md-3">
                                <input id="cvv" name="cvv" type="text" placeholder="" class="form-control" required="">
                            </div>
                            <div class="col-md-3">
                                <select name="expmonth">
                                    <option value="01">01 - January</option>
                                    <option value="02">02 - February</option>
                                    <option value="03">03 - March</option>
                                    <option value="04">04 - April</option>
                                    <option value="05">05 - May</option>
                                    <option value="06">06 - June</option>
                                    <option value="07">07 - July</option>
                                    <option value="08">08 - August</option>
                                    <option value="09">09 - September</option>
                                    <option value="10">10 - October</option>
                                    <option value="11">11 - November</option>
                                    <option value="12">12 - December</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="expyear">
                                    <option value="16">2016</option>
                                    <option value="17">2017</option>
                                    <option value="18">2018</option>
                                    <option value="19">2019</option>
                                    <option value="20">2020</option>
                                    <option value="21">2021</option>
                                    <option value="22">2022</option>
                                    <option value="23">2023</option>
                                    <option value="24">2024</option>
                                    <option value="25">2025</option>
                                    <option value="26">2026</option>
                                    <option value="27">2027</option>
                                    <option value="28">2028</option>
                                    <option value="29">2029</option>
                                    <option value="30">2030</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <h3>Billing Address</h3>
                        <label for="useshipping">Same as shipping address</label>
                        <input id="useshipping" type="checkbox" name="useshipping">
                        <br>
                        <label class="control-label" for="address1">* Street Address 1</label>
                        <input id="address1" name="address1" type="text" class="form-control">
                        <label class="control-label" for="address2">Street Address 2</label>
                        <input id="address2" name="address2" type="text" class="form-control">
                        <div class="row">
                            <div class="col-md-5">
                                <select name="country">
                                    <option>United States</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="state">
                                    <option>FL</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="zip">
                            </div>
                        </div>
                    </div>
                    <label for="acceptterms">I accept the terms and conditions</label>
                    <input id="acceptterms" type="checkbox" name="acceptterms">
				</div>
            </div>
        </div>

        <?php include("models/footer.php"); ?>
    </body>
</html>
