<?php
  
session_start();
$_SESSION['person']="";
$_SESSION['pid']="";
$_SESSION['id']="";
$_SESSION['uid']="";
if(isset($_POST['submit'])){
	include  'LogDbInc.php';
	$uid = mysqli_real_escape_string($conn,$_POST['uid_b']) ;
    $pass = mysqli_real_escape_string($conn,$_POST['pass_b']) ;
//error handlers
     //check for empty fields
	if(empty($uid)||empty($pass)){
    	header("Location: LogIndex.php?login=empty");
	    exit();
    }
    //$sql="Select * from user_login where uid='$username'";
    else{
    	$sql ="select * from log where username='$uid'  ";
    	$result=mysqli_query($conn,$sql);
    	$result_check = mysqli_num_rows($result);
    	if($result_check<1){
    		header("Location: LogIndex.php?login=no_user");
    		exit();
    	}else{
    		if($row = mysqli_fetch_assoc($result)){
    			//DEhashing the password
                $uidCheck=substr_count($row['username'],"@admin" ) ;

    			$passCheck =$row['pass_word'];
    			if(!($pass ==$row['pass_word']))
    			{
    				header("Location: LogIndex.php?login=error");
	                exit();
    			}
    			elseif($pass ==$row['pass_word']){
    				//log in the user
                    
                    
    				$_SESSION['pid']=$row['uid'];
                    $_SESSION['id']=$row['username'];
    				
    				$_SESSION['uid']=$row['username'];
                    /*switch ($_SESSION['uid']) {
                        case "parigi":
                            # code...

                        header("Location: plants.php?login=success");
                            break;
                        case "kothagadi":
                                # code...
                                header("Location: plants.php?login=success");
                                break;    
                        case "peerampalle":
                            # code...
                        header("Location: plants.php?login=success");
                                break;
                        case "orai":
                            # code...
                        header("Location: plants.php?login=success");
                            break;
                        default:
                            # code...
                        header("Location: admin.php?login=success");
                            break;
                    }*/

                    if($uidCheck==1){
                        $_SESSION['person'] = "admin";
                        header("Location: admin.php?login=success");
                    }
                    else{
                        $_SESSION['person'] = "client";
                        header("Location: plants.php?login=success");

                    }

    				//header("Location: LogIndex.php?login=success");

	                exit();
    			}
    		}
    	} 
    }
}
else {echo "please press submit button";
	header("Location: LogIndex.php?login=err");
	exit();
}
?>
