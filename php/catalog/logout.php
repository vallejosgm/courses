<?php
	include('includes/db.php');
	session_start();
	session_destroy();
	header('location: .');
?>