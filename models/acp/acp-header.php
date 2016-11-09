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
			<li class="nav-icon" title="Client View"><a href="signin.php"><span class="glyphicon glyphicon-user"></span></a></li>
			<li class="nav-icon" title="Logout"><a href="cart.php"><span class="glyphicon glyphicon-off"></span></a></li>
		</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<nav id="navbar-lower" class="navbar navbar-inverse" role="navigation">
  <div class="container">
    <div class="collapse navbar-collapse collapse-buttons">
		<form class="navbar-form navbar-left form-search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-primary btn-search">Go</button>
        </form>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="admin.php?page=orders">Recent Orders</a></li>
			<li><a href="admin.php?page=catalog">Catalog</a></li>
			<li><a href="admin.php?page=analytics">Analytics</a></li>
			<li><a href="admin.php?page=support">Support</a></li>
			<li><a href="admin.php?page=settings">Settings</a></li>
		</ul>
    </div>
  </div>
</nav>
