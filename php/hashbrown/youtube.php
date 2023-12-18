<?php
 	session_start();
	include ('includes/functions.php');
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
				<h1>Youtube</h1>
				<iframe  src="https://www.youtube.com/embed/_wpuHXPO-uI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" width="600px" height="400px"  allowfullscreen>
				</iframe>
			</div>
		</div>
	</body>
</html>