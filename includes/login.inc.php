 <?php 

if(isset($_POST['submit'])){

	include 'dbh.inc.php';
	$uid = mysqli_real_escape_string($conn,  $_POST['uid'] );
	$pwd = mysqli_real_escape_string($conn,  $_POST['pwd'] );
	if(empty($uid) || empty($pwd)){
		header("Location: ../1.php?login=error");
		exit(); 

	}else{
		$sql = "select * from users where user_uid = '$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck < 1){
			header("Location: ../1.php?login=error");
	  		exit(); 

		}else{
			if($row = mysqli_fetch_assoc($result)){
				 $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
				 if($hashedPwdCheck == false){
 					header("Location: ../1.php?login=error");
	  		 		exit();

				 }
			}
		}
	}






}else{
	header("Location: ../1.php?login=error");
	exit(); 
}












