// JAVASCRIPT STUFF
var x;

//Verify the number will be greater than or equal to 8!
do {
	x = prompt("How many lotto picks?");
	if(x >= 8){
		alert("Error. The number cannot be greater than or equal to 8!");
	}	
} while (x >= 8)

var lotto = [];
var lottoPicks = "";

function lotteryGame()
{	
	//fills the lotto array
	for (var i = 0; i < x; i++) lotto[i] = Math.ceil(Math.random() * 99);

	//display the lotto array
	for (var i = 0; i < lotto.length; i++) if (i == 0) lottoPicks += lotto[i]; else lottoPicks += "-" + lotto[i];

	//Show the lotto array in textarea
	document.getElementById("lottoPicks").value = lottoPicks;	
	
    //Play to sound
    document.getElementById("myAudio").play();

    //Clean the array
	lottoPicks = [];

}