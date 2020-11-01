<?php include "nav.php";

if ( !isset($_SESSION['valid_user'])) {
     echo '<p>Please login to book appointment</p>';
     exit;
}

if (isset($_POST['doctor'])) {
     $chosenDoctor=$_POST['doctor'];
}

else {
     $chosenDoctor=$_SESSION['current_doctor'];
}

;
$currentPatient=$_POST['patient'];

$_SESSION['appointment_to_change']=$_POST['slotID'];
$oldAppointment=$_SESSION['appointment_to_change'];
$_SESSION['current_doctor']=$chosenDoctor;

include "dbconnect.php";

?><style>
     <?php include 'style.css'?>
</style>
<html>

<body>
     <div id='content' style='text-align:left;'><?php if (isset($_POST['CancelAppointment'])) {
     $sql="SELECT * FROM appointments WHERE AppointmentID = $oldAppointment;";
     $result=$dbcnx->query($sql);

     if ($result->num_rows >0) {
          $row=$result->fetch_assoc();
          $oldID=$row['AppointmentID'];
          $oldDr=$row['Doctor'];
          $oldPt=$row['Patient'];
          $oldDt=$row['AptDate'];
          $oldTm=$row['AptTime'];
     }

     $sql="INSERT INTO `availableslots` (`SlotID`, `DoctorID`, `DoctorName`, `SlotDate`, `SlotTime`) VALUES 
(NULL, NULL, '$oldDr', '$oldDt', '$oldTm');
     ";
$result=$dbcnx->query($sql);
     $sql="DELETE FROM appointments WHERE AppointmentID = $oldAppointment;";
     $result=$dbcnx->query($sql);


     echo "You have cancelled your appointment";
     echo "<a href='index.php'>Back to main page</a>";
     exit;
}




?><h2>Book Appointment</h2>
Doctor: <?php echo $chosenDoctor."<br>";
error_reporting(E_ERROR | E_PARSE);

echo "<form method='post' action=''>";
$sql="SELECT DISTINCT SlotDate FROM availableslots WHERE DoctorName = '$chosenDoctor' ORDER BY SlotDate ASC;";
$result=$dbcnx->query($sql);
if ($result->num_rows >0) {

echo "<label for='dates'>Choose a date:</label>";
echo "<select name='dates' id='dates'>";

while($row=$result->fetch_assoc()) {
     echo "<option value = '$row[SlotID]'> ".$row[SlotDate]."</option>";
}

echo "</select><br>";
}

echo "<form method='post' action='confirmation.php'>";
$sql="SELECT * FROM availableslots WHERE DoctorName = '$chosenDoctor' ORDER BY SlotDate ASC, SlotTime ASC;";
$result=$dbcnx->query($sql);



if ($result->num_rows >0) {
    
     while($row=$result->fetch_assoc()) {
          echo "<input type='radio' value=".$row[SlotID]." name='chosenSlot'>";
          echo "<label> Date/Time: ". $row[SlotDate]. " ". $row[SlotTime]."</label><br>";
     }

     if (isset($_POST['RescheduleAppointment'])) {
          echo"     <input type='submit' value='Reschedule Appointment' name = 'reschedApt' id='Register' style='width:150px;'>";
     }

     else {
          echo"     <input type='submit' value='Book Appointment' name = 'bookApt' id='Register' style='width:150px'>";
     }
}

else {
     echo $chosenDoctor." is not available for consultations at the moment. <br><br>";
}


?></form>
          </form><input type="submit" value="Back" <a href="#" onclick="history.back();"></a>
     </div>
</body>
<footer><small><i>Copyright &copy;
               2017 Prime Clinic</i></small><br><small><i>3360 Islington Ave,
               Toronto,
               Ontario</i></small><br><small><i><a href="mailto:prime@clinic.com">prime@clinic.com</a></i></small>
</footer>

</html>