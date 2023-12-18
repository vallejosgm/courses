<!doctype html>
<html lang="en">
	<head>
		<title>API Test</title>
		<script defer src="js/script.js"></script>
	</head>
	<body>
	<form action="javascript:void(0);">
		<select id="month">
			<?php 
				for ($x = 1; $x<=12; $x++)
					echo '<option value="'.$x.'">'.$x.'</option>';
			?>
		</select>
		<select id="day">
			<?php 
				for ($x = 1; $x<=31; $x++)
					echo '<option value="'.$x.'">'.$x.'</option>';
			?>
		</select>
		
		<input id="quote-getter" type="submit" value="Get Quote">
	</form>
		<div id="quote"></div>
	</body>
</html>