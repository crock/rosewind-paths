<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<footer>
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <h3>Products</h3>
                    <ul>
                    <?php for ($i = 0; $i < min(5, sizeof($parent_categories)); $i++) { ?>
                        <li><a href="catalog.php?type=<?php echo $parent_categories[$i]['category_slug']; ?>"><?php echo $parent_categories[$i]['category_name'] ?></a></li>
                    <?php } ?>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-1">
                    <h3>Information</h3>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="about.php#contact_us">Contact Us</a></li>
                        <li><a href="policy.php#privacy_policy">Privacy Policy</a></li>
                        <li><a href="policy.php#shipping_policy">Shipping & Refunds</a></li>
                        <li><a href="policy.php#security_statement">Security Statement</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-6 col-md-offset-1 col-lg-6 col-lg-offset-1">
                    <h3>Follow Us</h3>
                    <div class="row">
                        <div class="col-xs-12 col-sm-9 col-md-12 col-lg-9">
                            <div class="panel newsletter">
                                <div class="panel-body">
                                    <p>Subscribe for our latest products and deals.</p>
                                    <form>
                                        <div class="input-group input-group-lg input-group-full">
                                            <input type="text" name="newsletter" class="form-control" placeholder="your@email.com">
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-default btn-search"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-12 col-lg-3">
                            <ul class="social">
                                <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/?lang=en"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left">This site is not official and is an assignment for a UCF Digital Media course. Designed by Media for eCommerce Group 4</p>
            <div class="pull-right">
                <ul class="nav nav-pills payments">
                	<li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
