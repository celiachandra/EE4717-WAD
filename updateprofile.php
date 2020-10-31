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
<html>

<body>
<?php
if (isset($_POST['update']))
{
echo "<h1>Patient Profile:".$patient."</h1>";

echo "<form action='' method='POST'>";
echo "<h2>Personal Profile:</h2>";
echo "<input type='text' placeholder='Type here' name='updateprofile'>";
echo "<h2>Medical History:</h2>";
echo "<input type='text' placeholder='Type here' name='updatemed'>";
echo "<input type='submit' value = 'Save' name='saveChanges'>";
echo "</form>";

echo "<h2>Appointments:</h2>";


}

?>
</body>


</html>