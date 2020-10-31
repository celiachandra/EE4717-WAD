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
<html>

<body>
<?php
echo "<h1>Patient Profile:".$patient."</h1>";

echo "<form action='updateprofile.php' method='POST'>";
echo "<h2>Personal Profile:</h2>";
echo $profile;
echo "<h2>Medical History:</h2>";
echo $medHistory;
echo "<input type='submit' value = 'Update' name='update'>";
echo "</form>";

echo "<h2>Appointments:</h2>";

$sql3 = "SELECT * FROM appointments WHERE Patient= '$patient'; ";
$result3 = $dbcnx->query($sql3);
if ($result3->num_rows >0){
          while($row = $result3->fetch_assoc()) {
			   echo "<form action='appointment.php' method='POST'>";

               echo " Dr: " . $row[Doctor]." Date: " . $row[AptDate]." Time: " . $row[AptTime]. "<br>"; 
              echo "<input type='text' value=".$row[Doctor]." name = 'doctor'>";
              echo "<input type='text' value=".$row[AppointmentID]." name = 'slotID'>";
			  echo "<input type='submit' value='RescheduleAppointment' name='RescheduleAppointment'>";
			echo "</form>";
		}
}



?>
</body>


</html>