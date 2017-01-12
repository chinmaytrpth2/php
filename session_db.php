<?php
ob_start();
session_start();
$current_file = $_SERVER['SCRIPT_NAME'];


function loggedin(){
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
		return true;
	}else{
		return false;
	}
}

function getfield($field){
	$query = "SELECT $field FROM practise.users WHERE id='".$_SESSION['user_id']."'";
	if($query_run = mysqli_query(mysqli_connect('localhost', 'root', ''), $query)){
		$query_row = mysqli_fetch_assoc($query_run);
		$user_field = $query_row[$field];
		return $user_field;
	}
}
?>


