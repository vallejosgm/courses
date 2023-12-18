<?php	include_once('includes/important-stuff.php');?>
<!doctype html>
<html lang="en">
	<?php	include_once('includes/head.php');?>
	<body>
		<main>
			<?php	include_once('includes/nav.php');?>
			<form action="palindrome.php" method="post">	
				<div>
					<input onclick="disableDropdown();" <?php echo ($chkbox ? ' checked' : '');?> type="checkbox" id="default" name="default">
					<label onclick="disableDropdown();" for="default">Use Default List?</label>
				</div>
				<?php echo getDropDown($errorNum, $numOfPals); ?>
				<input type="text" name="search-word" value="<?php echo $errorWord;?>" placeholder="Enter a word">
				<input type="submit">
				<?php echo getErrorMessage($errorCode);	?>
			</form>
		</main>
	</body>
</html>