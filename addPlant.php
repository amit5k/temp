<?php
session_start();
include 'LogDbInc.php';
 $plant = mysqli_real_escape_string($conn,$_POST["plant"]) ;
 $DCcapacity = mysqli_real_escape_string($conn,$_POST["DCcapacity"]) ;
 $ACcapacity = mysqli_real_escape_string($conn,$_POST["ACcapacity"]) ;
 $inverters = mysqli_real_escape_string($conn,$_POST["inverters"]) ;
 $SCB = mysqli_real_escape_string($conn,$_POST["SCB"]) ;
 $strings = mysqli_real_escape_string($conn,$_POST["strings"]) ;
 $uid = mysqli_real_escape_string($conn,$_POST["uid"]) ;
 
 if(isset($_POST['submit'])){

    $check = mysqli_query($conn,"select * from info where plant = '".$plant."'");
    $result = mysqli_num_rows($check);
    echo $result;
    if($result<1)
    {
    	$sql = "insert into info (plant,DCcapacity,ACcapacity,inverters,SCB,strings,client) values ('$plant','$DCcapacity','$ACcapacity','$inverters','$SCB','$strings','$uid')";
 	
 	$tabPlant = "CREATE TABLE ".$plant." ( `pid` INT(11) NOT NULL AUTO_INCREMENT, `dat` DATE NOT NULL , `sunAvail` FLOAT NOT NULL , `dayExport` FLOAT NOT NULL , `dayInsolation` FLOAT NOT NULL , `dcCUF` FLOAT NOT NULL , `acCUF` FLOAT NOT NULL , `moduleTemp` FLOAT NOT NULL , `gridAvail` FLOAT NOT NULL , `plantAvail` FLOAT NOT NULL , `generationAvail` FLOAT NOT NULL , `PR` FLOAT NOT NULL , `corrInsolation` FLOAT NOT NULL , `gridCorrectedPR` FLOAT NOT NULL , `comments` VARCHAR(2000) NOT NULL , PRIMARY KEY (`pid`), UNIQUE (`dat`))";
 	
 	$tabMTD = "CREATE TABLE ".$plant."MTD ( `uid` INT(11) NOT NULL AUTO_INCREMENT, `dat` DATE NOT NULL , `export` FLOAT NOT NULL , `insolation` FLOAT NOT NULL , `temp` FLOAT NOT NULL , `dcCUF` FLOAT NOT NULL , `acCUF` FLOAT NOT NULL , `PR` FLOAT NOT NULL , `corrInsolation` FLOAT NOT NULL , `gridCorrectedPR` FLOAT NOT NULL , `plantAvail` FLOAT NOT NULL , `gridAvail` FLOAT NOT NULL , `generationAvail` FLOAT NOT NULL , PRIMARY KEY (`uid`), UNIQUE (`dat`))";
 	$tabEstimated = "CREATE TABLE ".$plant."Estimated ( `date` DATE NOT NULL , `export` FLOAT NOT NULL , `insolation` FLOAT NOT NULL , `baseCUF` FLOAT NOT NULL , `basePR` FLOAT NOT NULL , PRIMARY KEY (`date`))";
 	mysqli_query($conn,$sql);
 	mysqli_query($conn,$tabPlant);
 	mysqli_query($conn,$tabMTD);
 	mysqli_query($conn,$tabEstimated);
 	header("Location: admin.php?insert = success");
    		exit();

    }else{
    	$update = "update info set DCcapacity = '$DCcapacity', ACcapacity = '$ACcapacity', inverters = '$inverters' , SCB = '$SCB', strings = '$strings' , client ='$uid' where plant = '$plant' ";
    	mysqli_query($conn,$update);
    	header("Location: admin.php?update = success");
    		exit();
    }



 	
 	//echo $tabEstimated;
 }
 else {
 	header("Location: admin.php?insert = errror");
    		exit();
 }
 
?>
