<?php
	$emsg = $ph = ""; $ec = 0;

	if (isset($_GET['sub']) && $_GET['sub'] == "true")
	{
		$errorMessage[0] = "<p class='message-0'>Fill everything out!</p>";
		$errorMessage[1] = "<p class='message-1'>The phone number is not valid.</p>";
			
		if(isset($_GET['ph'])) $ph = $_GET['ph'];
		if(isset($_GET['ec'])) $ec = $_GET['ec'];
			
		switch($ec)
		{
			case 1: $emsg = $errorMessage[1]; break;
			case 0: $emsg = $errorMessage[0]; break;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Validation</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	<form class="pagewrap" action="process.php" method="post">
		<input type="text" value="<?php echo $ph;?>" placeholder="Phone Number" name="phone">
		<div>
			<input type="reset">
			<input type="submit">
		</div>
		<?php echo $emsg; ?>
	</form>	
	
</body>
</html>



