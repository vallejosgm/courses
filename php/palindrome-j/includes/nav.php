<?php
	$pageName = basename($_SERVER['PHP_SELF']);
	$dir = scandir(".");
	$fileNames[] = "index.php";
	
	foreach($dir as $d)
	{
		if((substr($d, -4) === ".php") && ($d !== "index.php")) $fileNames[] = $d;
	}
	
	echo'<nav><ul>';
		foreach ($fileNames as $fileName)
		{
			if($pageName === $fileName) $class=' class="active"'; else $class='';
			if ($fileName === "index.php") {$navText = "Home"; $fileName = ".";}
			else $navText = ucfirst(substr($fileName, 0,-4));
			
			if ($fileName !== "palindrome.php" || $pageName === "palindrome.php") 
				echo '<li><a '.$class.($fileName === "palindrome.php" ? "" : "href=\"$fileName\"").'">'.$navText.'</a></li>';
		}
	echo '</ul></nav>';
?>