<?php
include 'connect.php';
include 'header.php';
$user_id=$_GET['user_id'];

$sql="UPDATE users SET del=1 WHERE user_id ='$user_id'";

$result = mysql_query( $sql ) or die(mysql_error());

//echo $result;

if($result) {
$SQLe="select * from users where user_id ='$user_id'"; 
		$rese=mysql_query($SQLe);
		$rowee=mysql_fetch_array($rese);
		$to=$rowee[user_email];
		$subject = "Account Deleted";
		$message = "Sorry User, Your Account has been deleted. Enjoy!!";
		$from = "noreply@ggf.ggf";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From:" . $from;
		mail($to,$subject,$message,$headers);
		
//mail("swankhad@cs.odu.edu","swankhad@cs.odu.edu","swankhad@cs.odu.edu","swankhad@cs.odu.edu");
header( 'Location: view_users.php' );

}


?>