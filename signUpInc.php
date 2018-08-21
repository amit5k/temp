<?php
if(isset($_POST["submit"])){
	include_once 'LogDbInc.php';
	$first = mysqli_real_escape_string($conn,$_POST["fname"]) ;
    $last = mysqli_real_escape_string($conn,$_POST["lname"]) ;
    $email = mysqli_real_escape_string($conn,$_POST["email"]) ;
    $username = mysqli_real_escape_string($conn,$_POST["uid"]) ;
    $pass = mysqli_real_escape_string($conn,$_POST["pass"]) ;
    $pass_check =mysqli_real_escape_string($conn,$_POST["check"]);
 //check for empty fields
	if(empty($first)||empty($last)||empty($email)||empty($username)||empty($pass)||empty($pass_check)){
    	header("Location: admin.php?signup=empty");
	    exit();
    }else{
    	//check input characters are valid
    	 if ((!preg_match("/^[a-zA-Z ]*$/",$first)) ||(!preg_match("/^[a-zA-Z ]*$/",$last))) {
                   header("Location: admin.php?signup=invalid");
	               exit(); 
    }else{
    	//checking validity of email
    	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    		header("Location: admin.php?signup=invalid
    			_email");
	        exit();
            }else{
            	$sql="Select * from clientLogIn where uid='$username'";
            	$result=mysqli_query($conn,$sql);
            	$resultcheck=mysqli_num_rows($result);
            	if($resultcheck>0){
            		header("Location: admin.php?signup=username_taken");
	                exit();
            	}else{
            		//check password
            		if($pass!=$pass_check){
            			header("Location: admin.php?password = mis_match");
            			exit();
            		}
            		//Hashing the password
            		$hashedpass=password_hash($pass,PASSWORD_DEFAULT);
            		//insert user into database
            		$sql_insert ="insert into clientLogIn(fname,lname,email,uid,pass) values ('$first','$last','$email','$username','$hashedpass')";
            		    mysqli_query($conn,$sql_insert);
            		    header("Location: admin.php?signup=success");
            		    
	                    exit();
            	}
            }
    	 }
       }
}else {echo "please press submit button";
	header("Location: admin.php?signup=error");
	exit();}
?>