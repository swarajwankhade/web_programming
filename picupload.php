<?php
if($_REQUEST['Submit'])
{
require_once('connect.php');


echo "asdasdasdasd";
error_reporting(E_ALL);
ini_set("display_errors", 1);

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
  $lastpicid = 11;
  $newfilename = $ImageDir . $lastpicid . $ext;
  rename($ImageName, $newfilename);
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
<img src="upload_images/<?php echo $lastpicid . $ext; ?>" align="left">
<strong><?php echo $image_caption; ?></strong>
<br/>This image is a <?php echo $ext; ?> image.
<br/>It is <?php echo $width; ?> pixels wide 
and <?php echo $height; ?> pixels high.
<br/>It was uploaded on <?php echo $today; ?>
by <?php echo $image_username; ?>.

<?php
} else {
?>

<html>
<head>
<title>Upload your pic to our site!</title>
</head>
<body>

<form name="form1" method="post" action="picupload.php" 
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



<h1>There was an error in uploading your image</h1>
<b>caption:</b> <?php echo $image_caption;?>
<br/><b>username:</b> <?php echo $image_username;?>
<br/><b>tempname:</b> <?php echo $image_tempname;?>
<br/><b>image dir:</b> <?php echo $ImageDir;?>
<br/><b>image name:</b> <?php echo $ImageName;?>
<br/><b>date:</b> <?php echo $today;?>
<?php
}
?>

</body>
</html>