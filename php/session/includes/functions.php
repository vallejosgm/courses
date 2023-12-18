<?php 
	function getPageContent()
	{
		$displayPageContent = "hola";

		$displayPageContent .= '<h1>Access Granted</h1>';
		$displayPageContent .= getTextOfFile('includes/fbi.txt');
		
		return $displayPageContent;
	}

	function getForm()
	{
		$displayForm = "";
		$displayForm .= '<form action="index.php" method="post">';
		$displayForm .= '<input type="text" name="un" placeholder="Username">';
		$displayForm .= '<input type="password" name="pw" placeholder="Password">';
		$displayForm .= '<input type="reset" name="reset-button" value="Reset">';
		$displayForm .= '<input type="submit" name="login-button" value="Log In">';
		$displayForm .= '</form>';

		return $displayForm;
	}

	function isGranted()
	{
		if(isset($_SESSION['granted'])) return true;
		
		return false;
	}

	function getValidateLogin($us, $pw)
	{
		$con = connectToDB();
		$sql = 'SELECT username, password FROM users WHERE username="'.$us.'" and password="'.$pw.'";';
		$results = mysqli_query($con, $sql);
		if(!mysqli_num_rows($results)) return false;
		else return true;
	}

	function getTextOfFile($fileName)
	{
		$inputs = readTextFile($fileName);
		$displayPageContent = '<h2>'.strtoupper(substr($fileName, 9, -4).'</h2>');
		$displayPageContent .= output($inputs);

		return $displayPageContent;
	}

	function readTextFile($fn)
	{
		$fs = fopen($fn, 'r');
		$words = fread($fs, filesize($fn));
		return explode('||>><<||', $words);
	}

	function output($inputArray)
	{
		$return = "";
		$return .= "<table id='agents'>";
		$return .= "<tr><th>AGENTS</th><th>CODE NAME</th></tr>";
		
		foreach($inputArray as $input)
		{
			$input = mb_convert_case($input, MB_CASE_TITLE, "UTF-8");
			$infoAgents = explode(",", $input);
			$return .= "<tr>";
			foreach($infoAgents as $infoAgent)
			{
				$return .= "<td>".$infoAgent."</td>";	
			}
			$return .= "</tr>";
		}
		$return .= "</table>";
		
		return $return;
	}
?>