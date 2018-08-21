<?php
session_start();
 include  'LogDbInc.php';
 
 ?>
 <div class ="main_wrapper">

	 <ul>
		<li>
			<!--
			<a href="parigi.php?id=parigi" >parigi</a>
			<a href="kothagadi.php">kothagadi</a>
			<a href="peerampalle.php">peerampalle</a>
			<a href="orai.php">orai</a>-->
			<form action="plants.php" method="POST">
               <select name="plant" id="plant">
				  <?php 
  					$sql = mysqli_query($conn,"select plant from info");
 					while($row = mysqli_fetch_assoc($sql)){
 					$option = "<option value = ".$row['plant'].">".$row['plant']."</option>";
 					echo $option ;
                   }
				   
				  ?>
				</select>
				<button type="submit" >GO
				</button>
				<!--<input type="submit" name="plant" value="parigi">
				<input type="submit" name="plant" value="kothagadi">
				
				<input type="submit" name="plant" value ="peerampalle">
				<input type="submit" name="plant" value="orai">-->
			</form>

		</li>
	</ul>
</div>
<?php
 include 'home.php';
?>



	<section>
		
		<div class ="main-wrapper">
			<h2>SignUp</h2>
			<form  action="signUpInc.php" method="POST">
				<input type="text" name="fname" placeholder="Firstname">
				<input type="text" name="lname" placeholder="Lastname">
				<input type="text" name="email" placeholder="E-mail">
				<input type="text" name="uid" placeholder="Username">
				<input type="password" name="pass" placeholder="Password">
				<input type ="text" name= "check" placeholder="Retype Password">
				<button type ="submit" name="submit">Sign Up
				</button>
			</form>
		</div>
		<div class ="main-wrapper">
			<h2><br>Plant Addition</h2>
			<form  action="addPlant.php" method="POST">Plant Name:
				<input type="text" name="plant" placeholder="plant name"><br>
				DC Capacity:
				<input type="float" name="DCcapacity" placeholder="DC capacity"><br>
       			AC Capacity:
				<input type="float" name="ACcapacity" placeholder="AC capacity"><br>
				Number Of Inverters:
				<input type="int" name="inverters" placeholder="Inverter"><br>
				Number Of SCB:
				<input type="int" name="SCB" placeholder="SCB"><br>
				Number Of Strings:
				<input type ="int" name= "strings" placeholder="strings"><br>
				Client User id: 
				<input type ="text" name= "uid" placeholder="Uid"><br>

				<button type ="submit" name="submit">Insert
				</button>
			</form>
			
		</div>	
	</section>
	
<?php
include 'footer.php';
?>
