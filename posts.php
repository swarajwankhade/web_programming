<?php
include 'connect.php';
include 'header.php';



$sql="SELECT posts . * , topics.topic_id, users.user_id, users.user_name
FROM users
INNER JOIN posts ON users.user_id = posts.post_by
INNER JOIN topics ON posts.post_topic = topics.topic_id";
$result = mysql_query($sql);

  if(!$result)
        {
            
            echo 'No posts available!';
  
        }
        else
		{
 while($row = mysql_fetch_array($result))
 {


echo '<div class="forumPost">
<div style="width : 55%; float:left; border:1px solid"><span style="font-weight:bold">'.$row['post_content'].'<br/></span><span style="font-size:13px">Started by '.$row['user_name'].', '.$row['user_date'].'</span>
</div>
 <div style="width:15%; float:left; border:1px solid"><a href="insert_reply.php?post_id='.$row['post_id'].'">Reply</a><br/><a href=replies.php?post_id='.$row['post_id'].'>View Replies</a></div></div>';
}
}
      
?>