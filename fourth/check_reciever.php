<?php
$mysqli = new mysqli("localhost","root","","first");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$u=$_GET["to"];
$get="select * from user_record where Username='$u'" or die(mysql_error());
$result=$mysqli->query($get) or die(mysqli_error());
if($result->num_rows>0)
{
	echo "found";//found user
}
else
{
	echo "not found";//not found
}
?>