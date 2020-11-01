<?php 
include "dbconnect.php";
session_start();

if (isset($_POST['submit'])) {
    if (empty ($_POST['userEmail']) || empty ($_POST['userPassword']) ||  empty ($_POST['userType']) ) 
    {
	echo "All records to be filled in";
    exit;}
}
$email = $_POST['userEmail'];
$password = $_POST['userPassword'];
$userType = $_POST['userType'];
$_SESSION['usertype'] = $userType;

$password = md5($password);
if ($userType == 'Doctor'){
	$sql = "SELECT Name FROM doctors WHERE Email= '$email' AND Password= '$password'; ";

$result = $dbcnx->query($sql);
if ($result->num_rows >0){
    $row = $result->fetch_assoc();
    $_SESSION['valid_user'] = $row['Name'];
}

if (isset($_SESSION['valid_user'])) {
    echo 'You are logged in as: '.$_SESSION['valid_user'].' <br />';
    echo '<a href="index.php">Home Page</a><br />';
    echo '<a href="logout.php">Log out</a><br />';
}
}
if ($userType == 'Patient'){$sql = "SELECT Name FROM patients WHERE Email= '$email' AND Password= '$password'; ";

$result = $dbcnx->query($sql);
if ($result->num_rows >0){
    $row = $result->fetch_assoc();
    $_SESSION['valid_user'] = $row['Name'];
}

if (isset($_SESSION['valid_user'])) {
    echo 'You are logged in as: '.$_SESSION['valid_user'].' <br />';
    echo '<a href="index.php">Home Page</a><br />';
    echo '<a href="logout.php">Log out</a><br />';
}}


else{
    if (isset($email)){
        echo "Could not log you in.";
    }
    else {
        echo "You are not logged in.";
    }
}

?>
<?php include 'nav.php';?>
<style>
<?php include 'style.css';?>
</style>

<html>
<body>
<div id='content'>
<div class='boxes'>
<h2>Login</h2>
     <form method="post" action="">
     <table class='details'>
     <tr><td>Email:</td>
     <td><input type="email" name="userEmail" required></td></tr>
     <tr><td>Password:</td>
     <td><input type="password" name="userPassword" required></td></tr>
     <tr><td colspan="2">
	 <label for="userType">User Type:</label>
	<select id="userType" name="userType">
	  <option value="Patient">Patient</option>
	  <option value="Doctor">Doctor</option>
	</select></td></tr></table>
     <input type="submit" value="LOGIN" name = 'submit' id='Register'>
     </form>
	 </div>
     </body>
</div>
	<footer>
	<small><i>Copyright &copy; 2017 Prime Clinic</i></small><br>
	<small><i>3360 Islington Ave, Toronto, Ontario</i></small><br>
	<small><i><a href="mailto:prime@clinic.com">prime@clinic.com</a></i></small>
  </footer>
</html>
