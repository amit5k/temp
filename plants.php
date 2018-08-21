<?php
session_start();
include 'home.php';
if (isset($_POST["plant"])){
	$id=$_POST["plant"];
$_SESSION['id'] = $id;

}

?>
	<section>
		<div class ="main-wrapper">
			<h2>Plant <?php echo $_SESSION['id'] ?></h2><br/>
			<form  action="update.php" method="POST">
				Insert By Date :
				<input type="date" name="date" placeholder="YYYY-MM-DD" align="right"><br/>
				
				<button type ="submit" name="insert">Insert
				</button>
			</form>
			<form action="update.php" method="POST">
				Update By Date :
				<input type="date" name="date" placeholder="YYYY-MM-DD" align="right"><br/>
				<button type ="submit" name ="update">Update</button><br/>
			</form>

			<form action="search.php" method="POST">
				Search By Date :
				<input type="date" name="date" placeholder="YYYY-MM-DD" align="right"><br/>
				<button type ="submit" name ="search">Search</button><br/>
			</form>
			<form action="delete.php" method="POST">
				Delete By Date :
				<input type="date" name="delete" placeholder="YYYY-MM-DD" align="right"><br/>
				<button type ="submit" name ="del">Delete</button><br/>
			</form>
			<form action="pvsyst.php" method="POST">
				 Pvsyst data :
				<input type="date" name="date" placeholder="YYYY-MM-DD" align="right"><br/>
				<button type ="submit" name ="pvsyst">Insert</button><br/>
			</form>
		</div>	
	</section>
</body>
</html>
