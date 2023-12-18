<?php include_once('includes/important-stuff.php'); include_once('includes/error-trap.php');?>
<!doctype html>
<html lang="en">
	<?php	include_once('includes/head.php');?>
	<body>
		<?php	include_once('includes/nav.php');?>
		<main class="pal-main">
			<?php echo getPalindromePageContent($palCount,$searchWord); ?>
		</main>
	</body>
</html>