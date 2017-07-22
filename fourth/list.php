<?php



$mysqli = new mysqli("localhost","root","","first");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$get="select FirstName,LastName,Username from user_record  where 1" or die(mysqli_error());
$get_check=$mysqli->query($get);
if($mysqli->query($get) or die("opps".mysqli_error()))
{
	echo "<table id='userlist'>";
	// echo "<tr colspan='2' ><h4>registered Users</h4></tr>";
	echo "<tr><th> Name </th><th> id </th></tr>";
	while($row = $get_check->fetch_assoc())
	{
		echo "<tr><td> $row[FirstName] $row[LastName]</td> <td > $row[Username]</td></tr> ";
	}
	echo "</table>";
}

?>