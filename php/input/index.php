<!doctype html>
<html lang="en">
	<head>
		<title>Input Stuff</title>
		<link rel="stylesheet" href="./css/style2.css" type="text/css">
	</head>
	<body>
		<main>
				<?php
					if(isset($_POST['submit']))  // if submit button was pressed (you have form data)
					{
    					if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['phone']) && !empty($_POST['email'])) {
    						$fname = $_POST['fname'];
    						$lname = $_POST['lname'];
    						$phone = $_POST['phone'];
    						$email = $_POST['email'];
    					}
						else 
							header('location: .?error=true');	
						
						echo'<div class="content-message">';
						echo'<p class="message">Thank you for your information</p>';
						echo'<p class="message">Your first name is   : '.$fname.'</p>';	
						echo'<p class="message">Your last name is    : '.$lname.'</p>';	
						echo'<p class="message">Your phone number is : '.$phone.'</p>';	
						echo'<p class="message">Your email address is: '.$email.'</p>';	
						echo'</div>';
					}
					else                // if submit button wasn't pressed (you don't have form data)
					{
    					echo'<form action="#" method="post">';
    					echo'<input type="text" class="feedback-input" name="fname" placeholder="Enter your first name">';
    					echo'<input type="text" class="feedback-input" name="lname" placeholder="Enter your last name">';
    					echo'<input type="text" class="feedback-input" name="phone" placeholder="Enter your phone number">';
    					echo'<input type="text" class="feedback-input" name="email" placeholder="Enter your email address">';
    					echo'<input type="submit" name="submit">';
    					echo'</form>';

    					if (isset($_GET['error']) && $_GET['error'] == "true"){
    						echo'<div class="content-warning">';
							echo'<p class="warning">You must complete all fields!</p>';
							echo'</div>';
    					}
							
					}					
				?>
		</main>
	</body>
</html>
