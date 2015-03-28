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
$username =$_SESSION['username'];


$sql="SELECT * FROM categories" ;



$result = mysql_query($sql);



  if(!$result)
        {
            
            echo 'No Topics in this category';
  
        }
        else
		{
 while($row = mysql_fetch_array($result))
 {


 echo '<div class="forumPost"style="background-color:white; margin-bottom:10px; padding-top:15px;background: #ffffff; /* Old browsers */
background: -moz-linear-gradient(top,  #ffffff 0%, #f3f3f3 50%, #ededed 51%, #ffffff 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(50%,#f3f3f3), color-stop(51%,#ededed), color-stop(100%,#ffffff)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%); /* IE10+ */
background: linear-gradient(to bottom,  #ffffff 0%,#f3f3f3 50%,#ededed 51%,#ffffff 100%); /* W3C */">';
echo '<div style="width : 55%; float:left; border:1px solid"><span style="font-weight:bold">'.$row['cat_name'].'<br></span><span style="font-size:13px">Description: '.$row['cat_description'].'</span>
</div><div style="width:15%; float:left"><a href="topics.php?cat_id='.$row['cat_id'].'">ViewTopics</a><br/><a href="insert_topic.php?cat_id='.$row['cat_id'].'">Insert Topic</a></div>
 </div>';
 
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