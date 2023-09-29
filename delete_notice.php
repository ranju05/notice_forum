<pre>
<?php 
session_start();
 	if(!isset($_SESSION['user'])){
	header('location:index.php');
 	}
	$user=$_SESSION['user'];
	echo $user;
	
	try{
	$id = $_GET['id'];
	$connection = mysqli_connect('localhost','root','','notice_forum');
	$sql = "delete from notice where N_id='$id' ";
	$sql1="SELECT * FROM `notice` WHERE `N_id`='$id' "; 
	
	$res = mysqli_query($connection,$sql1);
	$data=[];
	if($res->num_rows>0){
		while ($r = mysqli_fetch_assoc($res)) {
			array_push($data, $r);
		}
		
		
	}
	
	$dname=$data[0]['D_name'];
	
	mysqli_query($connection,$sql);
		if ($connection->affected_rows > 0) {
			echo  '<script>alert("Deleted successfully");</script>';
			if($user=="Admin"){
				header("location:admin_dept_notice.php?dname=$dname");
			}
			if($user=="Department"){
				header('location:dashboard.php');
			}
			
		}
	}
	catch(Exception $e){
	die('Connection Error: ' . $e->getMessage());
	}

 ?>