<nav id="navbar-upper" class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="home.php">
			<img src="img/full_logo.svg" alt="Rosewind Paths Compass Logo">
		</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav navbar-right">
			<li class="nav-icon" title="Sign In/Sign Up"><a href="signin.php"><span class="glyphicon glyphicon-user"></span></a></li>
			<li class="nav-icon" title="Shopping Cart"><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
		</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<nav id="navbar-lower" class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="collapse navbar-collapse collapse-buttons">
            <div class="col-sm-6">
                <div class="vertical-align-md">
                    <form role="search" action="catalog.php">
                        <div class="input-group input-group-lg input-group-full">
                            <input type="text" name="search" class="form-control" aria-label="Search">
                            <div class="input-group-btn">
                                <div class="btn btn-default">
                                    <select class="form-control" name="type" style="width:10em">
                                        <option value="all">All categories</option>
                                    <?php foreach (get_categories("WHERE category_parent = 0") as $category) { ?>
                                        <option value="<?php echo $category['category_slug']; ?>"><?php echo $category['category_name']; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default btn-search" aria-label="Execute search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <ul class="nav navbar-nav navbar-right">
        			<li><a href="catalog.php?type=featured">Featured Items</a></li>
        			<li><a href="catalog.php?type=list">Packing Lists</a></li>
        		</ul>
            </div>
        </div>
    </div>
</nav>
