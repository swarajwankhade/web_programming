<?php
	
	include('connect.php');
    //include ('header.php');	
?>	

<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Gadget Gossip Forum</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="header">
		<div>
			<div id="logo">
				<a href="index.html"><img src="images/logo.png" alt="Logo"></a>
			</div>
			<ul>
				<li class="home">
					<a href="index.html"><span>Home</span></a>
				</li>
				
				<li class="about">
					<a href="about.html"><span>About</span></a>
				</li>
				<li class="blog">
					<a href="blog.html"><span>Blog</span></a>
				</li>
			</ul>
		</div>
		<div>
			<span id="background"></span>
		</div>
	</div>
	<div id="body">
		<div>
			<div>
				<div>
					<div>
						<ul>
							Login Page
							<?php
	$username=$_SESSION['username'];
	
	$sql4="select r_id, user_id FROM users WHERE user_name='$username'";
	
	$result = mysql_query($sql4);
	if(!$result)
        {
            
            echo 'No value available!';
  
        }
        else
		{
 while($row = mysql_fetch_array($result))
 {
 $r_id=$row[0];
 $user_id=$row[1];
 
 }
	}
	
	
	$sql2="select edit_time,edit_post,edit_by FROM posts WHERE post_by=$user_id ";
	$result = mysql_query($sql2);
	if(!$result)
        {
            
            echo 'No value available!';
  
        }
        else
		{
 while($row = mysql_fetch_array($result))
 {
 $edit_time=$row[0];
 $edit_post=$row[1];
 $edit_by=$row[2];
 
 }
 

	}
$sql="select pagination FROM settings";
	$result = mysql_query($sql);
	if(!$result)
        {
            
            echo 'No value available!';
  
        }
        else
		{
 while($row = mysql_fetch_array($result))
 {
 $pag=$row[0];
 }
	}
	

	$tbl_name="posts";		
	
	$adjacents = 3;
	
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	
	$targetpage = "pagination.php"; 	
	$limit = $pag; 								
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			
	else
		$start = 0;								
	
	
	$sql = "SELECT posts . * , topics.topic_id, users.user_id, users.user_name
FROM users
INNER JOIN posts ON users.user_id = posts.post_by
INNER JOIN topics ON posts.post_topic = topics.topic_id and posts.view=0 LIMIT $start, $limit";
	$result = mysql_query($sql);
	
	
	
	if ($page == 0) $page = 1;					
	$prev = $page - 1;							
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$lpm1 = $lastpage - 1;						
	
	
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\"> previous</a>";
		else
			$pagination.= "<span class=\"disabled\"> previous</span>";	
		
		
		if ($lastpage < 7 + ($adjacents * 2))	
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	
		{
			
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next </a>";
		else
			$pagination.= "<span class=\"disabled\">next </span>";
		$pagination.= "</div>\n";		
	}
?>

	<?php
	
		
    while($row = mysql_fetch_array($result))
{ 
$echoDiv = "";
$echoDiv1 = "";

if(($row['user_name']==$_SESSION['username']))
	{$echoDiv = '<form action="edit1.php" style="float:right;">
	<input type="hidden" name="post_id" value="'.$row['post_id'].'">
    <input type="submit" value="edit">
</form>';
     }
	 else if($r_id==1)
{$echoDiv = '<form action="edit1.php">
	<input type="hidden" name="post_id" value="'.$row['post_id'].'">
    <input type="submit" value="edit">
</form>';
     }
     if($edit_post!==0)
	 {
	 $echoDiv1='<div> '.$edit_by.'  '.$row['edit_time'].'</div>';
	 
	 }
	 
//$username5 = $_SESSION['username'];
//$sql5 = "select * from users where user_name='$username5'";
//$result5 = mysql_query($sql5);
//echo $result1;
//$row5 = mysql_fetch_array($result5);	
//echo "fg".$row5['images'];
//echo '<img src="'.$row5['images'].'"height=100 width=100';
//if(!$row5['images'])
$sql5 = "select * from users where user_name='".$row['user_name']."'";
$result5 = mysql_query($sql5);
$row5 = mysql_fetch_array($result5);

$user1=$row['user_name'];
echo '<div class="forumPost" style="background-color:white; margin-bottom:10px; padding-top:15px;background: #ffffff; /* Old browsers */
background: -moz-linear-gradient(top,  #ffffff 0%, #f3f3f3 50%, #ededed 51%, #ffffff 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(50%,#f3f3f3), color-stop(51%,#ededed), color-stop(100%,#ffffff)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%); /* IE10+ */
background: linear-gradient(to bottom,  #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%); /* W3C */">';
if(!$row5['images'])
{
echo '<div  style="float:left!important; width : 100px!important; margin-top:10px; padding-top:10px;">';
//echo 'no image uploaded';
echo '<img src="upload_images/default.jpg" align="left"; height=100 width=100 />';
echo '</div>';
}
else
{
echo '<div  style="float:left!important; width : 100px!important; margin-top:10px; padding-top:10px;">';
echo '<img src="'.$row5['images'].'"height=100 width=100/>';
echo '</div>';
}
echo '<div style="width : 45%; float:left;box-shadow: 10px 10px 5px #888888; border:1px solid; min-height: 48px;  padding-top:10px;"><span style="font-weight:bold">'.$row['post_content'].'<br/></span><span style="font-size:13px"><a href=profile2.php?user_id='.$row['user_id'].'> '.$user1.'</a>, '.$row['user_date'].'</span>
</div>
<div style="width:15%; float:left;  border:1px solid; box-shadow: 10px 10px 5px #888888; padding-top:10px;"><a href="insert_reply.php?post_id='.$row['post_id'].'">Reply</a><br/><a href=replies.php?post_id='.$row['post_id'].'>View Replies</a><br><a href=delete.php?post_id='.$row['post_id'].'>Delete</a> </div>' . $echoDiv . '<span>'.$echoDiv1.'</span>
</div>
';

}
?>

<?=$pagination?>

</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<div>
			<div>
				<h3>Blog</h3>
				<p>
					This website template has been designed by <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a> for you, for free. You can replace all this text with your own text. You can remove any link to our website from this website template, you&#39;re free to use this website template without linking back to us. If you&#39;re having problems editing this website template, then don&#39;t hesitate to ask for help on the <a href="http://www.freewebsitetemplates.com/forums/">Forums</a>.
				</p>
			</div>
			<div>
				<h3>Get Social</h3>
				<ul>
					<li>
						<a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" id="googleplus">Google&#43;</a>
					</li>
					<li>
						<a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" id="twitter">Twitter</a>
					</li>
					<li>
						<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" id="facebook">Facebook</a>
					</li>
				</ul>
			</div>
		</div>
		<p class="footnote">
			&copy; Copyright 2012. All rights reserved.
		</p>
	</div>
</body>
</html>
	