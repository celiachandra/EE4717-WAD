<?php
include "nav.php";

if (!isset($_SESSION['valid_user']))
{
echo '<p>Please login to book appointment</p>';
}

?>
<html>
<body>
<form method="post" action="appointment.php">
<input type="submit" value="Dr1" name = 'doctor'>
<input type="submit" value="dr2" name = 'doctor'>
<input type="submit" value="dr3" name = 'doctor'>
</form>
</body>
</html>