<?php
require "welcome.inc.php";
if(!isset($_SESSION['Username']))
{die(header("Location:entry_login.php"));}
$_SESSION["comment"]="";
?>
<!DOCTYPE html>
<html>
<head>
<link href="welcome.style.css" type="text/css" rel="stylesheet">
<script  src="jquery.js" type="text/javascript" ></script>
</head>
<body>
<div id="master">
	<div id="header">
	<div id="greet"> Welcome to this pretty plain platform.</div>
		Hi <?php echo $FirstName;?>.
	</div>
	<div id='bar'> 
			<button id='message' onclick="location.href='messages.php'">Messages</button>
			<button  onclick="<?php $_SESSION['comment']=$FirstName;?>location.href='logout.php'">LOG OUT</button>
			
		</div>
	
	<div id="space">
		
		<?php
				
				$note="SELECT * FROM note_record WHERE Username='$Username'" or die(mysqli_error());
				$note_check=$mysqli->query($note) or die(mysqli_error());
				if($note_check->num_rows == 0)
					{
						echo '<div id=\'data\'>no data!</div>';
						echo "<br>";
						
					}
				else
					{
						$rows=$note_check->num_rows;
						$i=0;
						echo "<table id='data'>";
						while($row=$note_check->fetch_assoc())
							{
									
									echo "<tr><td> $row[note]</td><td><form action='$_SERVER[PHP_SELF]' method='POST'>
										  <input type='hidden' name='note' value='$row[note]'><input id='delbutton' type='submit' name='del' value='delete'></form></td></tr>" ;
									echo "<br>";
							}	
						echo '</table>';
						
					}
			if( isset($_POST['del'])) 
			{
				$del_note=$_POST["note"];
				$delete_que="DELETE FROM note_record WHERE Username='$Username' AND note='$del_note'" or die(mysql_error());
				
				if($mysqli->query($delete_que) or die(mysql_error()))
				{
					$_SESSION['comment']="successfully deleted";
					echo $_SESSION['comment'];
					unset($_POST['del']);
					
					header("Location:welcome.php");
				}
				
				
			}
			if(isset($_POST['add']))
			{
				$note_new=htmlentities($_POST["note"]);
				$add_note="INSERT INTO note_record (Username,note) VALUES ('$Username','$note_new') " or die(mysql_error());
				if($mysqli->query($add_note))
				{
					
					$_SESSION['comment']="successfully added";
					$_GET=array();
					header("Location:welcome.php");
					
				}
			}
		?>
		
		<div id="tab"><button onclick='add()'>Add Note</button></div>
		<div id="add"><form action="<?php $_SERVER['PHP_SELF']?>" method='POST' id='add'>
		<textarea maxlength="200" height="48" name="note" placeholder="enter your note here" ></textarea>
		<input type="submit" name ='add' value="add"></form></div>
	</div>
	
</div>
<script>
// document.getElementByTagName('td:nth-child(even)').mouseover= function(){ document.getElementById('delbutton').style.backgroundColor='Green';};
document.getElementById('add').style.display='none';
function  add(){
	document.getElementById('add').style.display='block';
	document.getElementById('tab').style.display='none';
}
</script>
</body>
</html>