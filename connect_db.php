
//Make sure to insert your database name and localhost connection.

<?php
$mysql_host = '';
$mysql_user = '';
$mysql_pass = '';

$practise_db = '';

$mysql_con = @mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
$mysql_db = @mysqli_select_db($mysql_con, $practise_db);

if(!$mysql_con || !$mysql_db){
	die('Could Not Connect');
}
?>
