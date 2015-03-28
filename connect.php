<?php  


session_start();
//connect.php
$server = 'localhost';
$username   = 'vnwala';
$password   = "223344";
$database   = 'vnwala';
 
if(!mysql_connect($server, $username,  $password))
{
    exit('Error: could not establish database connection');
}
if(!mysql_select_db($database))
{
    exit('Error: could not select the database');
}
 function loggedin() 
 {
   if (isset($_SESSION['username'])||isset($_COOKIE['username']))
   {
     $loggedin =TRUE;
	 return $loggedin;
   }
 }

?>