<?php
include 'connect.php';
include 'header.php';
$username=$_SESSION['username'];



echo "$result";


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

$sql="SELECT topic_id FROM topics";
$result = mysql_query($sql);

  if(!$result)
        {
            
            echo 'No topics';
  
        }
        else
		{
 while($row = mysql_fetch_array($result))
 {
 
 $topic_id=$row[0];
 
 }
 }

 
 
 
 
 
$post_content= addslashes($_POST['post_content']);
$topic_post= addslashes($_POST['topic_post']);
$today = date("Y-m-d H:i:s");

$sql ="INSERT INTO posts (post_content,post_by,post_topic,post_date) VALUES ('$post_content',$user_id,$topic_id,'$today')";


mysql_query( $sql ) OR die(mysql_error());

  
        
 echo 'Successfully Posted. You view all post <a href="pagination.php">Here!</a> Also insert a topic <a href="insert_topic.php">Here!</a> ';    

?>