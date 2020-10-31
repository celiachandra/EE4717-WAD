<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

$oldAppointment = $_SESSION['appointment_to_change'];


if (isset($_POST['patient'])){
    $currentPatient = $_POST['patient'];
}
else{$currentPatient = $_SESSION['valid_user'];
}
$chosenSlot = $_POST['chosenSlot'];

echo $chosenSlot;
echo $currentPatient;
echo $oldAppointment;

include "dbconnect.php";

$sql = "SELECT * FROM availableslots WHERE SlotID= $chosenSlot;";
$result = $dbcnx->query($sql);
if ($result->num_rows >0){
    $row = $result->fetch_assoc();
    $chosenDate = $row['SlotDate'];
    $chosenTime = $row['SlotTime'];
    $chosenDoctor = $row['DoctorName'];
    echo "Date/Time: " . $row[SlotDate]. " " . $row[SlotTime]."<br>";     

}

if (isset($_POST['bookApt'])){
     $sql = "INSERT INTO appointments VALUES (NULL,'$chosenDoctor','$currentPatient','$chosenDate','$chosenTime');";
     $result = $dbcnx->query($sql);
     $sql = "DELETE FROM availableslots WHERE SlotID = $chosenSlot;";
     $result = $dbcnx->query($sql); 
     echo "You have successfully booked your appointment";
     echo "<a href='index.php'>Back to main page</a>";
}

if (isset($_POST['reschedApt'])|| isset($_POST['DoctorReschedApt'])){
    $sql ="SELECT * FROM appointments WHERE AppointmentID = $oldAppointment;";
    $result = $dbcnx->query($sql); 
    if ($result->num_rows >0){
        $row = $result->fetch_assoc();
        $oldID = $row['AppointmentID'];
        $oldDr = $row['Doctor'];
        $oldPt = $row['Patient'];
        $oldDt = $row['AptDate'];
        $oldTm = $row['AptTime'];
    }

    $sql = "INSERT INTO `availableslots` (`SlotID`, `DoctorID`, `DoctorName`, `SlotDate`, `SlotTime`) VALUES 
(NULL, NULL, '$oldDr', '$oldDt', '$oldTm');";
    $result = $dbcnx->query($sql);
    $sql = "DELETE FROM appointments WHERE AppointmentID = $oldAppointment;";
    $result = $dbcnx->query($sql); 
    $sql = "INSERT INTO appointments VALUES (NULL,'$chosenDoctor','$currentPatient','$chosenDate','$chosenTime');";
    $result = $dbcnx->query($sql);
    $sql = "DELETE FROM availableslots WHERE SlotID = $chosenSlot;";
    $result = $dbcnx->query($sql); 
    

    echo "You have successfully rescheduled your appointment";
    echo "<a href='index.php'>Back to main page</a>";
}


?>

