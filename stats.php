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
							Login Page
							<?php
$sql="SELECT user_name, COUNT( post_content ), user_date
FROM users
LEFT JOIN posts ON users.user_id = posts.post_by
GROUP BY user_name";
$result = mysql_query( $sql ) or die(mysql_error());


$sql2="SELECT user_name, COUNT( reply_content ) 
FROM users
LEFT JOIN replies ON users.user_id = replies.user_id
GROUP BY user_name";
$result2 = mysql_query( $sql2 ) or die(mysql_error());

echo '<table >';
echo  '<tr style="border: 1px solid black; border-collapse: collapse;
    border-spacing: 0; padding: 0; ">';
echo  '<td width="15%" align="center">USERNAME</td>';
echo  '<td width="45%" align="center">DATE</td>';
echo  '<td width="20%" align="center">POSTS</td>';
echo  '<td width="20%" align="center">REPLIES</td>';

echo  '</tr>';


while(($row = mysql_fetch_array($result)))
 {
  $row2 = mysql_fetch_array($result2);
  
 
echo'<tr style="border: 1px solid black;border-collapse: collapse;
    border-spacing: 0; padding: 0;">';
    echo'<td width="15%" align="center">'.$row['user_name'].'<br></td>';
	echo'<td width="45%" align="center">'.$row['user_date'].'<br></td>';
	echo'<td width="20%" align="center">'.$row['COUNT( post_content )'].'<br></td>';
	echo'<td width="20%" align="center">'.$row2['COUNT( reply_content )'].'<br></td>';
	 echo"</tr>";
 }
 
echo "</table>"; 
?>
<html>
<head>
</head>
<body>
</body>
</html>

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
