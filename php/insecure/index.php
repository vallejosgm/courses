<?php
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }
?>
<?php
	include ('includes/functions.php');
	include ('includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Insecure Passwords</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<link type="text/css" rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="main-wrapper">
			
			<main>
				<?php
					if(isset($_POST['login-button'])) {
						if(getValidateLogin($_POST['un'], $_POST['pw'])) echo getPageContent();
						else echo getForm("Access Denied");
					} 
					else echo getForm("Welcome Home");
				?>
			</main>
		</div>
	</body>
</html>