<?php 
	$wordCounter = 0; 
	if(!empty($_POST['search-word'])) $searchWord = $_POST['search-word'];
	else header('location: .?error=true');	
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Palindrome Stuff</title>
		<link rel="stylesheet" href="css/style.css" type="text/css">
	</head>
	<body>
		<main>
			<?php 
				
				$inputs = array("alley cats","i did, did i?","Madam I'm Adam","eve","Stack Cats","bob","chicken","liver","donkey","race car");

				echo output($inputs, $searchWord);
				echo wordCountOutput($searchWord);
			?>
		</main>
	</body>
</html>

<?php

	function wordCountOutput($sw)
	{
		global $wordCounter;
		echo "<section><p>There are $wordCounter instances of $sw on this site</p></section>";
	}
	function output($inputArray, $sw)
	{
		global $wordCounter;
		$return = "";
		foreach($inputArray as $input)
		{
			if(strpos(strtolower($input), $sw) !== false) $wordCounter++;
			
			$return .= "<section><h3>Facts About \"$input\"</h3>";
			$return .= "<ul>";
			$return .= "<li> Palindrome: ".(isPalindrome($input) ? "<span class='message'>TRUE</span>" : "<span class='warning'>FALSE</span>")."</li>";
			$return .= "<li> Number of Characters: <span class='contrast'>".strlen($input)."</span></li>";
			$return .= "<li> Number of Words: <span class='contrast'>".str_word_count($input)."</span></li>";
			$return .= "</ul></section>";
		}
		
		return $return;
	}
		
	function isPalindrome($phrase)
	{
		
		//removes spaces from phrase
		$phrase = str_replace(" ", "", $phrase); 
		$phrase = str_replace("'", "", $phrase); 
		$phrase = str_replace("?", "", $phrase); 
		$phrase = str_replace("/", "", $phrase); 
		$phrase = str_replace("\\", "", $phrase); 
		$phrase = str_replace(".", "", $phrase); 
		$phrase = str_replace(",", "", $phrase); 
		
		//lower case the phrase
		$phrase = strtolower($phrase);
		
		//reverse phrase and assign to variable
		$revPhrase = strrev($phrase);
		
		//compare and return
		if($revPhrase == $phrase) return true;
		else return false;
	}
?>
