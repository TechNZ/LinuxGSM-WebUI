<?php
session_start();
$server = $_SESSION['server'];
// echo($server);
$live = shell_exec("sudo /var/www/technz.info/srv/script.sh $server live");
if($live == "") {
	$live = "     Server is not currently running";
};
echo "<pre>$live</pre>";
?>