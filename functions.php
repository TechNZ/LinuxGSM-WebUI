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

	if($command == "admin"){
	include("admin.php");
	};
	
	if($_POST[command] == 'console'){
	include("console_outer.php");
	};
	
	if($_POST[oldcommand] == 'console'){
	include("console_outer.php");
	};
	
	if ( $command == 'change-password' ) {
	include('password.php');
	};
	
?>


<?php
// CHANGE-PASSWORD
if ( $command == 'update-pw' ) {
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$password3 = $_POST['password3'];
	$pw1 = "{md5}".base64_encode(pack("H*", md5($password1)));
	$pw2 = "{md5}".base64_encode(pack("H*", md5($password2)));
	$pw3 = "{md5}".base64_encode(pack("H*", md5($password3)));
	if ( $pw2 == $pw3 ){
		$oldpw = $userdata['passwd'];
		if ( $oldpw == $pw1 ){
			echo "Your Password has been sucessfuly changed";
			mysqli_query($db,"UPDATE ftpuser SET passwd = '" . $pw3 . "' where userid = '" . $_SESSION['login_user'] . "'");
		}else{
			echo "ERROR: Incorrect old password";
		};	
	}else{
		echo "Your Passwords did not match. <br />";
		echo "Please try again<br />";
	}
};
?>

<?php
// ADD-USER
if ( $command == 'add-user' ) {
	if ($isadmin != 1) {
		header("Location: index.php");
	};
	$password = "{md5}".base64_encode(pack("H*", md5($_POST['password'])));
	$username = $_POST['username'];
	mysqli_query($db,"INSERT INTO ftpuser (userid, passwd) VALUES ('" . $username . "', '" . $password . "')");
	mysqli_query($db,"CREATE TABLE servers_" . $username . " LIKE servers_default");
	mysqli_query($db,"INSERT servers_" . $username . " SELECT * FROM servers_default");
	echo "Added " . $username . " to the database";
};
?>

<?php
// SET-PASSWORD
if ( $command == 'set-password' ) {
	if ($isadmin != 1) {
		header("Location: index.php");
	};
	$password = "{md5}".base64_encode(pack("H*", md5($_POST['password'])));
	$username = $_POST['username'];
	mysqli_query($db,"UPDATE ftpuser SET passwd = '" . $password . "' where userid = '" . $username . "'");
	echo "Updated the password for user: " . $username;
};
?>

<?php
// ADD-SERVER
if ( $command == 'add-server' ) {
	if ($isadmin != 1) {
		header("Location: index.php");
	};
	$servername = $_POST['servername'];
	$serverfolder = $_POST['serverfolder'];
	mysqli_query($db,"INSERT INTO servers (servername, serverfolder) VALUES ('" . $servername . "', '" . $serverfolder . "')");
	$server_sql = mysqli_query($db,"SELECT * FROM servers WHERE serverfolder = '" . $serverfolder . "'");
	$server_row = mysqli_fetch_assoc($server_sql);
	mysqli_query($db,"INSERT INTO servers_default (id, active) VALUES ('" . $server_row["id"] . "', 0)");
	$active_users_sql = mysqli_query($db,"select * from ftpuser");
	while ($users_row = mysqli_fetch_assoc($active_users_sql)) {
		mysqli_query($db,"INSERT INTO servers_" . $users_row["userid"] . " (id, active) VALUES ('" . $server_row["id"] . "', 0)");
		//echo "added serverid " . $server_row["id"] . " into table servers_" . $users_row["userid"] . "<br />";
	};
};
?>

<?php
// DEL-SERVER
if ( $command == 'del-server' ) {
	if ($isadmin != 1) {
		header("Location: index.php");
	};
	$serverfolder = $_POST['serverfolder'];
	$server_sql = mysqli_query($db,"SELECT * FROM servers WHERE serverfolder = '" . $serverfolder . "'");
	$server_row = mysqli_fetch_assoc($server_sql);
	$active_users_sql = mysqli_query($db,"select * from ftpuser");
	mysqli_query($db,"DELETE FROM servers_default WHERE id = " . $server_row["id"] . "");
	while ($users_row = mysqli_fetch_assoc($active_users_sql)) {
		mysqli_query($db,"DELETE FROM servers_" . $users_row["userid"] . " WHERE id = " . $server_row["id"] . "");
		//echo "added serverid " . $server_row["id"] . " into table servers_" . $users_row["userid"] . "<br />";
	};
	mysqli_query($db,"DELETE FROM servers WHERE id = " . $server_row["id"] . ""); 
};
?>

<?php
// FORCE-USER
if ( $command == 'force-user' ) {
	if ($isadmin != 1) {
		header("Location: index.php");
	};
	$username = $_POST["username"];
	$_SESSION['login_user'] = $username;
	header("Location: index.php");
};
?>
