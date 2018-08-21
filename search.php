<?php 
session_start();
include 'LogDbInc.php';
if(isset($_POST["search"]))
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
	else
	{
		$sql = "SELECT * FROM ".$_SESSION['id']."  INNER JOIN ".$_SESSION['id']."Estimated on (".$_SESSION['id']."Estimated.date between '".$year."-".$month."-01' and '".$year."-".$month."-31') and ".$_SESSION['id'].".dat = '$date'";
       // echo $sql;
		$result = mysqli_query($conn,$sql);
		$result_check = mysqli_num_rows($result);
    	if($result_check<1)
    	{
    		header("Location: plants.php?searchDate=no_date_found");
    		exit();
    	}
    	else
    	{
    		$res = array();
            while($row = mysqli_fetch_assoc($result))
                {
                   $res[] = $row;
                }
		    foreach ($res as $row) 
                { 
                    foreach ($row as $element)
                          {
                              echo $element."<br>";
                           }
                }
            /*if ($row = mysqli_fetch_assoc($result)) {
                    # code...
                $sunRise= $row['sunRise'];
            echo $sunRise."<br>";
            function decimalHours($time)
{
    $time = explode(":", $time);
    return ($time[0]+($time[1]/60) +$time[2]/3600  );
}

            $decimalHours = decimalHours($sunRise);


echo $decimalHours;
                } 
            
            
            $decimalHours = decimalHours($sunRise);

function decimalHours($time)
{
    $hms = explode(":", $time);
    return ($sunRise[0] + ($sunRise[1]/60) );
}

echo $decimalHours;*/
    	}
	}
}
else
{
    header("Location: plants.php?dateSearch=empty" );
	exit();
} 
?>
