<?php
	$title = basename($_SERVER['PHP_SELF']);
	$title = substr($title, 0, -4);
	$title = ($title == 'index' ? 'Home' : $title);
	$title = ucfirst($title). ' Page';
 echo 
 '
 	<head>
		<title>'.$title.'</title>
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<script src="js/script.js"></script>
	</head>
';
?>