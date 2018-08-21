<?php
session_start();
include 'LogDbInc.php';

$sql = "SELECT * FROM info WHERE plant = '".$_SESSION['id']."'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

    $date = mysqli_real_escape_string($conn,$_SESSION['Date']) ;
    $DCcapacity = $row['DCcapacity'] ;
    $ACcapacity = $row['ACcapacity'] ;
    $noInverter = $row['inverters'] ;
    $noSCB = $row['SCB'] ;
    $noStr = $row['strings'] ;
    //echo $noStr."<br>".$noSCB."<br>".$noInverter."<br>".$DCcapacity."<br>".$ACcapacity;

    $export = mysqli_real_escape_string($conn,$_POST["dayExport"]) ;
    $insolation = mysqli_real_escape_string($conn,$_POST["dayInsolation"]) ;
    $sunRise = mysqli_real_escape_string($conn,$_POST["rise"]) ;
    $sunSet = mysqli_real_escape_string($conn,$_POST["set"]) ;
    $temp = mysqli_real_escape_string($conn,$_POST["moduleTemp"]);
    $bdInverter =mysqli_real_escape_string($conn,$_POST["bdInverter"]);
    $bdGrid =mysqli_real_escape_string($conn,$_POST["bdGrid"]);
    $bdSCB =mysqli_real_escape_string($conn,$_POST["bdSCB"]);
    $bdStr =mysqli_real_escape_string($conn,$_POST["bdStr"]);
    $corr =mysqli_real_escape_string($conn,$_POST["corr"]);
    $comment =mysqli_real_escape_string($conn,$_POST["comments"]);

    $time = strtotime($date);
    $day = date("d",$time);
    $month = date("m",$time);
    $year = date("Y",$time);
    //echo $month." ".$year;
    //functions
    function decimalHours($time)
{
    $hms = explode(":", $time);
    return ($hms[0]+($hms[1]/60)   );
}

//functions for MTD
//function summation($month,$year,$date,$export){
    

  //  return $exportMTD;}
 //$exportMTD = "select sum(dayExport),sum(dayInsolation),avg(dcCUF),avg(acCUF),avg(moduleTemp),avg(gridAvail),avg(plantAvail),avg(generationAvail),avg(PR),sum(corrInsolation),avg(gridCorrectedPR) from orai where dat between '$year-$month-01'and '$date'" ;
   // $exportMTD+=$export;
//echo $exportMTD;

  //$result = mysqli_fetch_assoc( mysqli_query($conn,$exportMTD));
