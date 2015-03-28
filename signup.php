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
							Login Page
							<?php
 
echo '<h3>Sign up</h3>';

function generatePassword($length=9, $strength=0) {
    $vowels = 'aeuy';
    $consonants = 'bdghjmnpqrstvz';
    if ($strength & 1) {
        $consonants .= 'BDGHJLMNPQRSTVWXZ';
    }
    if ($strength & 2) {
        $vowels .= "AEUY";
    }
    if ($strength & 4) {
        $consonants .= '23456789';
    }
    if ($strength & 8) {
        $consonants .= '@#$%';
    }
 
    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
}
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	$publickey = "6Lf4NvISAAAAANfgeWG40M0vkoZvGJgspMrcLqca";
	require_once('recaptchalib.php');
	
	echo '<form method="post" action="">' .
		recaptcha_get_html($publickey) .
        'Username: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="user_name" /></br>
        Password: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="password" name="user_pass"></br>
        Password again: <input type="password" name="user_pass_check"></br>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp E-mail: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="email" name="user_email">
		
		<select name="mailtype">
		<option value="htmltext">HTML</option>
		<option value="plaintext">Plain Text</option>
		</select></br>
        <input type="submit" value="Register" />
     </form>';
	
	/*<form method="post" action="">
        <?php
          require_once('recaptchalib.php');
          $publickey = "6Lf4NvISAAAAANfgeWG40M0vkoZvGJgspMrcLqca"; 
          echo recaptcha_get_html($publickey);
        ?>
        <input type="submit" />
      </form>
	  </body>
	  </html>*/
}
else
{
    require_once('recaptchalib.php');
  $privatekey = "6Lf4NvISAAAAAHfv5tTSor4uJ5zfDIpGcWKWdiB8";
  
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
  }
  else 
  {
    $errors = array(); 
     
    if(isset($_POST['user_name']))
    {
        
        if(!ctype_alnum($_POST['user_name']))
        {
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['user_name']) > 30)
        {
            $errors[] = 'The username cannot be longer than 30 characters.';
        }
    }
    else
    {
        $errors[] = 'The username field must not be empty.';
    }
     
     
    if(isset($_POST['user_pass']))
    {
        if($_POST['user_pass'] != $_POST['user_pass_check'])
        {
            $errors[] = 'The two passwords did not match.';
        }
    }
    else
    {
        $errors[] = 'The password field cannot be empty.';
    }
     
    if(!empty($errors)) 
    {
        echo 'Uh-oh.. a couple of fields are not filled in correctly..';
        echo '<ul>';
        foreach($errors as $key => $value) 
        {
            echo '<li>' . $value . '</li>'; 
        }
        echo '</ul>';
    }
	else
	{
	$email1=mysql_real_escape_string($_POST['user_email']);
	
	$sql1="select * from users where user_email='$email1'";
	$result1 =mysql_query($sql1);
	$row1= mysql_fetch_assoc($result1);
	    if($row1)
	    {
		  //echo $result1;
	      echo 'The Provided email id already exists.Please enter a different email Address.';
	    } 
		else
		{
		   $str = "cs.odu.edu";	
		   $emailv = split("\@",$email1);
		   if($emailv[1] != $str)
		   {
		     echo 'Please enter a cs.odu.edu email id';
			}
           else
          {    
        
		   $r_gen = generatePassword();
		//echo $r_gen;
		  $abc = mysql_real_escape_string($r_gen);
          $sql = "INSERT INTO
                    users(user_name, user_pass, user_email ,user_date, r_id ,pe_user ,status,rcode)
                VALUES('" . mysql_real_escape_string($_POST['user_name']) . "',
                       '" . mysql_real_escape_string($_POST['user_pass']) . "',
                       '" . mysql_real_escape_string($_POST['user_email']) . "',
                        NOW(),
                        3,
						0,
						0,
						'$abc'
						)";
                         
          $result = mysql_query($sql);
          if(!$result)
          {
            
            echo 'Something went wrong while registering. Please try again later.';
            
          }
	
	   //echo $_POST['mailtype'];
	   $text1 .= "Click on the Link below to confirm your registeration";
	   $text2 .= "Copy and paste the given URL to the browser to confirm your registeration";
	   $mailtype = $_POST['mailtype'];
	   //echo $mailtype1;
	   $to = $_POST["user_email"];
       $from = 'ggp@info.com';
       $subject = 'GGP Registeration confirmation';
	   //echo $abc;
	   
	   if($mailtype == 'htmltext')
	   {
	   $message = $text1 ."\n";
	   
	   $uri = substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/') + 1);
	   //$message = 'href="https://weiglevm.cs.odu.edu' . $uri . 'system.php?id='.$abc;
       $message .= '<a href="https://weiglevm.cs.odu.edu' . $uri . 'system.php?id='.$abc.'">Click Here...!!!!</a>';	   
	   $headers = "MIME-Version: 1.0\r\n";
       $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
       $headers .= "Content-Transfer-Encoding: 7bit\r\n";
       $headers .= "From: " . $from . "\r\n";
       $mailsent = mail($to, $subject, $message, $headers);
	   echo 'A email has been sent to your email address';
	   }
	   else
	   {
	   $message = $text2 ."\n";
	   $message .= "https://weiglevm.cs.odu.edu/~vnwala/proj3/system.php?id=$abc";
	   $headers = "MIME-Version: 1.0\r\n";
       $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n"; 
       $headers .= "Content-Transfer-Encoding: 7bit\r\n";
       $headers .= "From: " . $from . "\r\n";
       $mailsent = mail($to, $subject, $message, $headers);
	   echo 'A email has been sent to your email address';
	   }
	   
	   
		
		
      }  
    }
  }
}
}

 
//include 'footer.php';
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
