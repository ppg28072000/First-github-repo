<?php
session_start();
$NameERR="";$UserNameERR="";$PASSWORD_ERR="";$MATCH_ERR="";
if(isset($_SESSION['Username']))
{
	header('Location:welcome.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="entrystyle.css" rel="stylesheet" type="text/css">

<style>
#header #reg {
	font-size:18px; 
	right:80px;
}
#header {
	background-image:url(background.jpg);
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
	left:30%;
}
</style>
</head>
<body>

<div id="header">
	<h1>Welcome User</h1>
	<div id="ERR"></div>
	<div id="tabs">
		<a href="entry_registration.php"><div id="reg"><strong>SIGNUP</strong></div></a>
		<a href="entry_login.php"><div id="log" >LOGIN</div></a>
	</div>
	<form method="post" id="regfields" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
		<span id="ERRname"></span><div id="first"><strong>First Name:</strong><input type="text" name="FirstName"   ><strong> Last Name:</strong><input type="text" name="LastName" ></div><br>
		<span id="ERRusername"></span><div id="second"><strong>Username:</strong><input type="text" name='Username' placeholder="no $pecial characters"></div><br>
		<hr>
		<div id="threeandhalf"><strong>Gender:</strong> &nbsp <input type="radio" name="Gender" value="Female">Female &nbsp
		<input type="radio" name="Gender" value="Male" >Male <br>
		<input type="radio" name="Gender" value="Other">Other</div> 
		<div id="third"><strong>Password:</strong><input type="password" name='PASSWORD' placeholder="min characters -6" onkeyup="check()"></div><br>
		
		<span id="ERRpassword"></span><div id="fourth"><strong>Confirm Password:</strong><input type="password" name='re-pass' placeholder="Enter the password again" onkeyup="check()"></div><br>
		<script type="text/javascript">document.getElementById("fourth").style.display="none";</script>
		
		
		<div id="submitreg"><input type="submit" value="Submit"></div>
	</form>
	
</div>
	<script>
	function check(){
		
		{
			if((document.forms[0].elements["PASSWORD"].value).length <6)
			{
				document.getElementById("ERRpassword").innerHTML="*PASSWORD must be of at least 6 characters*";
				document.getElementById("third").style.color="rgb(255,0,0)";
			}
			else
			{	
				document.getElementById("third").style.color="rgb(9,99,30)";
				document.getElementById("fourth").style.display="block";
				document.getElementById("ERRpassword").innerHTML="";
				if(document.forms[0].elements["PASSWORD"].value != document.forms[0].elements["re-pass"].value)
				 {		
						if((document.forms[0].elements["re-pass"].value).length >0)
						{document.getElementById("ERRpassword").innerHTML="*Passwords dont match*";}
						document.getElementById("fourth").style.color='rgb(255,0,0)';
				 }
				 else 
				 {
					 document.getElementById("fourth").style.color='rgb(9, 99, 30)';
					 document.getElementById("ERRpassword").innerHTML="*Passwords matched*";
				 }
			}
		
				 
		}
	}
	
	</script>
<?php
$mysqli = new mysqli("localhost","root","","first");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
else
{
	// echo "successful";
}
$select ="SELECT * FROM user_record WHERE 1";
if(($mysqli->query($select)))
{}
else echo"fail";
$NameERR="";$UserNameERR="";$PASSWORD_ERR="";$MATCH_ERR="";
$FirstName=$LastName=$Username=$PASSWORD=$Gender="";
$FirstName_t=$LastName_t=$Username_t=$PASSWORD_t=$Gender_t="";
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if(empty($_POST["FirstName"]) || empty($_POST["LastName"]) )
		{
			?><script type="text/javascript">document.getElementById("first").style.color="rgb(255,0,0)";
			document.getElementById("ERR").innerHTML="*All fields REQUIRED!!"</script><?php
		}
		else 
		{
			$FirstName=ucfirst(check_input($_POST["FirstName"]));
			$LastName=ucfirst(check_input($_POST["LastName"]));
			{
				if (!preg_match("/^[a-zA-Z ]*$/",$FirstName) || !preg_match("/^[a-zA-Z ]*$/",$LastName))
				 { 
						?><script type="text/javascript">document.getElementById("ERRname").innerHTML="*use only alphabets*";
						document.getElementById("first").style.color="rgb(0,0,255)";</script><?php 
				  }
				else
				{
					$FirstName_t=$FirstName;
					$LastName_t=$LastName;//enter to table
				}
			}
					
			
		}
	if(empty($_POST['Username']))
		{
			?><script type="text/javascript">document.getElementById("second").style.color="rgb(255,0,0)";
				document.getElementById("ERR").innerHTML="*All fields REQUIRED!!";</script><?php
		}
		else
		{
			$Username=$_POST["Username"];
			{
				if(!preg_match("/^[a-zA-Z0-9]*$/",$Username))
					{
						?><script type="text/javascript">
						document.getElementById("ERRusername").innerHTML="*special characters not allowed*";</script><?php 
					}
				else
					{
						$Username_t=$Username;//to table
					}
		
			}
		}
	if(empty($_POST['Gender']))
		{
			?><script type="text/javascript">
			document.getElementById("threeandhalf").style.color="rgb(255,0,0)";
			document.getElementById("ERR").innerHTML="*All fields REQUIRED!!";
			document.getElementById("third").style.color="rgb(255,0,0)";
			
			</script><?php
		}
		else
		{
		if(($_POST['PASSWORD']===$_POST['re-pass']) && (strlen($_POST['PASSWORD'])>=6))
				{
					$Gender=check_input($_POST["Gender"]);
					$Gender_t=$Gender;//to table
				}
		}
	if(empty($_POST['PASSWORD']) || empty($_POST['re-pass']))
		{
			?><script type="text/javascript">
			document.getElementById('third').style.color='rgb(255,0,0)';
			document.getElementById('fourth').style.color='rgb(255,0,0)';
			</script><?php
			
		}
		else
		{if($_POST['PASSWORD']!=$_POST['re-pass'])
			{
				?><script type="text/javascript">
					document.getElementById('ERRpassword').innerHTML='*passwords don\'t match*';
					document.getElementById('third').style.color='rgb(255,0,0)';
			document.getElementById('fourth').style.color='rgb(255,0,0)';
				</script>
				<?php
			}
			$PASSWORD_t=md5($_POST["PASSWORD"]);
		}
	
	if(($FirstName_t !="") && ($LastName_t!="") && ($Gender_t!="") && ($Username_t!="") && ($PASSWORD_t!="") )
	{	
		
		$check = "SELECT * FROM user_record WHERE FirstName ='$FirstName_t' AND LastName ='$LastName_t' AND Username='$Username_t'" or die(mysql_error());
			$check_result=$mysqli->query($check);
			if($check_result->num_rows > 0 )
			{	
						?><script type="text/javascript">document.getElementById("ERR").innerHTML="*Already registered user*";</script><?php
						
			}
			else
			{
				 // echo "yo";
						$sql="INSERT INTO user_record(FirstName,LastName,Username,Gender,PASSWORD)
						VALUES ('$FirstName_t','$LastName_t','$Username_t','$Gender_t','$PASSWORD_t')";
						if($mysqli->query($sql) === TRUE)
							{
								$_SESSION["Username"]=$Username_t;
								header("Location:welcome.php");
							}
						else 
						{
							echo "Error: " ;
						}
			}
	}
}
function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}		
// echo $FirstName_t;
// echo $LastName_t;
// echo $Gender_t;
// echo $Username_t;
// echo $PASSWORD_t;

?>
</body>
</html>
