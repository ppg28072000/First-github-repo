<?php
session_start();
if(isset($_SESSION['Username']))
{
	die(header('Location:welcome.php'));
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="entrystyle.css" rel="stylesheet" type="text/css">
<style>
#log {
	font-size:20px;
}
#header {
	background-image:url(background2.jpg);
	background-size:620px 400px;
}
#ERR {
	position:absolute;
	bottom:40px;
	right:210px;
	z-index:2;
	color:red;
	font-size:20px;
	width:200px;
}
#header h1{
	left:29%;
}
</style>
</head>
<body>
<div id="header">
	<h1>Welcome Back User</h1>
	<div id="ERR"></div>
	<div id="tabs">
		<a href="entry_registration.php"><div id="reg">SIGNUP</div></a>
		<a href="entry_login.php"><div id="log" ><strong>LOGIN</strong></div></a>
	</div>
	<form method="post" id="logfields" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?> ">
	<span id="ERRusernamelog">*</span><div id="threeandhalf"><strong> Username:</strong><input type="text" name='Username' onkeyup="check();" placeholder="--#--"><br></div>
	
	<span id="ERRpasswordlog"></span><div id="third"> &nbsp&nbsp&nbsp&nbsp <strong>Password:</strong><input type="password" name='PASSWORD' placeholder="--#--"></div>
	<div id="submitlog"><input type="submit" name="LOGIN" value="Log In">
	<div id="newuser"><a href="entry_registration.php">New User?-Register Now.</a></div>
	</form>
</div>
<?php
$mysqli = new mysqli("localhost","root","","first");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
else
{
	// echo "successful";
}
$Username_l='';$PASSWORD_l='';
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(empty($_POST["Username"]) || empty($_POST["PASSWORD"]))
	{
		?><script type="text/javascript">document.getElementById("ERR").innerHTML="*Both fields are required*";
			document.getElementById("threeandhalf").style.color="rgb(255,0,0)";
			document.getElementById("third").style.color="rgb(255,0,0)";</script><?php
	}
	else
	{
		$Username_l=$_POST["Username"];
		
			 $check = "SELECT * FROM user_record WHERE Username='$Username_l'";
			$check_result= $mysqli->query($check) or die(mysql_error());
			if($check_result->num_rows > 0)
				{
					?><script type="text/javascript">document.getElementById("ERRusernamelog").innerHTML="*profile found*";</script><?php
					$PASSWORD_l=md5($_POST["PASSWORD"]);
					$check = "SELECT * FROM user_record WHERE Username='$Username_l' AND PASSWORD='$PASSWORD_l'";
					$check_result=$mysqli->query($check) or die(mysql_error());
					if($check_result->num_rows ==0)
						{
							?><script type="text/javascript">document.getElementById("ERRpasswordlog").innerHTML="*incorrect password*";</script><?php
						}
					else
					{
						$_SESSION["Username"]=$Username_l;
						header("Location:welcome.php");
					}
				}
			else
			{
				?><?php
			}

	}
}



?>
<script>

</script>
</body>
</html>