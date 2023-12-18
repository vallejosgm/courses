<?php 
	class Robot
	{
		private $model;
		private $color;
		private $os;
		private $size;
		
		public function __toString()
		{
			$col = strtolower($this->getColor());
			$siz = strtolower($this->getSize());
			return "<main><div class='message'>Your ".$col." {$this->getModel()} robot running {$this->getOS()} of ".$siz." size, will be built shortly. Thank you.</div></main>";
		}
		public function __construct($m, $c, $o, $s)
		{
			$this->setModel($m);
			$this->setColor($c);
			$this->setOs($o);
			$this->setSize($s);
		}
		public function setModel($m){$this->model = $m;}
		public function setColor($c){$this->color = $c;}
		public function setOS($o){$this->os = $o;}
		public function setSize($s){$this->size = $s;}
		
		public function getModel() {return $this->model;}
		public function getColor() {return $this->color;}
		public function getOS() {return $this->os;}
		public function getSize() {return $this->size;}
	}

	$numOfModels = 10;
	$models = ["Sonny", "Rosey", "SICO", "Data", "Gort", "Wall-E", "Optimus Prime", "Hal 9000", "Twiki", "Johnny 5"];
	$numOfColors = 5;
	$colors = ["Shiny", "Chrome", "Silver", "Brass", "Gold"];
	$numOfOs = 6;
	$os = ["Linux", "Unix", "SPARC", "Binary", "DOS", "Tiny Hamsters"];
	$numOfSize = 3;
	$sizes = ["Giant", "Normal", "Nano"]
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Robots</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link type="text/css" rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<?php 
			if(!empty($_POST['models']) && !empty($_POST['colors']) && !empty($_POST['os']) && !empty($_POST['size_robot']))
			{
				$robot = new Robot($_POST['models'], $_POST['colors'], $_POST['os'],  $_POST['size_robot']);
				echo $robot;

				echo "<pre>";
				var_dump($robot);
				echo "</pre>";
			}
			else 
			{
		?>
			<main>
				<form action="index.php" method="post">	
					<div class="dropdown">
						<div class="custom-select">
							<select name="models">
							<option value="" disabled selected hidden>Robot Models</option>
							<?php
								for ($x = 0; $x <$numOfModels; $x++)
									echo '<option value="'.$models[$x].'">'.$models[$x].'</option>';
							?>
							</select>
						</div>
						<div class="custom-select">
							<select name="colors">
								<option value="" disabled selected hidden>Robot Colors</option>
								<?php
									for ($x = 0; $x <$numOfColors; $x++)
										echo '<option value="'.$colors[$x].'">'.$colors[$x].'</option>';
								?>
							</select>
						</div>
						<div class="custom-select">
							<select name="os">
								<option value="" disabled selected hidden>Operating Systems</option>
								<?php
									for ($x = 0; $x <$numOfOs; $x++)
										echo '<option value="'.$os[$x].'">'.$os[$x].'</option>';
								?>
							</select>
						</div>
					</div>
					<div class="size_robot">
						<?php
							for ($x = 0; $x <$numOfSize; $x++){
								echo '<input class="button_size" type="radio" id="'.$sizes[$x].'" name="size_robot" value="'.$sizes[$x].'">';
								echo '<label class="label_size" for="'.$sizes[$x].'">'.$sizes[$x].'</label><br>';
							}
						?>
					</div>
						
					<input type="submit" value="Build Robot">
				</form>
			</main>	
		<?php
			}
		?>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>