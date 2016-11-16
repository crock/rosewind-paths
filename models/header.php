<nav id="navbar-upper" class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-custom">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <a class="navbar-brand" href="home.php">
                        <img src="img/full_logo.svg" alt="Rosewind Paths Compass Logo" width="300" height="75">
                    </a>
                </div>
                <?php if (PAGE_TITLE != 'Admin') { ?>
                <div class="col-xs-12 col-sm-6">
                    <ul class="social pull-right hidden-xs">
                        <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/?lang=en"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</nav>
<nav id="navbar-lower" class="navbar navbar-inverse" role="navigation">
    <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-6">
                    <form class="form-search" role="search" action="catalog.php">
                        <div class="input-group input-group-lg input-group-full">
                            <input type="text" name="q" class="form-control" aria-label="Search">
                            <div class="input-group-btn">
                                <?php if (sizeof($parent_categories) > 1) { ?>
                                <div class="btn btn-default">
                                    <?php if (PAGE_TITLE != 'Admin' || (PAGE_TITLE == 'Admin' && isset($_GET['view']))) { ?>
                                    <?php if (PAGE_TITLE != 'Admin' || $_GET['view'] == 'catalog') { ?>
                                    <select class="form-control" name="type" style="width: 10em;">
                                        <option value="all">All categories</option>
                                        <?php foreach ($parent_categories as $category) { ?>
                                        <option value="<?php echo $category['category_slug']; ?>"><?php echo $category['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php } else if ($_GET['view'] == 'customers') { ?>
                                    <select class="form-control" name="type" style="width: 10em;">
                                        <option value="member">Members</option>
                                        <option value="privi">Privileged Users</option>
                                        <option value="admin">Administrators</option>
                                    </select>
                                    <?php } ?>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <button type="submit" class="btn btn-default btn-search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4 col-md-6">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (PAGE_TITLE != 'Admin') { ?>
                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, <?php echo $_SESSION['username']; ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="client.php">Your profile</a></li>
                                <li><a href="client.php">Your orders</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="home.php?sign_out=1">Sign out</a></li>
                            </ul>
                        </li>
                        <?php } else { ?>
            			<li><a href="signin.php">Sign In</a></li>
                        <?php } ?>
                        <li<?php echo (PAGE_TITLE == 'Cart') ? ' class="active"' : ''; ?>><a href="cart.php">Cart <?php echo (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) ? '<span class="badge progress-bar-danger">' . array_sum($_SESSION['cart']) . '</span>' : ''; ?></a></li>
                        <?php } else { ?>
                        <li><a href="admin.php?view=orders">Recent Orders</a></li>
            			<li><a href="admin.php?view=catalog">Catalog</a></li>
            			<li><a href="admin.php?view=customers">Customers</a></li>
                        <?php } ?>
            		</ul>
                </div>
            </div>

    </div>
</nav>
