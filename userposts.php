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
$username1 = $_SESSION['username'];
$sql1 = "select user_id from users where user_name='$username1'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_array($result1);
$uid = $row1['user_id'];

$sql7="SELECT post_content,topic_post
FROM posts
WHERE post_by=$uid";

$result7 = mysql_query($sql7) or die(mysql_error());
//$row7= mysql_fetch_assoc($result7);

echo '<table >';
         echo  '<tr style="border: 1px solid black; border-collapse: collapse;
                border-spacing: 0; padding: 0; ">';
         echo  '<td width="15%" align="center">Post Content</td>';
		 echo  '<td width="45%" align="center">Under Topic</td>';	 

while(($row7 = mysql_fetch_array($result7)))
 {
    
 
echo'<tr style="border: 1px solid black;border-collapse: collapse;
    border-spacing: 0; padding: 0;">';
    echo'<td width="15%" align="center">'.$row7['post_content'].'<br></td>';
	echo'<td width="45%" align="center">'.$row7['topic_post'].'<br></td>';	
     echo"</tr>";

}	 
	   
	   
	    
	   
 echo "</table>";      
	     
		 
		 
		 
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