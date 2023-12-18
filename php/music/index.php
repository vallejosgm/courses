<!DOCTYPE html>
<html lang="en">
	<head>
	    <link rel="stylesheet" type="text/css" href="./css/style.css">
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>FAVORITE ALBUMS</title>
	</head>
	<body>
	<?php 
		//initialized of array	
		$arrayAlbums = array(array("Lost in Love","Air Supply","https://www.youtube.com/channel/UCLIx3q_0KLVHAxgxsvh_vSQ"),array("Ghost in the Machine","The Police","https://www.youtube.com/channel/UCuCY8MR9LcAGIXetnKx5SnQ"),array("Entre el agua y el fuego","Jose Luis Perales","https://www.youtube.com/channel/UCTo3VmHW_VwkNu3KV1hPu5A"),array("Bachata Rosa","Juan Luis Guerra","https://www.youtube.com/channel/UC5j34OS3TkHQyk4aPFiV5Sg"),array("The Vanishing Race","Air Supply","https://www.youtube.com/channel/UCLIx3q_0KLVHAxgxsvh_vSQ"),array("Stop","Franco de Vita","https://www.youtube.com/channel/UCB6y3fGQ3CWHF0nkrFAj1bQ"),array("Visualízate","Gente de Zona","https://www.youtube.com/channel/UC-vahV5aaD8x73mIDDdJMQQ"),array("Jordi","Maroon 5","https://www.youtube.com/channel/UCBVjMGOIkavEAhyqpxJ73Dw"),array("Zenyatta Mondatta","The Police","https://www.youtube.com/channel/UCuCY8MR9LcAGIXetnKx5SnQ"),array("Life Support","Air Supply","https://www.youtube.com/channel/UCLIx3q_0KLVHAxgxsvh_vSQ"));

		//creation of the part static of table
		echo "<table border=1>"; 
		echo "<tr>";
		echo '<th>Albums I like</th>';
		echo '<th>Artist Name</th>';
		echo "</tr>";
		 
		//random order of array
		shuffle($arrayAlbums);

		//start for loop and set rows limit
		for($i=0;$i<10;$i++)
		{ 
			echo "<tr>"; 
			//start for loop to set cols limit
			for($j=0;$j<1;$j++){ 
			    echo '<td><a href='.$arrayAlbums[$i][2].'>'.$arrayAlbums[$i][0].'</a></td>';
			    echo '<td>'.$arrayAlbums[$i][1].'</td>';
			}
			echo "</tr>"; 
		} 
		
		echo "</table>"; 
		?>
	</body>
</html>