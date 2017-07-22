<?php
$mysqli = new mysqli("localhost","root","","first");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$from = $_GET['from'];
$to = $_GET['to'];
$get="select * from msg" or die('reh');
$result=$mysqli->query($get) or die("not possible");
while($row=$result->fetch_assoc())
{
	echo "$to";
   if($row['sender']=='$from' && $row['reciever']=='$to')
   {
	   echo "<div id='sentitem'>$row[message]</div>";
   }
   else  if($row['sender']=='$to' && $row['reciever']=='$from')
   {
	   echo "<div id='recieveditem'>$row[message]</div>";
   }
	
}
?>