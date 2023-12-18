<?php
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }
?>
<?php
	session_start();
	include ('includes/functions.php');
	include ('includes/db.php');
	$m = "";
	if(isset($_POST['login-button']))
	{
		if(getValidateLogin($_POST['un'], $_POST['pw']))
		{
			$_SESSION['granted'] = true;
		}
		if(!isGranted()) $m = '<h1>Access Denied</h1>';
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sessions</title>
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