<?php
  session_start();
  
  // store to test if they *were* logged in
  $old_user = $_SESSION['valid_user'];  
  unset($_SESSION['valid_user']);
  session_destroy();
?>
<html lang="en">
<head>
<title>Prime Clinic</title>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet">
</head>
<body>
<?php
if (!empty($old_user))
  {
    echo 'You have been successfully logged out.<br />';
  }
?>
<a href="index.php">Back to main page</a>
</body>
</html>