<?php
require "welcome.inc.php";

if(!isset($_SESSION['Username']))
{die(header("Location:entry_login.php"));}
?>

<!DOCTYPE html>
<html>
	<head>
		<link href="messages.css" rel="stylesheet" type="text/css" />
		<style>
		textarea {
			resize:none;
			width:200px;
			height:40px;
			border-radius:20px;
			padding:10px;
		}
		</style>
		<script >
			function list(){
				var req = new XMLHttpRequest();
				req.onreadystatechange = function() {
					if( this.readyState==4 && this.status==200)
					{
						document.getElementById('list').innerHTML=this.responseText;
					}
				};
				req.open("GET","list.php?p=" + Math.random() ,true);
				req.send();
			};
	
			</script >
	</head>
	<body>
		<div id="master">
		<div id='bar'>
			<button id="welcome" onclick="location.href='welcome.php'">Notes </button>
			 <button  onclick="<?php $_SESSION['comment']=$FirstName;?>location.href='logout.php'">LOG OUT</button>
		</div>
			<div id="header">
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbspHi <?php echo $FirstName;?> .<br>
				Go Ahead and reach out to yout friends.
			</div>
			
			<div id="space">
				<div id='chatbox'>
				<div id='chat'>
				</div>
				</div>
				
				<div id='msg'>
					<h4>Send a message</h4> 
					<span id='one'>To:&nbsp&nbsp&nbsp <input type="text" id="reciever"  placeholder='enter the id of ur friend' ><br>
					
									<textarea width="200"  id='txtmsg' ></textarea><br>
									
									<div id='err'></div>
					
					<button  onclick="check()" id='send' >></button></span>
					
					
				</div>
			</div>
			<h3>User Record</h3>
			<div id='list'>
				<script > 
					setInterval(list(),1000);
				</script>
			</div>
			
		</div>
		
		<script type="text/javascript" >
		Name();
		var UserName;
		
		function Name(){
			var getName = new XMLHttpRequest();
			getName.onreadystatechange = function(){
				if(this.readyState==4 && this.status==200)
				{
					 UserName=this.responseText;
					console.log( UserName );
				};
			}
				getName.open("GET","name.php" ,true);
				getName.send();
		}
		var found;
		function check(){
			if(document.getElementById('reciever').value == UserName)
			{
				document.getElementById('err').innerHTML='You don\'t need uss if you like to talk to yourself';
				document.getElementById('reciever').value='';
			}
			else if((document.getElementById('reciever').value != UserName))
			{
				if(document.getElementById('reciever').value!='' && document.getElementById('txtmsg').value!='')
				{
					var other=document.getElementById('reciever').value;
					var cross= new XMLHttpRequest();
					cross.onreadystatechange = function(){
						if(this.readyState==4 && this.status==200)
						{
							if(this.responseText=='found')
							{
									console.log('found');//found user
									send();
									show();
									found='yes'
							}
							else if(this.responseText=='not found')
							{
								console.log('not found');//not in the list
								document.getElementById('err').innerHTML='no such user exists';
								document.getElementById('reciever').value='';
								found='no';
							}	
						}
					}
					cross.open("GET","check_reciever.php?to=" + other,true);
					cross.send();
				}
			}
		}
		
		function send(){
			console.log('sending');
			var msg=new XMLHttpRequest();
			var textmsg=document.getElementById('txtmsg').value;
			var to=document.getElementById('reciever').value;
			console.log(textmsg+to+UserName);
			msg.onreadystatechange=function(){
				if(this.readystate==4 && this.status==200)
				{
					show();
					document.getElementById('err').innerHTML=this.responseText;//update messgage section
					console.log('sent');
					document.getElementById('reciever').value='';
					document.getElementById('txtmsg').value='';
					document.getElementById('err').innerHTML='';
				}
			}
			msg.open('GET','send.php?from='+UserName + '&text=' + textmsg +'&to=' + to,true); //perform request for sendng messgae
				msg.send();
		}
		show();
		function show(){
			// if(found=='yes')
				console.log(this.readystate);
				var towards='lakshya';
				var see=new XMLHttpRequest();
				console.log(this.readystate);
				see.onreadystatechange=function(){
					if(this.readystate==4 && this.status==200)
					{
						console.log(this.readystate);
						document.getElementById('chat').innerHTML=this.responseText;
						console.log('sh');
					}
				};
				console.log(towards);
			see.open('GET','show.php?to='+ towards + '&from=' + UserName,true);
				see.send();
			
			console.log(this.readystate);
			console.log(this.responseText);
		}
		</script>		
	</body>
</html>