<?php
include 'connect.php';
//include 'header.php';
?>

<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Products - Gadget Shop Website Template</title>
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
session_start();

$user_id = $_REQUEST['user_id'];
$sql1="SELECT * FROM users WHERE user_id=".$user_id;
$result = mysql_query( $sql1 ) or die(mysql_error());
while($row = mysql_fetch_array($result))
{
$r_id=$row['r_id'];
}



$sql2="SELECT * FROM roles WHERE role_id=".$r_id;
$result = mysql_query( $sql2 ) or die(mysql_error());
while($row = mysql_fetch_array($result))
{
$role=$row['role'];
 }




echo 'The Initial Role is :'.$role;


if (isset($_POST['submit'])&& $_POST['submit'] == 'Change')
{

if( $_POST['rol']=='Administrator')
{

$r_d=1;
}

if( $_POST['rol']=='Moderator')
{
$r_d=2;
}

if( $_POST['rol']=='User')
{
$r_d=3;
}

$sql="UPDATE users SET r_id=$r_d WHERE user_id=".$user_id;
echo $sql;

$result = mysql_query( $sql ) or die(mysql_error());
echo $result;
if($result) 
header( 'Location: view_users.php' );
/*while($row = mysql_fetch_array($result))
{
header ( 'Location: view_users.php' ) ;

}

*/

}


?>

<html>
<head>
<head>
<body>
<div class="forumPost">
<h3 style="text-align:center">CHANGE ROLE</h3>
<form action="edit.php" method="POST">
<select name="rol">
<option value="Administrator">Administrator</option>
<option value="Moderator">Moderator</option>
<option value="User">User</option>
<input type="hidden" name = "user_id" value="<?php echo $user_id; ?>" />
<input type="submit" value="Change" name="submit">
</select>
</form>
</div>
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