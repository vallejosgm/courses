var form = document.getElementById("form");

form.addEventListener('submit', function(event){

	event.preventDefault() //prevents the form from autosubmitting

	var noun1 = document.getElementById("noun1").value;
	var noun2 = document.getElementById("noun2").value;
	var adjective1 = document.getElementById("adjective1").value;
	var adjective2 = document.getElementById("adjective2").value;
	var verb1 = document.getElementById("verb1").value;
	var verb2 = document.getElementById("verb2").value;	
	
	var result = "Scarlett Johansson, was born in Manhattan, New York, in 1984. In 1994 she made her film debut as " + noun1 + " in the fantasy comedy 'North'. "
    	result += "She was nominated for " + adjective1 + " Golden Globe Awards. She is a prominent endorser and enjoys to " + verb1 + " and supporting several charitable causes. "
    	result += "She received two simultaneous Academy Award nominations Best " + noun2 + " and Best Supporting " + noun2 + ".  "
    	result += "Labeled like a sex symbol, Johansson has been referred to as one of the world's most " + adjective2 + " women by various media outlets. "
    	result += "She says her secret to success is " + verb2 + "."         
    
    document.getElementById('results').style.display = "block";
    
    document.getElementById("story-text").textContent = result;
	});