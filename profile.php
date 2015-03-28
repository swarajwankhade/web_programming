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

echo 'Welcome, ' . $_SESSION['username']; 
$username1 = $_SESSION['username'];
$sql5 = "select * from users where user_name='$username1'";
$result5 = mysql_query($sql5);
//echo $result1;
$row5 = mysql_fetch_array($result5);	
//echo "fg".$row5['images'];
echo '<img src="'.$row5['images'].'"height=100 width=100';
echo'</br>';
$sql1 = "select user_id from users where user_name='$username1'";
$result1 = mysql_query($sql1);
//echo $result1;
$row1 = mysql_fetch_array($result1);
//echo $username1;
//echo $row1['user_id'];
$uid = $row1['user_id'];
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
	echo '<a href="userposts.php">View Posts</a>';
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


<?php
if($_REQUEST['Submit'])
{
require_once('connect.php');


//echo "asdasdasdasd";
error_reporting(E_ALL);
//ini_set("display_errors", 1);

//connect to the database
//$mysqli = new mysqli(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB) or 
//     die ("Check your server connection.");

//make variables available
$image_caption = $_POST['image_caption'];
$image_username = $_POST['image_username'];
$image_tempname = $_FILES['image_filename']['name'];
$today = date("Y-m-d");

//upload image and check for image type
//make sure to change your path to match your images directory
$ImageDir ="/home/swankhad/cs418_html/code/upload_images/";
$ImageName = $ImageDir . $image_tempname;
$ImageDir1 ="./upload_images/";
$ImageName1 = $ImageDir1 . $image_tempname;

if (move_uploaded_file($_FILES['image_filename']['tmp_name'], 
                       $ImageName)) {
  //get info about the image being uploaded
  list($width, $height, $type, $attr) = getimagesize($ImageName);
echo "Type : " . $type;
  switch ($type) {
    case 1:
      $ext = ".gif";
      break;
    case 2:
      $ext = ".jpg";
      break;
    case 3:
      $ext = ".png";
      break;
    default:
      echo "Sorry, but the file you uploaded was not a GIF, JPG, or " .
           "PNG file.<br>";
      echo "Please hit your browser's 'back' button and try again.";
  }

  //insert info into image table
  /*$insert = "INSERT INTO images
            (image_caption, image_username, image_date)
            VALUES
            ('$image_caption', '$image_username', '$today')";
  $insertresults = $mysqli->query($insert)
    or die($mysqli->error);
  $lastpicid = $mysqli->insert_id;*/
  //$lastpicid = 11;
  
  $username5 = $_SESSION['username'];
$sql5 = "select user_id from users where user_name='$username5'";
$result5 = mysql_query($sql5);
//echo $result1;
$row5 = mysql_fetch_array($result5);
//echo $username1;
//echo $row1['user_id'];
$uid = $row5['user_id'];
  
  $newfilename = $ImageDir . $uid . $ext;
  rename($ImageName, $newfilename);
  $newfilename1 = $ImageDir1 . $uid . $ext;
  $qry = "update " . users . " set images = '" . $newfilename1 . "' where user_id = " . $uid;
  $result2 = mysql_query( $qry ) or die(mysql_error());
}
?>

<html>
<head>
<title>Here is your pic!</title>
<script>
function check_file(){
        str=document.getElementById('image_filename').value.toUpperCase();
        suffix=".JPG";
        suffix2=".JPEG";
        if(!(str.indexOf(suffix, str.length - suffix.length) !== -1||
                       str.indexOf(suffix2, str.length - suffix2.length) !== -1)){
        alert('File type not allowed,\nAllowed file: *.jpg,*.jpeg');
            document.getElementById('image_filename').value='';
        }
    }
</script>
</head>
<body>
<h1>Picture Upload Successful!</h1>
<p>Here is the picture you just uploaded to our servers:</p>
<img src="upload_images/<?php echo $uid . $ext; ?>" align="left">
<strong><?php echo $image_caption; ?></strong>
<br/>This image is a <?php echo $ext; ?> image.
<br/>It is <?php echo $width; ?> pixels wide 
and <?php echo $height; ?> pixels high.
<br/>It was uploaded on  <?php echo $today; ?>
 by <?php echo $username5; ?>.

<?php
} else {
?>

<html>
<head>
<title>Upload your pic to our site!</title>
</head>
<body>

<form name="form1" method="post" action="" 
    enctype="multipart/form-data">

<table border="0" cellpadding="5">
 <tr>
<td>Image Title or Caption<br>
 <em>Example: You talkin' to me?</em></td>
<td><input name="image_caption" type="text" id="item_caption" size="55" 
 maxlength="255"></td>
 </tr>
 <tr>
<td>Your Username</td>
<td><input name="image_username" type="text" id="image_username" size="15" 
 maxlength="255"></td>
 </tr>
<td>Upload Image:</td>
<td><input name="image_filename" type="file" id="image_filename" onchange="check_file()" accept="image/*"></td>
 </tr>
</table>
<br>
<em>Acceptable image formats include: GIF, JPG/JPEG, and PNG.</em>
<p align="center"><input type="submit" name="Submit" value="Submit">
 &nbsp;
 <input type="reset" name="Submit2" value="Clear Form">
</p>
</form>
</body>
</html>




<?php
}
?>

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