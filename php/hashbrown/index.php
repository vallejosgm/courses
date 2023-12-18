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
				if($_POST['sc'] == "LILIAC")
				{
					createNewCredentials($_POST['un'], $_POST['pw']);
					$m = "<h1 class='warning'>The User was created with succesful</h1>";
					header('location: create-account.php?sub=false&emsg='.$m);
				}
				else
				{
					$m = "<h1 class='warning'>The The secret code is not right</h1>";
					header('location: create-account.php?sub=true&emsg='.$m.'&user='.$_POST['un'].'&pass='.$_POST['pw'].'&vpass='.$_POST['vpw'].'&scode='.$_POST['sc']);
				}
			}
			else
			{
				$m = "<h1 class='warning'>The newly entered user name is already in the database</h1>";
				header('location: create-account.php?sub=true&emsg='.$m.'&user='.$_POST['un'].'&pass='.$_POST['pw'].'&vpass='.$_POST['vpw'].'&scode='.$_POST['sc']);
			}
		}
		else
		{
			$m = "<h1 class='warning'>The password and verify password fields do not match</h1>";
			header('location: create-account.php?sub=true&emsg='.$m.'&user='.$_POST['un'].'&pass='.$_POST['pw'].'&vpass='.$_POST['vpw'].'&scode='.$_POST['sc']);
		}
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
				echo '<main>';
					if (!isGranted()){ 
						echo '<h1>Welcome Home</h1>';
						echo $m; 
						echo getForm();
		  		} else { 
						echo getPageContent();
					}; 
				?>
			</main>
		</div>
	</body>
</html>