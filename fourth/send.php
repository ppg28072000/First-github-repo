<?php 
$mysqli = new mysqli("localhost","root","","first");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

 $from =$_GET['from'];
 $text =$_GET['text'];
 $to =$_GET['to'];
 $msg="insert into msg (sender,message,reciever) values('$from','$text','$to')" or die(mysql_error());
 $result=$mysqli->query($msg) or die(mysql_error());
 echo 'sent';
?>