<?php
session_start();
include  'LogDbInc.php';
echo '<br/><form action = "LogIndex.php" method = "POST">
						<button type 
						<button type ="submit" name ="home">Home</button>
						</form>
						';

echo '<br/><form action = "LogLogOutInc.php" method = "POST">
						
						<button type ="submit" name ="submit_out">Logout</button>
						</form>
						';

						
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<nav>
			<div class ="main_wrapper">
				<ul>
					<li>
						
						
					<br/>
					<br/>
					</li>
				</ul>
			</div>	
		</nav>	
	</header>
	<section>
		<?php
		echo "HI, client ".$_SESSION['uid']."  Welcome";

		?>
	</section>
</body>
</html>
