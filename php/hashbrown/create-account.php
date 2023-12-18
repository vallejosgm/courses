<?php
 	session_start();
	include_once('includes/important-stuff.php');
	$emsg= $user= $pass= $vpass= $scode= ""; 
	if (isset($_GET['sub']) && $_GET['sub'] == "true")
	{
		if(isset($_GET['emsg'])) $emsg = $_GET['emsg'];
		if(isset($_GET['user'])) $user = $_GET['user'];
		if(isset($_GET['pass'])) $pass = $_GET['pass'];
		if(isset($_GET['vpass'])) $vpass = $_GET['vpass'];
		if(isset($_GET['scode'])) $scode = $_GET['scode'];
	}
	if ($_GET['sub'] == "false")
	{
		if(isset($_GET['emsg'])) $emsg = $_GET['emsg'];
	}
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
			<?php 
				include('includes/nav.php'); 
				if ($_GET['sub'] == "false"){
			?>
				<div id="new-success" class="video-container">
					<?php echo $emsg ?>
					<a class="log-in" href="index.php">Log In</a>
				</div>
			<?php 
				}
				else{
			?>		
				<div class="video-container">
					<h1>Create New Account</h1>
					<?php echo getFormNewAccount($emsg, $user, $pass, $vpass, $scode); ?>
				</div>
			<?php	
				}
			?>
		</div>
	</body>
</html>