<?php
//signin.php
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

 
 if (loggedin())
     {
     header("Location: viewpost.php");
	 exit();
	 
	 }



 if ($_POST['user_name']) {
$username1 = mysql_real_escape_string($_POST['user_name']);
$password = mysql_real_escape_string($_POST['password']);
$remember = $_POST['remember'];
  
} 
  if ( $username1 && $password )
 {
 
 $sql="SELECT * FROM users WHERE user_name='$username1'";
 $result =mysql_query($sql);
   

   while ( $row = mysql_fetch_assoc($result) )
    {
	
	if ($row['pe_user'] !=0)
	{
	echo 'Your account has been temporarily suspended';
	
	}
	else
	{
	  $db_password = $row ['user_pass']; 
        if ($password==$db_password)  
		{
		   $SQLch="select * from users where user_name='$username1' and user_pass='$password' and status=1";
		   $result=mysql_query($SQLch);
			if(mysql_num_rows($result)>0)
			{
				
				$loginok = TRUE;
			}
		}  
		   else
		   $loginok = FALSE;
		  
		   if ($loginok==TRUE)
		   {  
		   
		       if ($remember=="on")
			       setcookie("username",$username1, time()+7200);
			else if ($remember=="")
			      $_SESSION['username']=$username1;
				  header("Location:viewpost.php");
				  if ($row['r_id']==1)
		    {
			 header("Location:admin2.php");
			}
				   exit();
		   }
		    else  {
			
			    die ("Incorrect username/password combination.");
		   }
   	 
		}
	} 
 }
 else  {
        echo 'Please enter a username and password';
	    
	  }
echo '<br>';
  echo '<a href="signup.php">SIGN UP</a>';
echo '<h2 style="color:red;">Sign In</h2>';



    echo '  <form method="POST" action="index.php">
            Username: <input type="text" name ="user_name" />
            Password: <input type="password" name ="password">
			<a href="forgot.php">Forgot Password</a> </br>
			Remember ID<input type="checkbox" name="remember" id="remember" /><BR>
            <input type="submit" value="submit" />
         </form> ';
   
  
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

