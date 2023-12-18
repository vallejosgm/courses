<?php 
	function getPageContent($country)
	{
		updateToDB($country);
		$countries = getDataDB();
		$dataName = json_encode($countries) ;
		$displayPageContent = "";

		$displayPageContent .= '<h1 id="statTitle">Thanks for your vote!</h1>';
		$displayPageContent .= buildingTable($countries);
		$displayPageContent .= buildingGraph($dataName);
		
		return $displayPageContent;
	}

	function getForm($text)
	{
		$displayForm = "";
		$displayForm .= '<form action="index.php" method="post">';
		$displayForm .= '<h1>'.$text.'</h1>';
		$displayForm .= '<input type="radio" id="country1" name="country" value="France">';
		$displayForm .= '<label for="country1">France</label><br>';
		$displayForm .= '<input type="radio" id="country2" name="country" value="Italy">';
		$displayForm .= '<label for="country2">Italy</label><br>';
		$displayForm .= '<input type="radio" id="country3" name="country" value="USA">';
		$displayForm .= '<label for="country3">USA</label><br>';
		$displayForm .= '<input type="radio" id="country4" name="country" value="Peru">';
		$displayForm .= '<label for="country4">Peru</label><br>';
		$displayForm .= '<input type="submit" value="CHOOSE!!!">';
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

	function getDataDB()
	{
		$con = connectToDB();
		$sql = 'SELECT country, round((votes/(SELECT sum(votes) FROM bestdish))*100,2) as "vote_percentage" FROM bestdish ORDER BY 2 DESC;';
		$results = mysqli_query($con, $sql);
		if(!mysqli_num_rows($results)) return false;
		$countries2 = [];
		$votes2 = [];
		while ($record = mysqli_fetch_array($results, MYSQLI_ASSOC))
		{
			$countries[] = $record;
		}
		mysqli_close($con);
		return $countries;
	}

	function buildingTable($data){
		$display = '';
		$display .= '<table id="stat">';
		$display .= '<tr>';
		$display .= '<th>Country</th><th>Votes</th>';
		$display .= '</tr>';
		foreach($data as $x => $val) {
			$display .= '<tr><td>'.$val["country"].'</td><td>';
			$display .= $val["vote_percentage"]<0.001?'0 votes</td></tr>':$val["vote_percentage"].'% of the votes</td></tr>';
		}
		$display .= '</table>';

		return $display;
	}

	function BuildingGraph($data) {
		$display = '';
		$display .= '<div align="center">';
		$display .= '<h2>Favorite dish</h2>';
		$display .= '<canvas id="can" height="400" width="650" role="img" aria-label="Bar Chart Values in Percentage."> </canvas>';
		$display .= '</div>';
		$display .= '<script type="text/javascript">';
		$display .= 'graphBar('.$data.');';
		$display .= '</script>';

		return $display;
	}
?>