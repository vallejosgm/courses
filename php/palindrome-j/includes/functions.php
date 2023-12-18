<?php
	function appendToTextFile($array)
	{
		$fn = 'text/palindromes.txt';
		$textfile = getPalindromesTextFile();
		
		foreach($textfile as $word)
		{
			$newtext[] = cleanWord($word);
		}

		$size = filesize($fn);
		$newarray = [];
		
		if ($size) 
		{
			for ($x = 0; $x < sizeof($array); $x++)
			{
				if (!in_array(cleanWord($array[$x]), $newtext))
				{
					$newarray[] = $array[$x];
				}
			}
			$comma=",";
		}
		else
		{
			$newarray = $array;
			$comma="";
		}
		
		if($newarray) 
		{
			$string = implode (',', $newarray);			
			$string = $comma.$string;		
			$fs = fopen($fn, 'a');
			fwrite($fs, $string);
		}

	}
	function getPalindromesTextFile()
	{
		$fn = 'text/palindromes.txt';
		$size = filesize($fn);
		if (!$size) return false;
		$fs = fopen($fn, 'r');
		$words = fread($fs, $size);
		return explode(',', $words);
	}
	function getPalindromePageContent($palCount,$searchWord, $reload = false)
	{
		$displayPageContent = "";
		if ($reload || (!isset($_POST['palindromes']) && (empty($_POST['default']))))
		{
			$displayPageContent .= '<form method="post">';
				if($reload) $displayPageContent .= '<p class="warning">The Default page is empty. Please enter a palindrome.</p>';
				$displayPageContent .= '<input type="hidden" name="search-word" value="'.$searchWord.'">';
				$displayPageContent .= '<input type="hidden" name="pal-count" value="'.$palCount.'">';
				for ($x=0;$x<$palCount;$x++)
					$displayPageContent .= '<input name="palindromes[]"><br>';
				
					$displayPageContent .= '<input type="submit">';
			$displayPageContent .= '</form>';
		}
		else if (!empty($_POST['default']))
		{
			#$inputs = $_POST['palindromes'];
			$inputs = getPalindromesTextFile();
			if (!$inputs) return getPalindromePageContent(1, $searchWord, true);
			else
			{
				$displayPageContent .= output($inputs, $searchWord);
				$displayPageContent .= wordCountOutput($searchWord);
			}
		}
		else
		{
			$inputs = $_POST['palindromes'];
			appendToTextFile($inputs);
			$displayPageContent .= output($inputs, $searchWord);
			$displayPageContent .= wordCountOutput($searchWord);
		}

		return $displayPageContent;
	}
	function getVariables()
	{
		if(!empty($_GET['word'])) $errorWord = $_GET['word']; else $errorWord = "";
		if(!empty($_GET['num'])) $errorNum = $_GET['num']; else $errorNum = 0;
		if(!empty($_GET['ec'])) $errorCode = $_GET['ec']; else $errorCode = 0;
		if(!empty($_GET['cb'])) $chkbox = $_GET['ec']; else $chkbox = false;
		
		return array($errorWord, $errorNum, $errorCode, $chkbox);
	}
	function getDropDown($en, $num)
	{
		$retSelect = "";
		$retSelect .= '<select id="pal-num-dd" name="pal-count">';
		$retSelect .= '<option value="" disabled ';
		$retSelect .=  (!$en ? " selected " : "");
		$retSelect .= ' hidden>How Many Palindromes?</option>';

		for ($x = 1; $x <=$num; $x++)
		{
			$retSelect .= '<option '.($x == $en ? " selected " : "").' value="'.$x.'">'.$x.' Palindrome'.($x==1 ? "" : "s").'</option>';
		}

		$retSelect .= '</select>';
		
		return $retSelect;
	}
	function getErrorMessage($errorCode)
	{
		//ec = 1, ec = 2, ec = 3; num, word, both
		$retMsg = "";
		switch($errorCode)
		{
			case 4: $retMsg .= '<p class="warning">Search Words cannot contain numbers.</p>'; break;
			case 3:
			case 2: $retMsg .= '<p class="warning">Enter a Word to Search for.</p>'; if($errorCode != 3) break;
			case 1: $retMsg .= '<p class="warning">Choose a number of Palindromes or Check the default.</p>';
		}
		
		return $retMsg;
	}
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
			
			$return .= "<section><h3>$input</h3>";
			$return .= "<ul>";
			$return .= "<li> Palindrome: ".(isPalindrome($input) ? "<span class='message'>TRUE</span>" : "<span class='warning'>FALSE</span>")."</li>";
			$return .= "<li> Number of Characters: <span class='contrast'>".strlen($input)."</span></li>";
			$return .= "<li> Number of Words: <span class='contrast'>".str_word_count($input)."</span></li>";
			$return .= "</ul></section>";
		}
		
		return $return;
	}
		
	function cleanWord($wordToClean)
	{
		//removes spaces from phrase
		$wordToClean = preg_replace ( "/(\w*)(\W*)/" , "$1" , $wordToClean);

		//lower case the phrase
		$wordToClean = strtolower($wordToClean);
		
		return $wordToClean;
	}
	
	function isPalindrome($phrase)
	{
		
		$phrase = cleanWord($phrase);
		
		//reverse phrase and assign to variable
		$revPhrase = strrev($phrase);
		
		//compare and return
		if($revPhrase == $phrase) return true;
		else return false;
	}
?>