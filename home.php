<?php


 include  'LogDbInc.php';
 
 if(isset($_SESSION['pid']))
					{
						echo  "<br><a href = LogLogOutInc.php>Log Out</a><br>";
					}
					if($_SESSION['person']=="admin"){
						echo "<br><a href = admin.php>HOME</a><br>";
					}else{
						echo "<br><a href = plants.php>HOME</a><br>";
					}
					
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
