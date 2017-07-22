<?php
session_start();

$Username=$FirstName=$LastName=$Gender='';
$Username=$_SESSION["Username"];

$mysqli = new mysqli("localhost","root","","first");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$get="SELECT FirstName , LastName , Username , Gender  FROM user_record WHERE Username='$Username'" or die(mysqli_error());
$get_check=$mysqli->query($get);
if($mysqli->query($get) or die("opps".mysqli_error()))
{
	while($row = $get_check->fetch_assoc())
	{
		$FirstName=$row["FirstName"];$LastName=$row["LastName"];$Gender=$row["Gender"];
	}
}

?>