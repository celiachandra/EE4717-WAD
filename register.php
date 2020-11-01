<?php // register.php
include "dbconnect.php";
   
if (isset($_POST['submit'])) {
	if (empty($_POST['userName']) || empty ($_POST['userEmail']) || empty ($_POST['userPassword']) 
		|| empty ($_POST['userPassword2']) ) {
	echo "All records to be filled in";
    exit;}
}
$name = $_POST['userName'];
$email = $_POST['userEmail'];
$password = $_POST['userPassword'];
$password2 = $_POST['userPassword2'];

if ($password != $password2) {
	echo "Sorry passwords do not match";
	exit;
	}
$password = md5($password);
// echo $password;
$sql1 = "SELECT * FROM patients WHERE Email = '$email';";
$result1 = $dbcnx->query($sql1);

if ($result1->num_rows >0){
    echo "That email address has been taken, please use a different one";
    exit;
}

if ($name&&$email&&$password&&$password2){
$sql = "INSERT INTO patients
		VALUES (NULL,'$name', '$email', '$password','Patient');";
//	echo "<br>". $sql. "<br>";
$result = $dbcnx->query($sql);

}

if ($result) {
    echo "Welcome ". $username . ". You are now registered";}

    
?>
<?php include 'nav.php';?>
<style>
<?php include 'style.css';?>
</style>
<html>
<body>
<div id='content'>
<div class='boxes'>
<h2>Registration</h2>
     <form method="post" action="">
     <table class='details'>
     <tr><td>Name:</td>
     <td><input type="text" name="userName" required></td></tr>
     <tr><td>Email:</td>
     <td><input type="email" name="userEmail" required></td></tr>
     <tr><td>Password:</td>
     <td><input type="password" name="userPassword" required></td></tr>
     <tr><td>Re-enter password:</td>
     <td><input type="password" name="userPassword2" required></td></tr></table>
     <input type="submit" value="Register" name = 'submit' id='Register'>
     </form>
	 </div>
	 </div>
     </body>
	<footer>
	<small><i>Copyright &copy; 2017 Prime Clinic</i></small><br>
	<small><i>3360 Islington Ave, Toronto, Ontario</i></small><br>
	<small><i><a href="mailto:prime@clinic.com">prime@clinic.com</a></i></small>
  </footer>
</html>
