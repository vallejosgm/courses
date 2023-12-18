<?php

	if ($_SERVER['HTTP_HOST'] == 'localhost')
	{
		define('HOST', 'localhost');
		define('USER', 'root');
		define('PASS', '1550');
		define('DB', 'php_course');
	}
	else
	{
		define('HOST', 'sql109.byethost4.com');
		define('USER', 'b4_32465578');
		define('PASS', 'Larrycom4140');
		define('DB', 'b4_32465578_php_course');
	}
	
	function connectToDB()
	{
		$conn = mysqli_connect(HOST,USER,PASS,DB);
		return $conn;
	}


?>