<?php 


if (isset($_POST['submit'])){

   include_once 'dbh.inc.php';
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $uid = mysqli_real_escape_string($conn, $_POST['uid']);
   $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
   if(empty($name) || empty($email) || empty($uid) || empty($pwd)){
   	header("Location: ../1.php?signup = empty");
   	exit(); 



 

   }else{
   	if(!preg_match("/^[a-zA-Z]*$/ ", $name )){
   	header("Location: ../1.php?signup = invalid");
   	exit(); 


   	}else{
   		 if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
   		 	header("Location: ../1.php?signup = invalid_email ");
   	        exit(); 
   		 }else{
   		 	$sql = "select * from users where user_uid = '$uid'";
   		 	$result = mysqli_query($conn, $sql);
   		 	$resultCheck = mysqli_num_rows($result);  

   		 	if($resultCheck > 0 ){
   		 		header("Location: ../1.php?signup = users_repeated");
   	            exit();

   		 	}else{
   		 		 $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
   		 		 $sql =  "insert into users(user_name, user_email, user_uid, user_pwd) values('$name','$email','$uid','$hashedPwd ');"; 
   		 		 mysqli_query($conn, $sql); 
   		 		 header("Location: ../1.php?signup = success ");
   	             exit();
   		 	}
   		 }





   	}






   }



 
 
}else{
header("Location: ../ 1.php");
exit();
 


}




