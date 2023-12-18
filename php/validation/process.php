<?php
	$ec = 0;
	if(!empty($_POST['phone']))
	{
		if(!preg_match("/\(\d{3}\)\d{3}[-]\d{4}$/", $_POST['phone'])) $ec +=1;
		if($ec) header('location: .?sub=true&ec='.$ec.'&ph='.$_POST['phone']);
	}
	else
	{
		header('location: .?sub=true&ec=0&ph='.$_POST['phone']);
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
<body class="process">
	<section id="face" class="pagewrap">
		<?php echo "<p class='p1'>Thank you</p>"; 
		echo "<p class='p2'>Your phone Number is valid</p>";
		echo "<p class='p3'>".$_POST['phone']."</p>";?>
	</section>
</body>
</html>