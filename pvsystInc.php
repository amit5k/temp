<?php
session_start();
include 'LogDbInc.php';
    $date = mysqli_real_escape_string($conn,$_SESSION['Date']) ;
    $export = mysqli_real_escape_string($conn,$_POST["export"]) ;
    $insolation = mysqli_real_escape_string($conn,$_POST["insolation"]) ;
    $CUF = mysqli_real_escape_string($conn,$_POST["cuf"]) ;
    $PR = mysqli_real_escape_string($conn,$_POST["PR"]) ;
    $time = strtotime($date);
    $month = date("m",$time);
    $year = date("Y",$time);
    
   

    if(isset($_POST['insert'])){
    	if($_SESSION['operation']=="insert"){
    		$insert_mtd = "insert into ".$_SESSION['id']."Estimated (date,export,insolation,baseCUF,basePR) values ('$date','$export','$insolation','$CUF','$PR')";                
            //echo $insert_mtd;
            mysqli_query($conn,$insert_mtd);
    	} else {
    		$update_mtd = "update ".$_SESSION['id']."Estimated  set date = '$date',export = '$export' ,insolation = '$insolation' ,baseCUF = '$CUF',basePR = '$PR' where date between '".$year."-".$month."-01' and '".$year."-".$month."-31' ";              
            //echo $insert_mtd;
            mysqli_query($conn,$update_mtd);
    	}
    	
    }
    header("Location: plants.php?insertData=success");                    
    exit();
?>

