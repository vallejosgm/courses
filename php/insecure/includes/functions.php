<?php 
	function getPageContent()
	{
		$displayPageContent = "";

		$displayPageContent .= '<h1>Access Granted</h1>';
		$displayPageContent .= getTextOfFile('includes/fbi.txt');
		
		return $displayPageContent;
	}

	function getForm($text)
	{
		$displayForm = "";
		$displayForm .= '<form action="index.php" method="post">';
		$displayForm .= '<h1>'.$text.'</h1>';
		$displayForm .= '<input type="text" name="un" placeholder="Username">';
		$displayForm .= '<input type="password" name="pw" placeholder="Password">';
		$displayForm .= '<input type="reset" name="reset-button" value="Reset">';
		$displayForm .= '<input type="submit" name="login-button" value="Log In">';
		$displayForm .= '</form>';

		return $displayForm;
	}

	function updateToDB($p)
	{
		//GRAB CONNECTION
		$con = connectToDB();
		
		//WRITING COMMAND
		$sql = 'UPDATE bestdish SET votes = (votes + 1) WHERE country = "'.$p.'";';
		
		//RUN THE COMMAND
		mysqli_query($con, $sql);

		//CLOSING CONNECTION
		mysqli_close($con);
	}

	function getValidateLogin($us, $pw)
	{
		$con = connectToDB();
		$sql = 'SELECT username, password FROM users WHERE username="'.$us.'" and password="'.$pw.'";';
		$results = mysqli_query($con, $sql);
		if(!mysqli_num_rows($results)) return false;
		else return true;
		#$row = $results->fetch_array(MYSQLI_ASSOC);
		#mysqli_close($con);
		#return $row;
	}

	function getTextOfFile($fileName)
	{
		$inputs = readTextFile($fileName);
		$displayPageContent = '<h2>'.strtoupper(substr($fileName, 9, -4).'</h2>');
		$displayPageContent .= output($inputs);

		return $displayPageContent;
	}

	function validateLogin($user,$pwd)
	{
		global $users;
		for ($i = 0; $i < count($users); $i ++)
		{
    		if (($users[$i]['username'] === $user) && ($users[$i]['password'] === $pwd))
    		{
       			return 'true';
		    }
		}
		return 'false';
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