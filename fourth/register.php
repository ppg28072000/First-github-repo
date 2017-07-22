<?php
$mysqli = new mysqli("localhost","root","","first");
if($mysqli->connect_error)
	die( "error:".mysql_error());
else
	echo "Connection successful.";
?>