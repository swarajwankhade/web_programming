<?php
include 'connect.php';
//include 'header.php';
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
							
							<?php
$uid=$_GET['user_id'];
//echo $user_id;
//echo 'Welcome, ' . $_SESSION['username']; 
//$username1 = $_SESSION['username'];
$sql5 = "select * from users where user_id='$uid'";
$result5 = mysql_query($sql5);
//echo $result5;
$row5 = mysql_fetch_array($result5);
$username1 = $_row5['username'];	
echo $username1;
echo 'Welcome, ' .$username1;
//echo '</br>';
//echo "fg".$row5['images'];
echo '<img src="'.$row5['images'].'"height=100 width=100';
echo'</br>';
//$sql1 = "select user_id from users where user_name='$username1'";
$result1 = mysql_query($sql1);
//echo $result1;
//$row1 = mysql_fetch_array($result1);
//echo $username1;
//echo $row1['user_id'];
//$uid = $row1['user_id'];
//echo $uid;
$sql3="SELECT post_date FROM posts
	  WHERE post_id=(select max(post_id) from posts where post_by=$uid)"; 
	  
$result6 = mysql_query( $sql3 ) or die(mysql_error());
//echo $sql3; 

$sql="SELECT count(post_content) as abc , post_date
FROM posts
WHERE posts.post_by=$uid";


		 

//echo $sql;
$result = mysql_query( $sql ) or die(mysql_error());

$sql2="SELECT count(reply_content) as xyz , reply_date 
FROM replies
WHERE replies.user_id='$uid'";

$result2 = mysql_query( $sql2 ) or die(mysql_error());

//$result =mysql_query($sql);
if(!$result)
{
	echo 'You do not have any post';
}
else 
{
	/*echo '<table >';
	echo  '<tr style="border: 1px solid black; border-collapse: collapse;
			border-spacing: 0; padding: 0; ">';
	echo  '<td width="15%" align="center">POSTS</td>';
	echo  '<td width="45%" align="center">DATE</td>';
	echo  '</tr>';*/
	
	while(($row = mysql_fetch_array($result)))
	{
	  /*echo'<tr style="border: 1px solid black;border-collapse: collapse;
    border-spacing: 0; padding: 0;">';*/
	echo'</br>';
	echo 'Your Total number of posts is:';
    echo $row['abc'];
	//echo $uid;
	echo '<a href="userposts2.php?user_id='.$uid.'">View Posts</a>';
	//echo '$row['post_date'];
	}
}
if(!$result2)
{
	echo 'You do not have any replies';
}
else 
{
	/*echo '<table >';
	echo  '<tr style="border: 1px solid black; border-collapse: collapse;
			border-spacing: 0; padding: 0; ">';
	echo  '<td width="15%" align="center">POSTS</td>';
	echo  '<td width="45%" align="center">DATE</td>';
	echo  '</tr>';*/
	
	while(($row5 = mysql_fetch_array($result2)))
	{
	  /*echo'<tr style="border: 1px solid black;border-collapse: collapse;
    border-spacing: 0; padding: 0;">';*/
	echo'</br>';
	echo 'Your Total number of replies is:';
    echo $row5['xyz'];
	//echo '$row['post_date'];
	}
}
if(!$result6)
{
	echo 'You do not have any any latest post date';
}
else 
{
while(($row9 = mysql_fetch_array($result6)))
	{
	  /*echo'<tr style="border: 1px solid black;border-collapse: collapse;
    border-spacing: 0; padding: 0;">';*/
	echo'</br>';
	echo 'Your Last Post was dated:';
    echo $row9['post_date'];
	//echo '$row['post_date'];
	}
	}
	
	
?>







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