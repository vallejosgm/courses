<?php
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }
?>
<?php
	session_start();
	include_once('includes/important-stuff.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cart</title>
	<link type="text/css" rel="stylesheet" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
	<script src="js/script.js"></script>
</head>
<body>
	<?php 
		include_once('includes/nav.php');

		if(!isGranted()){
			echo '<h1>You will log in first.</h1>';
			echo '<a class="log-in" href="index.php">Log In</a>';
		} else {
			if(isset($_POST['idProduct'])){
				echo outputCart($_POST['idProduct'], $_POST['qty']);
			} else {
				if (isset($_POST['place'])) {
					echo shoppingDone();
				} else {
					if (isset($_POST['update'])){
						echo updateTableCart($_POST['arrayQty'], $_POST['arrayId']);
					} else {
						echo buildingTableCart();	
					}
				}				
			}
		} 
	?>



</body>
</html>