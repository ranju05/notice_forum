<?php 

error_reporting(E_ERROR);
try{
	$id = $_GET['id'];
	$connection = mysqli_connect('localhost','root','','notice_forum');
	$sql = " UPDATE department SET Status= '0' WHERE D_id='$id' ";
	print_r($connection);
	mysqli_query($connection,$sql);
	if ($connection->affected_rows > 0) {
		echo "<script>alert('Rejected');</script> ";
		header('location:user.php');
	}
}catch(Exception $e){
	die('Connection Error: ' . $e->getMessage());
}

 ?>