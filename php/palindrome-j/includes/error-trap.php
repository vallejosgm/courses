<?php
	
	if(!empty($_POST['search-word']) && (!empty($_POST['pal-count']) || !empty($_POST['default']) ))
	{

		$searchWord = $_POST['search-word'];
		if (isset($_POST['pal-count'])) $palCount = $_POST['pal-count']; else $palCount = 0;
		
		if (preg_match('/\d+/',$_POST['search-word'])) 
		{
			$ew = $searchWord;
			$en = $palCount;
			$ec = 4;
		}
	}
	else
	{
		if (!empty($_POST['search-word'])) $ew = $_POST['search-word']; else $ec +=2;
		if (!empty($_POST['pal-count'])) $en = $_POST['pal-count']; elseif (empty($_POST['default'])) $ec +=1;
		if (!empty($_POST['default'])) $cb = 'checked'; else $cb = false;
	}

	if ($ec) header('location: .?word='.$ew.'&num='.$en.'&ec='.$ec.'&cb='.$cb);	
?>