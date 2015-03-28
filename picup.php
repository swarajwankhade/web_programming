if(isset($_REQUEST['submit_pic']))
{
//make variables available
$image_caption = $_POST['image_caption'];
$image_username = $_POST['image_username'];
$image_tempname = $_FILES['image_filename']['name'];
$today = date("Y-m-d");

//upload image and check for image type
//make sure to change your path to match your images directory
$ImageDir ="/home/swankhad/cs418_html/code/upload_images";
$ImageName = $ImageDir . $image_tempname;

if (move_uploaded_file($_FILES['image_filename']['tmp_name'], 
  $ImageName)) {
 //get info about the image being uploaded
 list($width, $height, $type, $attr) = getimagesize($ImageName);

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
case 6:
 $ext = ".bmp";
 break;
case 7:
case 8:
 $ext = ".tiff";
 break;
default:
 $ext = ".png";
}
 
 //echo "ext : " . $ext;
 //insert info into image table
 /*$insert = "INSERT INTO images
(image_caption, image_username, image_date)
VALUES
('$image_caption', '$image_username', '$today')";
 $insertresults = $mysqli->query($insert)
or die($mysqli->error);
 $lastpicid = $mysqli->insert_id;*/
 
 $file_name = "profile_pic_" . $uid . $ext;
 $newfilename = $ImageDir . $file_name;

 //if(unlink($newfilename))
 {
rename($ImageName, $newfilename);
 
$qry = "update " . USER_DETAILS . " set profile_image_name = '" . $file_name . "' where id = " . $uid;
$mysqli->query($qry);
 }
 }
}