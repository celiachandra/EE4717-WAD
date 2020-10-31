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

if (!$result) {
	echo "Your query failed.";}
else
    echo "Welcome ". $username . ". You are now registered";
    
?>

<html>
<body>
<h1>REGISTRATION</h1>
     <form method="post" action="">
     <table>
     <tr><td>Name:</td>
     <td><input type="text" name="userName"></td></tr>
     <tr><td>Email:</td>
     <td><input type="email" name="userEmail"></td></tr>
     <tr><td>Password:</td>
     <td><input type="password" name="userPassword"></td></tr>
     <tr><td>Re-enter password:</td>
     <td><input type="password" name="userPassword2"></td></tr>
     <tr><td colspan="2" align="center">
     <input type="submit" value="Register" name = 'submit'></td></tr>
     </table></form>
     </body>
</html>
