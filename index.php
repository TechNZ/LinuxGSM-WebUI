<?php
   include('config.php');
   session_start();
   
   
   
   $user_check = $_SESSION['login_user'];
   
   
   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>

<?php
	session_start();
	if($_POST) {
	$command = $_POST['command'];
	$server = $_POST['server'];
	$commandString = $_POST['inputCommand'];
	};

	if($command == "logout"){
		   if(session_destroy()) {
		  header("Location: login.php");
	   }
	   };

	if($commandString != '') {
		shell_exec("sudo /var/www/technz.info/srv/script.sh $server command $commandString");
	};

	if($command == 'start' || $command == 'stop' || $command == 'restart') {
		shell_exec("sudo /var/www/technz.info/srv/script.sh $server $command");
	};

	$_SESSION['server'] = $server;

	$userquery = mysqli_query($db,"SELECT * FROM ftpuser WHERE userid = '" . $_SESSION['login_user'] . "'");
	$userdata = mysqli_fetch_array($userquery);
?>

<?php
	//ADMIN CHECK
	$admincheck_sql = mysqli_query($db,"select * from ftpgroup WHERE members = '" . $_SESSION['login_user'] . "' AND groupname = 'admin'");
	if ( mysqli_num_rows($admincheck_sql) == 1 ) {
		$isadmin = 1;
	} else {
		$isadmin = 0;
	};
?>


<html lang="en">
    <head>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load('jquery', '1.4.2'); 
            google.load('jqueryui', '1.8.8');
        </script>
        <script type="text/javascript">		
		var firstrun = true;
            $(document).ready(function() {
                $('#console').load('./console.php');
                setInterval('refresh_console()', 300);
            });
            function refresh_console()
            {
				if (firstrun){
					//$('#console').animate({ scrollTop: $($('#console').height() }, 1500);
					$('#console').scrollTop($('#console')[0].scrollHeight);
					firstrun = false;
				};
				
				//document.getElementById('testvar').innerHTML = $('#console')[0].scrollHeight - $('#console').scrollTop() <= 1100;
				var stickregion = 150
				if ( $('#console')[0].scrollHeight - $('#console').scrollTop() <= 1000 + stickregion ){
				var scrollbottom = true;
				}
				else {
                var scrollbottom = false;
				};
				
				
				
				var lastScrollPos = $('#console').scrollHeight;
				if ( scrollbottom ){
				$('#console').load('./console.php').scrollTop($('#console')[0].scrollHeight);
				}
				else {
                $('#console').load('./console.php').scrollTop($('#console').scrollHeight);
				};
            };	
        </script>
		<style type="text/css">
			#sidebar{
				text-align: center;
				width: 150px; 
				position: absolute;
				top: 0px; 
				left: 0px; 
				border: none;
				border-right: solid; 
				border-bottom: solid; 
			}
			#main{
				width: 800px; 
				position: absolute;
				margin-left: 180px; 
				border: none;
			}
			#details{
				padding: 10px;
				border: none;
			}
			#console{
				border: solid;
				height: 1000px;
				width: 850px;
				padding-left: 5px; 
				padding-top: -10px; 
				overflow-x: hidden;
				overflow-y: scroll;
			}
			button#sidebar-button{
				width:110px;
			}
		</style>
    </head>
    <body>
	
	<!-- SIDE BAR START --->
	<div id="sidebar">
		<h2>Servers:</h2>		
		<form method="post">
			<?php
			if ( $isadmin == 1 ) {
				$servers_active_sql = mysqli_query($db,"select id from servers_" . $_SESSION['login_user'] . "");
			} else {
				$servers_active_sql = mysqli_query($db,"select id from servers_" . $_SESSION['login_user'] . " where active = true");
			};			
			while ($row = mysqli_fetch_assoc($servers_active_sql)) {
				$server_details_raw = mysqli_query($db,"select * from servers where id = " . $row["id"] . "");
				while ($server_row = mysqli_fetch_assoc($server_details_raw)){
					//echo "<br />";
					echo "<form method='post'>";
					echo "<input type='hidden' name='command' value='console' />";
					echo "<button type='sumbit' name='server' value='" . $server_row["serverfolder"] . "' id='sidebar-button'>" . $server_row["servername"] . "</button>";
					echo "</form>";
					};
			};
			?>
			<br />
				<div id="logout" style="border-top: solid;">
				<br />
				<?php
				if ($isadmin == 1) {
					echo "<form method='post'>";
					echo "<button type='sumbit' name='command' value='admin' id='sidebar-button'>Admin Panel</button>";
					echo "</form>";
				};
				?>
				<form method="post">
					<button type='sumbit' name='command' value='change-password' id='sidebar-button'>CHANGE PASSWORD</button>
				</form>
				<form method="post">
					<button type='sumbit' name='command' value='logout' id='sidebar-button'>LOGOUT</button>
				</form>
				<?php
				if ( $isadmin == 1 ) {
					echo "<form method='post'>";
					echo "<label>UserName  :</label>";
					echo "<input type='text' name='username' class='box' size='11'/><br />";
					echo "<button type='sumbit' name='command' value='force-user' id='sidebar-button'>Force User</button>";
					echo "</form>";
				};
				?>
				</div>
	</div>
	
	<!-- SIDE BAR END --->
	
	
	<!-- MAIN PAGE START --->

	<div id="main">
		<?php
		if ($_SESSION['login_user'] != '') {
			include('functions.php');
		};

		?>
	</div>
	<!-- MAIN PAGE END --->
    </body>
</html>