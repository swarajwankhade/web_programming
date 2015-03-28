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

<html>

<?php	  
	  if ($_POST['forgot']) 
	  {
       $forgot1 = $_POST['forgot'];
	   //echo $forgot1;
	   $sql="select user_name from users where user_email='$forgot1'";
	   $result = mysql_query($sql);
	   $row1= mysql_fetch_assoc($result);
	   if(!$row1)
	   {
	     echo 'sorry...!!! you entered a wrong email address...!!!';
	   }
       else
       {
	     $result1="select user_pass from users where user_email='$forgot1'";
		 $result2 =mysql_query($result1);
		 $row= mysql_fetch_assoc($result2);
         $to = $_POST["forgot"];
         $from = 'ggp@info.com';
         $subject = 'GGP Password';
	     //echo $result2;
         $message = "Hello ". $row1['user_name']." your password is : ". $row['user_pass'];
	     $headers = "MIME-Version: 1.0\r\n";
         $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
         $headers .= "Content-Transfer-Encoding: 7bit\r\n";
         $headers .= "From: " . $from . "\r\n";
         $mailsent = mail($to, $subject, $message, $headers);
	     echo 'An email has been sent to your email address';	
	   }
	  }
    /*else
	{
	 echo 'Please enter an email id...!!!';
    }*/	 
?>

<form method="POST" action="">
      Enter your email address:<input type="text" name ="forgot" />
	  <input type="submit" value="Submit" />
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