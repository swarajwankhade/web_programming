<?php
include 'connect.php';
include 'header.php';


//check to see if user has logged in with a valid password

?>
<html>
<head>

<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>



<form action="insert_2.php" method="POST">
 
Topic: 
<INPUT TYPE="text" NAME="topic_post" SIZE="30" MAXLENGTH="60" required><br></br>
   Message:
<br>
<TEXTAREA NAME="post_content" 
   ROWS="3" COLS="25" required>
</TEXTAREA>
<br><br>
<INPUT TYPE="submit">
<INPUT TYPE="reset">
 
</form>

</body>


</html>


