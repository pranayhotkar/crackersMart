<nav class="light-blue lighten-1" role="navigation">
		<div class="nav-wrapper container"><a id="logo-container" href="index.php" class="brand-logo"><i class="large material-icons left">shopping_basket</i>CrackersMart</a>
			<ul class="right hide-on-med-and-down" id="products-dropdown" >
				<li><a class="dropdown-button" href="#!" data-activates="dropdown1">All Products<i class="material-icons right">arrow_drop_down</i></a></li>
			</ul>
			<ul class="right hide-on-med-and-down" id="products-dropdown" >
				<li><a class="dropdown-button" href="#!" data-activates="dropdown2">All Brands<i class="material-icons right">arrow_drop_down</i></a></li>
			</ul>
			
			<ul class="right hide-on-med-and-down">
				<li><a href="cart.php"><i class="material-icons shopping_cart tiny left">shopping_cart</i>Shopping Cart<span class="white-text badge blue"><?php total_items();?> Items</span></a></li>
			</ul>
			<ul class="right hide-on-med-and-down">
				<li><a href="#"><i class="material-icons shopping_cart tiny left">perm_identity</i>My Account</a></li>
			</ul>
			<ul id="dropdown1" class="dropdown-content">
				<?php getCats();?>
				<li class="divider"></li>
				<li><a href="all_products.php">All Categories</a></li>
			</ul>
			<ul id="dropdown2" class="dropdown-content">
				<?php getBrands();?>
				<li class="divider"></li>
				
			</ul>
			<ul id="nav-mobile" class="side-nav">
				<li><a href="#">Navbar Link</a></li>
			</ul>
			<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
		</div>
	</nav>