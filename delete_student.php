<pre>
<?php 
 	if(!isset($_SESSION['user'])){
	header('location:index.php');
 	}
	
	
	try{
	$id = $_GET['id'];
    echo $id;
	$connection = mysqli_connect('localhost','root','','notice_forum');
	$sql = "delete from student where S_id='$id' ";
	print_r($connection);
	mysqli_query($connection,$sql);
		if ($connection->affected_rows > 0) {
			echo  '<script>alert("Deleted successfully");</script>';
			
			
				header('location:user.php');
			
           
		}
	}
	catch(Exception $e){
	die('Connection Error: ' . $e->getMessage());
	}

 ?>