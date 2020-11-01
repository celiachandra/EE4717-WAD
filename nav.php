<?php session_start();

?><html lang="en">
<div id="head">
  <header>
    <p id="primeclinic"><img src="logo.png" width=23px alt="logo"><strong>Prime Clinic</strong></p>
    <nav><strong><a href="index.php" id="active">Home</a><a href="aboutus.php">About Us</a><a
          href="services.php">Services</a></strong></nav>
    <div id="buttons"><?php if (isset($_SESSION['valid_user'])) {

  if ($_SESSION['usertype']=='Patient') {
    echo "Welcome, <a href='userprofile.php'>".$_SESSION['valid_user']."</a> ";
    echo "<a href='logout.php'>Log out</a><br />";
  }

  else if ($_SESSION['usertype']=='Doctor') {
    echo "Welcome, <a href='drprofile.php'>".$_SESSION['valid_user']."</a> ";
    echo "<a href='logout.php'>Log out</a><br />";
  }

}

else {
  echo "<button id='Login' name='Login' onclick='location.href=\"login.php\"'>Login</button>";
  echo "<button id='Register' name='Register' onclick='location.href=\"register.php\"'>Register</button>";

}

?></div>
  </header>
</div>

</html>