<?php
   include('config.php');
   session_start();
   $user_check = $_SESSION['login_user'];
   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['username'];
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   };
   $command = $_POST["command"];
?>

<?php
	if ($isadmin != 1) {
		header("Location: index.php");
	};
?>

<?php
	if($command == "return"){
	header("Location: index.php");
	};
?>



<div style="width: 620px; height: 500px; border: none; float: 50%; ">
	<div style="width:300px; border: solid 1px #333333; float: left; background-color:#FFFFFF; ">
		<div style="background-color:#333333; color:#FFFFFF; padding:3px;"><b>Add User</b></div>
		<div style="margin:30px">
			<form action="" method="post">
				<label>UserName  :</label><input type="text" name="username" class="box"/><br /><br />
				<label>Password  :</label><input type="password" name="password" class="box" /><br/><br />
				<button type='sumbit' name='command' value='add-user' id='sidebar-button'>ADD USER</button>
			</form>
			<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
		</div>
	</div>
	<div style="width:300px; border: solid 1px #333333; float: right; background-color:#FFFFFF; ">
		<div style="background-color:#333333; color:#FFFFFF; padding:3px;"><b>Set Password</b></div>
		<div style="margin:30px; ">
			<form action="" method="post">
				<label>UserName  :</label><input type="text" name="username" class="box"/><br /><br />
				<label>Password  :</label><input type="password" name="password" class="box" /><br/><br />
				<button type='sumbit' name='command' value='set-password' id='sidebar-button'>SET PASS</button>
			</form>
			<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
		</div>
	</div>
	<div style="width:618px; border: solid 1px #333333;">
		<div style="background-color:#333333; color:#FFFFFF; padding:3px;"><b>Add Server</b></div>
		<div style="margin:30px">
			<form action="" method="post">
				<label>Server Name  :</label><input type="text" name="servername" class="box" size="60"/><br /><br />
				<label>Server Folder  :</label><input type="text" name="serverfolder" class="box" size="60"/><br/><br />
				<button type='sumbit' name='command' value='add-server' id='sidebar-button'>ADD</button>
			</form>
			<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
		</div>
	</div>
	<div style="width:618px; border: solid 1px #333333;">
		<div style="background-color:#333333; color:#FFFFFF; padding:3px;"><b>Delete Server</b></div>
		<div style="margin:30px">
			<form action="" method="post">
				<label>Server Folder  :</label><input type="text" name="serverfolder" class="box" size="60"/><br/><br />
				<button type='sumbit' name='command' value='del-server' id='sidebar-button'>DELETE</button>
			</form>
			<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
		</div>
	</div>
</div>
