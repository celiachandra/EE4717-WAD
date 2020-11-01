<?php include "nav.php";

if (isset($_SESSION['valid_user'])) {
  $doctor=$_SESSION['valid_user'];
}

include "dbconnect.php";
$sql="SELECT * FROM doctors WHERE Name='$doctor'; ";
$result=$dbcnx->query($sql);

if ($result->num_rows >0) {
  $row=$result->fetch_assoc();
  $patientID=$row[UserID];

}

?><style><?php include 'style.css'?></style><html><body><?php echo "<div id='content'>";
echo "<h1>Doctor Profile:".$patient."</h1>";


echo "<h2>Appointments:</h2>";

$sql3="SELECT * FROM appointments WHERE Doctor= '$doctor'; ";
$result3=$dbcnx->query($sql3);

if ($result3->num_rows >0) {
   while($row=$result3->fetch_assoc()) {
    echo "<form action='drappointment.php' method='POST'>";

    echo " Patient: ". $row[Patient]." Date: ". $row[AptDate]." Time: ". $row[AptTime]. "<br>";
    echo "<input type='text' value=".$row[Doctor]." name = 'doctor'>";
    echo "<input type='text' value=".$row[Patient]." name = 'patient'>";
    echo "<input type='text' value=".$row[AppointmentID]." name = 'slotID'>";
    echo "<input type='submit' value='RescheduleAppointment' name='RescheduleAppointment'>";
    echo "</form>";
  }
}
else{
  echo "You have no upcoming appointments.";
}

echo "</div>";
?></body></html>