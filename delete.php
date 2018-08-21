<?php 
session_start();
include 'LogDbInc.php';
if(isset($_POST["del"]))
{
	$date = mysqli_real_escape_string($conn,$_POST["delete"]) ;
	if(empty($date))
	{
		header("Location: plants.php?dateDelete=empty" );
		exit();
	}
	else
	{
		$sql = " select * from ".$_SESSION['id']." where dat ='$date'";
		
		$result = mysqli_query($conn,$sql);
		$result_check = mysqli_num_rows($result);
    	if($result_check<1){
    	header("Location: plants.php?deleteDate=no_date_found");
    	exit();
    	}
    		else
    		{
    			$sql = " delete from ".$_SESSION['id']." where dat ='$date'";
		         mysqli_query($conn,$sql);
		         $sqlMtd = " delete from ".$_SESSION['id']."MTD where dat ='$date'";
		         mysqli_query($conn,$sqlMtd);
		        header("Location: plants.php?dateDelete=Success" );
		        exit();
    		}		
	}
}else
    {
       header("Location: plants.php?dateDelete=empty" );
	    exit();
	} 
?>