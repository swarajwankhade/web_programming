<?php
include 'connect.php';
include 'header.php';

$cat_id=$_POST['hidden'];

$topic_subject=$_POST['topic_subject'];
$username =$_SESSION['username'];


$sql="SELECT DISTINCT user_id FROM users WHERE user_name='$username'";
$result = mysql_query($sql);

  if(!$result)
        {
            
            echo 'No posts available!';
  
        }
        else
		{
 while($row = mysql_fetch_array($result))
 {
 $user_id = $row[0];
 }
}


 
$today = date("Y-m-d H:i:s");
$sql ="INSERT INTO topics (topic_subject,topic_date,topic_cat,topic_by) VALUES ('$topic_subject','$today',$cat_id,$user_id)";


mysql_query( $sql ) OR die(mysql_error());

$temp = '<a href=topics.php?cat_id='. $cat_id .'>HERE!</a>';

echo "You can view all topics in this category".$temp;



?>