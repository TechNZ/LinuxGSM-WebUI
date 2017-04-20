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
	if ($_POST["command"] != 'console' AND $_POST["oldcommand"] != 'console' ) {
		header("Location: index.php");
	};
	if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   };
?>

<?php

			$server_game = shell_exec("sudo /var/www/technz.info/srv/script.sh $server variable gamename");
			$server_ip = shell_exec("sudo /var/www/technz.info/srv/script.sh $server variable ip");
			$server_port = shell_exec("sudo /var/www/technz.info/srv/script.sh $server variable port");
			echo "
			
		<br />
			<div id='details'>
				Server Type is $server_game<br />
				Current IP: $server_ip<br />
				Current port: $server_port<br />
				Current port: $server_port<br />
			</div>
		<form method='post'>
			<input type='hidden' name='server' value='" . $server . "' />
			<input type='hidden' name='oldcommand' value='console' />
			<br />
				<input type='submit' name='command' value='start'/>
				<input type='submit' name='command' value='stop'/>
				<input type='submit' name='command' value='restart'/>
		 </form>
			
        <h1>Console:</h1>
        <div id='console'></div>
		<form method='post'>
			<input type='text' name='inputCommand' placeholder='Type Command' size='60'/>
			<input type='hidden' name='server' value='" . $server. "' />
			<input type='hidden' name='command' value='console' />
			<input type='submit' value='Execute' />
		</form>
		 ";

?>