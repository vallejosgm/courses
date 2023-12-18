<?php
  error_reporting(-1);
  ini_set( 'display_errors', 1 );
?>
<?php include_once('includes/important-stuff.php');?>
<!DOCTYPE html>
<html lang="en">
	<?php include_once('includes/head.php');?>
	<body>
		<?php include_once('includes/important-stuff.php');?>
		<div class="main-wrapper">
			<main>
				<div>
					<?php
						if(!empty($_POST['country']))
						{
							echo getPageContent($_POST['country']);
						}
						else 
						{
							echo getForm('What is the BEST DISH in the WORLD?');
						}
					?>
				</div>
			</main>
		</div>
	</body>
</html>