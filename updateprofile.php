<?php
include "nav.php";
if (isset($_SESSION['valid_user']))
{
$patient = $_SESSION['valid_user'];
}
include "dbconnect.php";


if ($_POST['saveChanges']){
    $newProfile = $_POST['updateprofile'];
    $newHistory = $_POST['updatemed'];
    
    $sql = "UPDATE patientDetails SET Profile='$newProfile', MedicalHistory = '$newHistory' WHERE Name = '$patient'";
    $result = $dbcnx->query($sql);
        echo "OK done";
        echo "<a href='index.php'>Now leave</a>";
    
}

?>
<style>
<?php include 'style.css'?>
</style>
<html>

<body>
<div id='content' style='text-align:left;'>
<?php
if (isset($_POST['update']))
{
echo "<h2>".$patient."</h2>";

echo "<form action='' method='POST'>";
echo "<h3>Personal Profile:</h3>";
echo "<input type='text' placeholder='Type here' name='updateprofile'>";
echo "<h3>Medical History:</h3>";
echo "<input type='text' placeholder='Type here' name='updatemed'><br>";
echo "<div style='text-align:right'><input type='submit' value = 'Save' name='saveChanges' id='Register' style='align:right;'></div>";
echo "</form>";

echo "<h3>Appointments:</h3>";


}

?>
</div>
</body>
  <footer>
	<small><i>Copyright &copy; 2017 Prime Clinic</i></small><br>
	<small><i>3360 Islington Ave, Toronto, Ontario</i></small><br>
	<small><i><a href="mailto:prime@clinic.com">prime@clinic.com</a></i></small>
	
  </footer>

</html>