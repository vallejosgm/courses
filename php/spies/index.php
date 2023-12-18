<?php
  error_reporting(-1);
  ini_set( 'display_errors', 1 );
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Secret Lists</title>
		<link rel="stylesheet" href="css/style.css" type="text/css">
	</head>
	<body>
		<?php	include_once('includes/important-stuff.php');?>
		<main>
			<?php
				if(!empty($_POST['username']) && !empty($_POST['password']))
				{
					echo getPageContent($_POST['username'], $_POST['password']);
				}
				else 
				{
					if(!empty($_POST['spie']) || !empty($_POST['fbi']))
					{
						echo getTextOfFile(empty($_POST['spie'])? 'includes/fbi.txt':'includes/spies.txt');
					}
					else
					{
						echo getForm('Welcome');
					}
				}
			?>
		</main>
	</body>
</html>