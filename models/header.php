<nav id="navbar-upper" class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-custom">
            <div class="row">
                <div class="col-sm-6">
                    <a class="navbar-brand" href="home.php">
                        <img src="img/full_logo.svg" alt="Rosewind Paths Compass Logo" width="300" height="75">
                    </a>
                </div>
                <div class="col-sm-6">
                    <ul class="social pull-right">
                        <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/?lang=en"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</nav>
<nav id="navbar-lower" class="navbar navbar-inverse" role="navigation">
    <div class="container">

            <div class="row">
                <div class="col-sm-6">
                    <form class="form-search" role="search" action="catalog.php">
                        <div class="input-group input-group-lg input-group-full">
                            <input type="text" name="q" class="form-control" aria-label="Search">
                            <div class="input-group-btn">
                                <?php if (sizeof($parent_categories) > 1) { ?>
                                <div class="btn btn-default">
                                    <select class="form-control" name="type" style="width:10em">
                                        <option value="all">All categories</option>
                                        <?php foreach ($parent_categories as $category) { ?>
                                        <option value="<?php echo $category['category_slug']; ?>"><?php echo $category['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php } ?>
                                <button type="submit" class="btn btn-default btn-search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, <?php echo $_SESSION['username']; ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="client.php">Your profile</a></li>
                                <li><a href="client.php">Your orders</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="home.php?signout=1">Sign out</a></li>
                            </ul>
                        </li>
                        <?php } else { ?>
            			<li><a href="signin.php">Sign In</a></li>
                        <?php } ?>
                        <li><a href="cart.php">Cart <span class="badge">5</span></a></li>
            		</ul>
                </div>
            </div>

    </div>
</nav>
