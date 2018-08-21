<?php
session_start();
include 'LogDbInc.php';
if(isset($_POST["pvsyst"]))
{
   $date = mysqli_real_escape_string($conn,$_POST["date"]) ;
   $time = strtotime($date);
    $month = date("m",$time);
    $year = date("Y",$time);
        if(empty($date))
        {
                header("Location: plants.php?dateSearch=empty" );
                exit();
        }
        else{
        	 $sql = "SELECT * FROM ".$_SESSION['id']."Estimated where date between '".$year."-".$month."-01' and '".$year."-".$month."-31' ";
        //echo $sql;
		$result = mysqli_query($conn,$sql);
		$result_check = mysqli_num_rows($result);
    	if($result_check>=1)
    	{
		$_SESSION['Date']=$date;
		$_SESSION['operation'] = "update";
        	 echo 'You are updating the value of month number : '.$month.'<br>';
	    }else{
	    	$_SESSION['Date']=$date;
	    	$_SESSION['operation'] = "insert";
        	 echo 'You are inserting the value of : '.$_SESSION['Date'].'<br>';}
        	 
             echo  '<form action = "pvsystInc.php" method = "POST">
                Estimated avg Export:
                <input type="float" name="export"><br/>
                Estimated avg Insolation:
                <input type="float" name="insolation"><br/>
                Estimated base case CUF:
                <input type="float" name="cuf"><br/>
                Estimated base case PR:
                <input type="float" name="PR"><br/>
                <button type ="submit" name ="insert">YES</button>
                </form>';
	        
        	
    }
}


else
{
header("Location: plants.php?dateSearch=empty" );
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <a href="plants.php"><b>No</b></a>
</body>
</html>