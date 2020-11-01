<?php
	include 'nav.php';
	
	if (!isset($_SESSION['valid_user']))
{
echo '<p>Please login to book appointment</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Prime Clinic: Services</title>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet">
</head>
<body>


  <div id='content'>
	<h2>Our Services</h2>
	<table id='services'> 
		<tr style='background-color: #f5f8ff;'>
			<td><strong>Services</strong></td>
			<td><strong>Estimated Price</strong></td>
		</tr>
		<tr>
			<td rowspan='2'>General Check Up</td>
			<td>Doctor: S$90</td>
		</tr>
			<td>Senior Doctor: S$120</td>
		<tr style='background-color: #f5f8ff;'>
			<td rowspan='3'>Health Screening</td>
			<td>below 18 years old: S$1,188</td>
		</tr>
		<tr style='background-color: #f5f8ff;'>
			<td>18 - 40 years old: S$2,388</td>
		</tr>
		<tr style='background-color: #f5f8ff;'>
			<td>above 41 years old: S$3,088</td>
		</tr>
	</table> 
	<h2>Our Doctors</h2>
	<form method='post' action='appointment.php'>
	<table id='services' style='text-align:center;'>
		<tr>
			<td><img id='doctor' src='doctors1.jpg' width=90% alt='doctors1'><br>
			<br>
			<input type='submit' name='doctor' value='Dr Chloe' id='doctor1'>
			</td>
			<td style='background-color: #f5f8ff;'><img id='doctor' src='doctors2.jpg' width=90% alt='doctors2'><br>
			<br>
			<input type='submit' name='doctor' value='Dr Daniel' id='doctor2'>
			</td>
			<td><img id='doctor' src='doctors3.jpg' width=90% alt='doctors3'><br>
			<br>
			<input type='submit' name='doctor' value='Dr Jack' id='doctor3'>
			</td>
		</tr>
	</table>
	</form>
  </div>
  <footer>
	<small><i>Copyright &copy; 2017 Prime Clinic</i></small><br>
	<small><i>3360 Islington Ave, Toronto, Ontario</i></small><br>
	<small><i><a href="mailto:prime@clinic.com">prime@clinic.com</a></i></small>
	
  </footer>
</body>
</html>


