<nav id="navbar-upper" class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="home.php">
			<img src="img/full_logo.svg" alt="Rosewind Paths Compass Logo" width="300" height="75">
		</a>
    </div>
  </div>
</nav>
<nav id="navbar-lower" class="navbar navbar-inverse" role="navigation">
  <div class="container">
    <div class="collapse navbar-collapse collapse-buttons" id="bs-navbar-collapse">
		<form class="navbar-form navbar-left form-search" action="admin.php" method="get">
          <div class="form-group">
            <input type="text" class="form-control" name="q" placeholder="Search">
          </div>
          <input type="hidden" name="view" value="catalog" />
          <button type="submit" class="btn btn-primary btn-search">Go</button>
        </form>
		<?php if ( $_SESSION['logged_in'] == true ) { ?>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="admin.php?view=orders">Recent Orders</a></li>
			<li><a href="admin.php?view=catalog">Catalog</a></li>
			<li><a href="admin.php?view=customers">Customers</a></li>
		</ul>
		<?php } ?>
    </div>
  </div>
</nav>
