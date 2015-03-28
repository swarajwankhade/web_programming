<?php
include 'connect.php';
include 'header.php';

echo '  <form method="POST" action="">
            Username: <input type="text" name ="user_name" />
            Password: <input type="password" name ="password">
			Remember ID<input type="checkbox" name="remember" id="remember" /><BR>
            <input type="submit" name="abc" value="submit" />
  </form> ';
  
  if(isset($_POST['abc']))
  {
  if( $_POST['user_name']=='ta2014' && $_POST['password']=='ta2014')
  {
  
  echo" WELCOME TA, PROCEED";
  header('Location:admin2.php');
  }
  else
  {
  
  //echo"You do not have pemmissions";
  header('Location:index.php');
  
  }
  }
  
  
  
  
  
  
  
  
?>