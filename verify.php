<?php
  require_once('recaptchalib.php');
  $privatekey = "6Lf4NvISAAAAAHfv5tTSor4uJ5zfDIpGcWKWdiB8";
  $flag = "0";
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
$flag = "1"; 
header("Location: signup.php?flag=1");
	 exit();
    // Your code here to handle a successful verification
  }
  ?>