let x = new XMLHttpRequest();
let button = document.getElementById('quote-getter').addEventListener('mousedown', quote);

function quote()
{
	let month = document.getElementById('month').value;
	let day = document.getElementById('day').value;
	
	x.open("GET", "http://numbersapi.com/"+month+"/"+day+"/date");
	// x.open("GET", "http://swquotesapi.digitaljedi.dk/api/SWQuote/RandomStarWarsQuote");
	x.send();
	
	x.onreadystatechange = function ()
	{
		if(x.readyState == 4 && x.status == 200)
		{
			// console.log('we are ready');
			document.getElementById('quote').innerHTML = x.responseText;
			// let swq = JSON.parse(x.responseText)
			// document.getElementById('quote').innerHTML = swq.starWarsQuote;
			// console.log(swq.starWarsQuote);
		}
	}
}
