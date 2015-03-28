<?php
include 'connect.php';
include 'header.php';
$post_id=$_GET['post_id'];

$sql="UPDATE posts SET view=1 WHERE post_id =".$post_id;
echo $sql;

$result = mysql_query( $sql ) or die(mysql_error());

echo $result;

if($result) {
header( 'Location: pagination.php' );
}


?>