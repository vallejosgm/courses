<?php 
	function getPageContent($username,$password)
	{
		$displayPageContent = "";

		if (validateLogin($username,$password) === 'true')
		{
			$displayPageContent .= '<h1>Access Granted</h1>';
			$displayPageContent .= '<form action="index.php" id="lists" method="post">';
			$displayPageContent .= '<input id="spie" type="submit" name="spie" value="List of Spies">';
			$displayPageContent .= '<input id="fbi" type="submit" name="fbi" value="List of FBI">';
			$displayPageContent .= '</form>';
			$displayPageContent .= '</div>';	
		}
		else 
		{
			$displayPageContent .= getForm("Access Denied");
		}
			return $displayPageContent;
	}

	function getTextOfFile($fileName)
	{
		$inputs = readTextFile($fileName);
		$displayPageContent = '<h1>Access Granted</h1>';
		$displayPageContent .= '<h2>'.ucfirst(substr($fileName, 9, -4).'</h2>');
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
		$return .= "<tr><th>Agent</th><th>Code Name</th></tr>";
		
		foreach($inputArray as $input)
		{
			var_dump($input);
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

	function getForm($text)
	{
		$displayForm = "";
		$displayForm .= '<h1>'.$text.'</h1>';
		$displayForm .= '<form action="index.php" method="post">';
		$displayForm .= '<div class="container">';
		$displayForm .= '<input type="text" name="username">';
		$displayForm .= '<input type="password" name="password">';
		$displayForm .= '<input type="submit">';
		$displayForm .= '</div>';
		$displayForm .= '<div class="container" style="background-color:#f1f1f1">';
		$displayForm .= '<input type="reset">';
		$displayForm .= '</div>';
		$displayForm .= '</form>';

		return $displayForm;
	}
?>