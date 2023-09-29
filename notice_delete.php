<?php 
//mysqli function, mysqli class, PDO (PHP Data Object)
error_reporting(E_ERROR);
try{
	$id = $_GET['N_id'];
	$connection = mysqli_connect('localhost','root','','notice_forum');
	$sql = "delete from notice where N_id='$id'";
	print_r($connection);
	mysqli_query($connection,$sql);
	if ($connection->affected_rows > 0) {
		echo 'Delete success';
		header('location:dashboard.php');
	}
}catch(Exception $e){
	die('Connection Error: ' . $e->getMessage());
}

 ?>