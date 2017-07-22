<?php
session_start();
if(!isset($_SESSION['Username']))
{die(header("Location:entry_login.php"));}
?>
<!DOCTYPE html>
<html>
<head>
<style>
body{
	background-color:SteelBlue;
}
#end{
	font-size:30px;
	position:relative;
	top:100px;
	left:400px;
	border-size:5px;
	border-style:solid;
	width:500px;
}
	
</style>
</head>
<body>
<div id='end'>
<?php 
echo "You are successfully logged out. ";
echo '<br>';
echo "Thanks for visiting ".$_SESSION['comment'];
session_unset();
session_destroy();?>
<a href="entry_login.php"><div id="log" >LOGIN ?</div></a>
</div>
</body>
</html>