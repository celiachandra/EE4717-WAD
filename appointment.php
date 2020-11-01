<?php include "nav.php";

if ( !isset($_SESSION['valid_user'])) {
     echo '<p>Please login to book appointment</p>';
}

if (isset($_POST['RescheduleAppointment'])) {
     echo "Meep";
}

$chosenDoctor=$_POST['doctor'];
$currentPatient=$_POST['patient'];

$_SESSION['appointment_to_change'] = $_POST['slotID'];

echo $_SESSION['appointment_to_change'];

include "dbconnect.php";
?>
<style>
<?php include 'style.css'?>
</style>
<html>

<body>
<div id='content' style='text-align:left;'>
     <h2>Book Appointment</h2>
     <form method="post" action="confirmation.php">Doctor: <?php echo $chosenDoctor."<br>";
error_reporting(E_ERROR | E_PARSE);

$sql="SELECT * FROM availableslots WHERE DoctorName = '$chosenDoctor' ";
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
     </form>
</div>
</body>
<footer>
	<small><i>Copyright &copy; 2017 Prime Clinic</i></small><br>
	<small><i>3360 Islington Ave, Toronto, Ontario</i></small><br>
	<small><i><a href="mailto:prime@clinic.com">prime@clinic.com</a></i></small>
	
  </footer>
</html>