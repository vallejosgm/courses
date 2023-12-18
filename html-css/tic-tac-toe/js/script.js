var form = document.getElementById("form");
var markers = ["./img/hulk.png", "./img/ironman.png"];
var players = ["",""];
var totals = [0, 0];
var winCodes = [7, 56, 73, 84, 146, 273, 292, 448];
var gameOver = false;
var whoseTurn = 0;
var scoreBoards = [0,0,0];

form.addEventListener('submit', function(event){

	event.preventDefault() //prevents the form from autosubmitting

	var player1 = document.getElementById("player-1").value;
	var player2 = document.getElementById("player-2").value;

	document.getElementById('tic-tac-toe').style.display = "block";
	document.getElementById('input-player').style.display = "none";
	
    players[0] = player1;
    players[1] = player2;
    startGame();
});

function startGame()
{
	var counter = 1;
	var innerDivs = "";
	showScoreBoards();

	for (i = 1; i <= 3; i++)
	{
		innerDivs += '<div id="row-' + i + '">'
		
		for (j = 1; j <= 3; j++) 
		{
			innerDivs += '<div><img onclick="playGame(this,' + counter + ');" src="./img/0.png"></div>';
			counter *= 2;
		}

		innerDivs += '</div>';
	}
	document.getElementById("game-board").innerHTML = innerDivs;
	totals = [0, 0];
	gameOver = false;
	document.getElementById("game-restart").style.display = "none";
	document.getElementById("game-message").innerText = "It's " + players[whoseTurn] + "'s Turn";
}

function playGame(clickedDiv, divValue)
{
	if (!gameOver)
	{
		//add x or o to playing field
		clickedDiv.src = markers[whoseTurn];
    	clickedDiv.style.transform = "rotate(-45deg)";

		//increment players' total count for a possible win
		totals[whoseTurn] += divValue;

		//call isWin() function
		if (isWin())
		{
			document.getElementById("game-message").innerText = players[whoseTurn] + " Wins!";
		}
		else if (gameOver)
		{
			document.getElementById("game-message").innerText = "There is no winner!";
		}
		else
		{
			//toogle player turn
			if (whoseTurn) whoseTurn = 0; else whoseTurn = 1;

			//prevent clicking on same div again
			clickedDiv.attributes["0"].nodeValue = "";

			//toogle message to display next player
			document.getElementById("game-message").innerText = "It's " + players[whoseTurn] + "'s Turn";
		}
	}		
}

//win code logic
function isWin()
{
	for (i = 0; i < winCodes.length; i++)
	{
		if ((totals[whoseTurn] & winCodes[i]) == winCodes[i]) 
		{ 
			gameOver = true;
			scoreBoards[whoseTurn] += 1;
			showScoreBoards();
			document.getElementById("game-restart").style.display = "block";
			return true;
		}
	} 

	if (totals[0] + totals[1] == 511) 
	{
		gameOver = true;
		scoreBoards[2] += 1;
		showScoreBoards();
		document.getElementById("game-restart").style.display = "block";
	}

	return false
}

function showScoreBoards() 
{
	document.getElementById("player1").innerText = players[0];
	document.getElementById("player2").innerText = players[1];
	document.getElementById("score1").innerText = scoreBoards[0];
	document.getElementById("score2").innerText = scoreBoards[1];
	document.getElementById("scoreTie").innerText = scoreBoards[2];
}

	
