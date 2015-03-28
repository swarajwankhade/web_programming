<?php
include 'connect.php';
include 'header.php';

$sti=$_REQUEST['id'];
//echo "bjk";
//echo $sti;
$sql="SELECT * FROM users WHERE rcode='$sti'";
$result =mysql_query($sql);
if(!$result)
        {
            //something went wrong, display the error
            echo 'Something went wrong while registering. Please try again later.';
            //echo mysql_error(); //debugging purposes, uncomment when needed
        }
else
        {
		    
			$sql1 = "UPDATE users set status='1' where rcode='$sti'"; 
			$result1 =mysql_query($sql1);
		if(!$result1)
		{
		}
		else
		{
            echo 'Successfully registered. You can now <a href="index.php">sign in</a> and start posting! :-)';
			}
        }
		
?>