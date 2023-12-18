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
	<title>Products</title>
	<link type="text/css" rel="stylesheet" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
	<script src="js/script.js"></script>
</head>
<body>
	<?php 
		include_once('includes/nav.php');
		if(isset($_GET['id']))
		{
			echo outputProduct($_GET['id']);
		}
	?>

</body>
</html>