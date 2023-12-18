<?php 
	function getPageContent()
	{
		$displayPageContent = "";

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

	function getFormNewAccount($em, $us, $p, $vp, $sc)
	{
		$displayForm = "";
		$displayForm .= $em;
		$displayForm .= '<form action="index.php" method="post">';
		$displayForm .= '<input type="text" name="un" value="'.$us.'" placeholder="User Name">';
		$displayForm .= '<input type="password" name="pw" value="'.$p.'" placeholder="Password">';
		$displayForm .= '<input type="password" name="vpw" value="'.$vp.'" placeholder="Verify Password">';
		$displayForm .= '<input type="text" name="sc" value="'.$sc.'" placeholder="Secret Code">';
		$displayForm .= '<input type="submit" name="new-account-button" value="Create Account">';
		$displayForm .= '<div id="btn-na"><input type="reset" name="reset-button" value="Reset">';
		$displayForm .= '</form>';
		$displayForm .= '<a class="log-in" href="index.php">Log In</a>';

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
		$pw = geanVallHash($pw, $us);
		echo $pw;
		$sql = "SELECT username, password FROM secureusers WHERE username='$us' and password='$pw';";
		$results = mysqli_query($con, $sql);
		if(!mysqli_num_rows($results)) $return = false;
		else $return = true;
		mysqli_close($con);
		return $return;
	}

	function getTextOfFile($fileName)
	{
		$inputs = readTextFile($fileName);
		$displayPageContent = '<h2>'.strtoupper(substr($fileName, 9, -4).'</h2>');
		$displayPageContent .= output($inputs);

		return $displayPageContent;
	}

	function outputUsers()
	{
		$users = getUsersDB();
		$displayPageContent = "";
		$displayPageContent .= buildingTable($users);

		return $displayPageContent;
	}

	function getUsersDB()
	{
		$con = connectToDB();
		$sql = 'SELECT username, password FROM secureusers;';
		$results = mysqli_query($con, $sql);
		if(!mysqli_num_rows($results)) return false;
		while ($record = mysqli_fetch_array($results, MYSQLI_ASSOC))
		{
			$users[] = $record;
		}

		mysqli_close($con);
		return $users;
	}

	function userDuplicate($user) 
	{
		$con = connectToDB();
		$sql = 'SELECT username FROM secureusers WHERE username="'.$user.'";';
		$results = mysqli_query($con, $sql);
		if(!mysqli_num_rows($results)) 
			return false;
		return true;
	}

	function buildingTable($data){
		$display = '';
		$display .= '<table id="users">';
		$display .= '<tr>';
		$display .= '<th>Users</th><th>Passwords</th>';
		$display .= '</tr>';

		foreach($data as $x => $val) {
			$display .= '<tr><td>'.$val["username"].'</td><td>'.$val["password"].'</td></tr>';
		}
		$display .= '</table>';

		return $display;
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
		$return .= "<table id='users'>";
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

	function createNewCredentials($u, $p) 
	{
		$u = htmlentities($u);
		$p = htmlentities($p);

		$con = connectToDB();
		$u = mysqli_real_escape_string($con, $u);
		$p = mysqli_real_escape_string($con, $p);
		$p = geanVallHash($p, $u);
		$sql = 'INSERT INTO secureusers (username, password) VALUES ("'.$u.'","'.$p.'");';
		$results = mysqli_query($con, $sql);
		mysqli_close($con);
	}

	function geanVallHash($word, $p)
	{
			$sp1 = 'ksdjbksdjbkac;kajbckajsbdccdc';
			$sp2 = 'pmknotnixqrycwxlsdjfh;kbiweece';

			$p = $sp1.$p.$sp2;
			$pdouble = $sp1.$p.$p.$sp2;

			$salt1 = hash('sha512', $p);
			$salt2 = hash('sha512', $pdouble);

			$word = $salt1.$word.$salt2;
			$word = hash('sha512', $word);

			return $word;
	}
?>