<?php 
include_once 'LogHeader.php';
?>
	<section>
		<div class ="main-wrapper">
			<h2>Home</h2>

			<?php
			if(isset($_SESSION['pid'])) 
				{
					echo "your primary id is:".$_SESSION['pid']." ";
			       echo $_SESSION['uid'];
			      

		};
			 ?>
		</div>	
		
		
	</section>
<?php 
include_once 'footer.php';
?>