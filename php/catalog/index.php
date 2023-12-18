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
	$m = "";
	if(isset($_POST['login-button']))
	{
		if(getValidateLogin($_POST['un'], $_POST['pw']))
		{
			$_SESSION['granted'] = true;
		}
		if(!isGranted()) $m = '<h1 class="warning">Access Denied</h1>';
	}
	if(isset($_POST['new-account-button']))
	{
		if($_POST['pw'] == $_POST['vpw'])
		{
			if(!userDuplicate($_POST['un']))
			{
				createNewCredentials($_POST['un'], $_POST['pw']);
				$m = "<h1 class='warning'>The User was created with succesful</h1>";
				header('location: create-account.php?sub=false&emsg='.$m);
			}
			else
			{
				$m = "<h1 class='warning'>The user you have entered already exists.</h1>";
				header('location: create-account.php?sub=true&emsg='.$m.'&user='.$_POST['un'].'&pass='.$_POST['pw'].'&vpass='.$_POST['vpw']);
			}
		}
		else
		{
			$m = "<h1 class='warning'>The password and verify password fields do not match</h1>";
			header('location: create-account.php?sub=true&emsg='.$m.'&user='.$_POST['un'].'&pass='.$_POST['pw'].'&vpass='.$_POST['vpw']);
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link type="text/css" rel="stylesheet" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<div class="main-wrapper">
		<?php 
			include('includes/nav.php');
			echo '<main>';
				if (!isGranted()){ 
					echo '<div class="fontAcme">Welcome Home!!!</div>';
					echo $m; 
					echo getForm();
	  		} else { 
					echo getPageContent();
				}; 
			echo '</main>';	
		?>
	</div>
</body>
</html>