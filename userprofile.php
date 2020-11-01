<?php
include "nav.php";
if (isset($_SESSION['valid_user']))
{
$patient = $_SESSION['valid_user'];
}

include "dbconnect.php";
$sql = "SELECT * FROM patients WHERE Name='$patient'; ";
$result = $dbcnx->query($sql);
if ($result->num_rows >0){
    $row = $result->fetch_assoc();
    $patientID = $row[UserID];

}

$sql1 = "SELECT * FROM patientDetails WHERE UserID= '$patientID'; ";
$result1 = $dbcnx->query($sql1);
if ($result1->num_rows ==0){
    $sql2= "INSERT INTO patientDetails VALUES ('$patientID','$patient',NULL,NULL);";
    $result2 = $dbcnx->query($sql2);
}
else{
    $row = $result1->fetch_assoc();
    $profile = $row[Profile];
    $medHistory = $row[MedicalHistory];

}

?>
<style>
<?php include 'style.css'; ?>
</style>
<html>

<body>
<div id='content' style='text-align:left'>
<?php
echo "<h2>".$patient."</h2>";

echo "<form action='updateprofile.php' method='POST'>";
echo "<h3>Personal Profile:</h3>";
echo $profile;
echo "<h3>Medical History:</h3>";
echo $medHistory;
echo "<div style='text-align:right'><input type='submit' value = 'Update' name='update' id='Register'></div>";
echo "</form>";

echo "<h3>Appointments:</h3>";

$sql3 = "SELECT * FROM appointments WHERE Patient= '$patient' ORDER BY AptDate ASC, AptTime ASC;";
$result3 = $dbcnx->query($sql3);
if ($result3->num_rows >0){
          while($row = $result3->fetch_assoc()) {
			   echo "<form action='appointment.php' method='POST'>";

               echo " Dr: " . $row[Doctor]." Date: " . $row[AptDate]." Time: " . $row[AptTime]. "<br>"; 
              echo "<input type='text' value=".$row[Doctor]." name = 'doctor'>";
              echo "<input type='text' value=".$row[AppointmentID]." name = 'slotID'>";
              echo "<input type='submit' value='Reschedule Appointment' name='RescheduleAppointment' id='Register' style='width:170px'>";
              echo "<input type='submit' value='Cancel Appointment' name='CancelAppointment' id='Register' style='width:170px'>";
			echo "</form>";
		}
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