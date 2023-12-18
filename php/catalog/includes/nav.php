<nav class="navMenu">
	<a href="catalog.php">Products</a>
	<?php echo (!isGranted() ? 
		'<a href="index.php">Log In</a><a href="create-account.php">Create Account</a>' 
		: 
		'<a href="logout.php">Log Out</a><a href="cart.php">Cart</a>');
	?> 
	
</nav>