/*echo $result['sum(dayExport)']."<br>";
echo $result['sum(dayInsolation)']."<br>";
echo $result['avg(dcCUF)']."<br>";
echo $result['avg(acCUF)']."<br>";*/





  //formulas
 $sunAva= decimalHours($sunSet)-decimalHours($sunRise);
 //echo $sunAva."<br>";
 $IA = 1-(decimalHours($bdInverter)/($noInverter*$sunAva));
 $ScbA = 1- (decimalHours($bdSCB)/($noSCB*$sunAva));
 $strA = 1-(decimalHours($bdStr)/($noStr*$sunAva));
 $gridA = 100*(1-(decimalHours($bdGrid)/$sunAva));
 $plantA =100*( 1-((1-$IA)+(1-$ScbA)+(1-$strA)));
 $GenerationA = 100*(1-(1-($plantA/100)+1-($gridA/100)));
 $DC_CUF = 100*($export/(24*$DCcapacity));
 $AC_CUF =100*( $export/(24*$ACcapacity));
 $PR = 100*($export/($insolation*$DCcapacity));
 $gridCorrectedPR = 100*($export/($corr*$DCcapacity)); 


 /*   
$date = strtotime("+1 day", strtotime("$date"));
$date = date("Y-m-d", $date);
echo $date;*/


    //update


   if($_SESSION['operation']=="update"){
        $sql_update ="update ".$_SESSION['id']."
                        set dat = '$date', sunAvail = '$sunAva',dayExport ='$export',dayInsolation =' $insolation', dcCUF='$DC_CUF',acCUF = '$AC_CUF',moduleTemp = '$temp',gridAvail ='$gridA', plantAvail='$plantA',generationAvail='$GenerationA',PR='$PR',
                        corrInsolation='$corr',gridCorrectedPR = '$gridCorrectedPR', comments ='$comment'
                             where dat = '$date'";
            mysqli_query($conn,$sql_update);
     do{
        $exportMTD = "select sum(dayExport),sum(dayInsolation),avg(dcCUF),avg(acCUF),avg(moduleTemp),avg(gridAvail),avg(plantAvail),avg(generationAvail),avg(PR),sum(corrInsolation),avg(gridCorrectedPR) from ".$_SESSION['id']." where dat between '$year-$month-01'and '$date'" ;

        echo $exportMTD;
       $result = mysqli_fetch_assoc( mysqli_query($conn,$exportMTD));
        $a = $result['sum(dayExport)'];
        $b = $result['sum(dayInsolation)'];
        $c = $result['avg(moduleTemp)'];
        $d = $result['avg(dcCUF)'];
        $e = $result['avg(acCUF)'];
        $f = 100*($a/($b*$DCcapacity));
        $g = $result['sum(corrInsolation)'];
        $h = 100*($a/($g*$DCcapacity));
        $i = $result['avg(plantAvail)'];
        $j = $result['avg(gridAvail)'];
        $k = $result['avg(generationAvail)'];

        $mtdUpdate = "update".$_SESSION['id']."MTD set dat = '$date', export = '$a' , insolation = '$b',temp ='$c',dcCUF = '$d',acCUF = '$e' ,PR = '$f', corrInsolation = '$g', gridCorrectedPR = '$h',plantAvail='$i',gridAvail = '$j', generationAvail = '$k' where dat = '$date'";
         mysqli_query($conn,$mtdUpdate);
         $dat = strtotime("+1 day", strtotime("$date"));
         $date = date("Y-m-d", $dat);
         $mon = date("m",$dat);
         $sql = " select * from ".$_SESSION['id']." where dat ='$date'";
                $resultchk = mysqli_query($conn,$sql);
                $result_check = mysqli_num_rows($result);
        if($mon!=$month){
              break;
        }        
         
     }while($result_check>=1);

          header("Location: plants.php?updateData=success");
           exit();

    }

    //insert
    else{
        //insert data into database
                    $sql_insert ="insert into ".$_SESSION['id']."(dat,sunAvail,dayExport,dayInsolation,dcCUF,acCUF,moduleTemp,gridAvail,plantAvail,generationAvail,PR,corrInsolation,gridCorrectedPR,comments) values ('$date','$sunAva','$export','$insolation','$DC_CUF','$AC_CUF','$temp','$gridA','$plantA','$GenerationA','$PR','$corr','$gridCorrectedPR','$comment')";
                        mysqli_query($conn,$sql_insert);

        //insert data in mtd

        $exportMTD = "select sum(dayExport),sum(dayInsolation),avg(dcCUF),avg(acCUF),avg(moduleTemp),avg(gridAvail),avg(plantAvail),avg(generationAvail),avg(PR),sum(corrInsolation),avg(gridCorrectedPR) from ".$_SESSION['id']." where dat between '$year-$month-01'and '$date'" ;
   // $exportMTD+=$export;
//echo $exportMTD;
       $result = mysqli_fetch_assoc( mysqli_query($conn,$exportMTD));
        $a = $result['sum(dayExport)'];
        $b = $result['sum(dayInsolation)'];
        $c = $result['avg(moduleTemp)'];
        $d = $result['avg(dcCUF)'];
        $e = $result['avg(acCUF)'];
        $f = 100*($a/($b*$DCcapacity));
        $g = $result['sum(corrInsolation)'];
        $h = 100*($a/($g*$DCcapacity));
        $i = $result['avg(plantAvail)'];
        $j = $result['avg(gridAvail)'];
        $k = $result['avg(generationAvail)'];
 
  

        $insert_mtd = "insert into ".$_SESSION['id']."MTD (dat,export,insolation,temp,dcCUF,acCUF,PR,corrInsolation,gridCorrectedPR,plantAvail,gridAvail,generationAvail) values ('$date','$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k')";                
            //echo $insert_mtd;

            mysqli_query($conn,$insert_mtd);            



                        header("Location: plants.php?insertData=success");
                        
                        exit();
    }
    
?>
