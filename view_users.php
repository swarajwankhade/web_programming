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

$sql="SELECT users . * , roles.role, users.r_id, users.user_name
FROM users
INNER JOIN roles ON roles.role_id = users.r_id where del IS NULL";
$result = mysql_query($sql);

  if(!$result)
        {
            
            echo 'No posts available!';
  
        }
        else
		{
 while($row = mysql_fetch_array($result))
 {
$sql1234="select count(*) as abc from replies where user_id =$row[user_id]";

$result1234 = mysql_query( $sql1234 ) or die(mysql_error());

if(mysql_num_rows($result1234)>0)
{
	$row13=mysql_fetch_array($result1234);
	$cnnt=$row13[abc];
	if($cnnt=='0')
	{
		$rank="Newbie";
	}
	if($cnnt>'3')
	{
		$rank="Midbie";
	}
	if($cnnt>'10')
	{
		$rank="Honeybie";
	}
}

echo '<div class="forumPost">
<div style="width : 55%; float:left; border:1px solid"><span style="font-weight:bold">'.$row['user_name'].'('.$rank.')<br/></span><span style="font-size:13px">Role as '.$row['role'].', '.$row['user_date'].'</span>
</div>
 <div style="width:15%; float:left; border:0px solid"><a href="edit.php?user_id='.$row['user_id'].'">Change Role</a><br/><a href="deletes.php?user_id='.$row['user_id'].'">Delete</a><br/>';
 if($row[pe_user]=="0"){echo '<a href=susp.php?user_id='.$row['user_id'].'>Suspend User</a>';} else {echo '<br/><a href=unsusp.php?user_id='.$row['user_id'].'>UnSuspend User</a>';} echo '</div></div>';
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