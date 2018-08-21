<?php 
session_start();
include 'LogDbInc.php';
if(isset($_POST["update"])||isset($_POST["insert"]))
{
        $date = mysqli_real_escape_string($conn,$_POST["date"]) ;
        if(empty($date))
        {
                header("Location: plants.php?dateSearch=empty" );
                exit();
        }
        else
        { 
                $sql = " select * from ".$_SESSION['id']." where dat ='$date'";
                $result = mysqli_query($conn,$sql);
                $result_check = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
                $_SESSION['Date']=$date;
            if(isset($_POST["insert"]))
            {
                if($result_check<1)
                {
                    
                    $_SESSION['operation']="insert";
                 echo 'You are inserting the value of : '.$_SESSION['Date'].'<br>';
                

                }else
                {
                  
                    $_SESSION['operation']="update";
                    echo 'you are trying to overwrite the value of date : '.$_SESSION['Date'].'<br>';
                }                  
            }

            else
            {
                $_SESSION['operation']="update";
                if($result_check<1)
                    {
                    header("Location: plants.php?searchDate=no_date_found");
                    exit();

                    } else
                    {
                           
                         echo 'You are updating the value of : '.$_SESSION['Date'].'<br>';                  
                    }               
            }
             echo '<form action = "updateInc.php" method = "POST">
                        
                            Today Actual Export : 
                            <input type="int" name="dayExport" v ><br/>
                            Today Actual Insolation :
                            <input type="float" name="dayInsolation"><br/>
                            Sun Rise :
                            <input type="time" name="rise" ><br/>
                            Sun Set : 
                            <input type="time" name="set" ><br/>
                            Module Temperature :
                            <input type ="float" name= "moduleTemp" ><br/>
                            Inverter Breakdown Time :
                            <input type ="string" name= "bdInverter"  placeholder="hhh:mm" value="00:00"><br/>
                            Grid Breakdown Time :
                            <input type ="string" name= "bdGrid" placeholder="hhh:mm" value="00:00" ><br/>
                            SCB Breakdown Time :
                            <input type ="string" name= "bdSCB" placeholder="hhh:mm" value="00:00"><br/>
                            string Breakdown Time :
                            <input type ="string" name= "bdStr" placeholder="hhh:mm" value="00:00"><br/>
                            Grid corrected Insolation :
                            <input type ="float" name= "corr"><br/>
                            Comments : 
                            <textarea name="comments" rows="8" cols="50"></textarea> <br/>        
                            <button type ="submit" name ="admin">YES</button>
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