<?php
include 'connect.php';
include 'header.php';
$user_id=$_GET['user_id'];

$sql="UPDATE users SET pe_user=0 WHERE user_id =".$user_id;
echo $sql;

$result = mysql_query( $sql ) or die(mysql_error());
if($result) {
$SQLe="select * from users where user_id ='$user_id'"; 
		$rese=mysql_query($SQLe);
		$rowee=mysql_fetch_array($rese);
		$to=$rowee[user_email];
		$subject = "Account unsuspended";
		$message = "Hello User, Your Account has been unsuspended. Enjoy!!";
		$from = "noreply@ggf.ggf";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From:" . $from;
		mail($to,$subject,$message,$headers);
		}

echo $result;

if($result) {

header( 'Location: view_users.php' );

}


?>