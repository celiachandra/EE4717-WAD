<?php include "nav.php";

if ( !isset($_SESSION['valid_user'])) {
     echo '<p>Please login to reschedule appointment</p>';
     exit;
}

$chosenDoctor=$_SESSION['valid_user'];
$currentPatient=$_POST['patient'];

$_SESSION['appointment_to_change'] = $_POST['slotID'];

include "dbconnect.php";
?>
<style>
<?php include 'style.css';?>
</style>
<html>

<body>
<div id='content' style='text-align:left'>
     <h1>Book Appointment</h1>
     <form method="post" action="confirmation.php">
     
     Doctor: <?php echo $chosenDoctor."<br>";
     echo "Patient: ".$currentPatient."<br>";
error_reporting(E_ERROR | E_PARSE);

$sql="SELECT * FROM availableslots WHERE DoctorName = '$chosenDoctor' ";
$result=$dbcnx->query($sql);

if ($result->num_rows >0) {
     while($row=$result->fetch_assoc()) {
          echo "<input type='radio' value=".$row[SlotID]." name='chosenSlot'>";
          echo "<label> Date/Time: ". $row[SlotDate]. " ". $row[SlotTime]."</label><br>";
     }
}

else {
     echo $chosenDoctor.", you have no other available slots.";
}
    echo "<input type='text' value='$currentPatient' name = 'patient'><br><br>";
     echo"<div style='text-align:right'><input type='submit' value='Reschedule Appointment' name = 'DoctorReschedApt' id='Register' style='width:170px;'></div>";





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