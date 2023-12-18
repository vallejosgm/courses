<?php
 	session_start();
	include_once('includes/important-stuff.php');
	#if(!isGranted()) header('location: .');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Hashbrown</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<link type="text/css" rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="main-wrapper">
			<?php include('includes/nav.php'); ?>
			<div class="video-container">
				<h1>Users and Passwords</h1>
				<?php echo outputUsers(); ?>
			</div>
		</div>
	</body>
</html>