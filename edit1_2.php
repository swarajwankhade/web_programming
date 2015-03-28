<?php
include 'connect.php';
include 'header.php';
$today = date("Y-m-d H:i:s");
$user_name=$_SESSION['username'];
$post_content=$_POST['post_content'];
$post_id=$_POST['hidden'];

$sql="UPDATE posts
SET post_content='$post_content', edit_post=1, edit_time='$today', edit_by='$user_name'
WHERE post_id=$post_id";
echo $sql;

$result = mysql_query( $sql ) or die(mysql_error());

if($result) 
header( 'Location: pagination.php' );


?>
