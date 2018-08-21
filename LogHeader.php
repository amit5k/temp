<?php

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<header>
		<nav>
			<div class ="main_wrapper">
				<ul>
					<li>
						
					</li>
				</ul>
				<div class = "nav-login">
				<a href="LogIndex.php"> HOME</a>
					
				</div>
			</div>
			
		</nav>
	</header>
	<section>
		<?php
		session_start();

					if(isset($_SESSION['uid']))
					{
						echo "<br><a href = LogLogOutInc.php>Log Out</a><br>";
					}
					else{
						echo 'Admin_Login<br/><form action="LogLogInc.php" method="POST" >
						<input type="text" name="uid_b" placeholder="Username"  >
						<input type="password" name="pass_b" placeholder="Password"
						>
						<input type="checkbox" name ="check" id="remember_me">Remember Me
						<button type="submit" name= "submit">
							Login
							
						</button>
					</form>';

					echo '<br/>Client Login<br/><form action="clientLogInc.php" method="POST" >
						<input type="text" name="uid" placeholder="Username"  >
						<input type="password" name="pass" placeholder="Password"
						>
						<input type="checkbox" name ="checkbox" id="remember_me">Remember Me
						<button type="submit" name= "submit">
							Login
							
						</button>
					</form><br/>';
					}

					 
					
                    
						
				    
				
                      
					?>
					
</section>
