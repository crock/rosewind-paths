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
		<form class="navbar-form navbar-left form-search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-primary btn-search">Go</button>
        </form>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="catalog.php?<?php echo http_build_query(array('type' => array('book', 'food')));?>">Activities</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                 </ul>
            </li>
			<li><a href="catalog.php?type=list">Packing Lists</a></li>
		</ul>
    </div>
  </div>
</nav>
