<?php
//signin.php
include 'connect.php';
include 'header.php';


if ($_POST['login'])) {
$username = $_POST['user_name'];
$password = $_POST['user_pass'];
$rememberme = $_POST['remember'];
  
}
 if ( $username&&$password)
 {
 
 $login =mysql_query("SELECT * FROM users WHERE username='$username' ");
   while ( $row = mysql_fetch_assoc($login) )
    {  
	  $db_password = $row ('password'); 
        if ($password==$db_password)   
		   $loginok = TRUE;
		   else
		   $loginok = FALSE;
		   
		   if ($loginok==TRUE)
		   {  
		   
		       if ($remember=="on")
			       setcookie("username",$username, time()+7200);
			else if ($remember=="")
			      $_SESSION['username']=$username;
				  header("Location:"viewpost.php");
				   exit();
		   }
		    else 
			    die ("Incorrect username/password combination.");
		   
   	 
    }
 } 
 
 else  {
      die ("Please enter a username and password.");
	      exit();
	  }

 


     echo'   <form method="POST" action="new.php">
            Username: <input type="text" name ="user_name">
            Password: <input type="password" name ="user_pass">
			Remember ID<input type="checkbox" name="remember" id="remember"><BR>
            <input type="submit" value="login" >
         </form>';
   
  
?>

