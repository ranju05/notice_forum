<pre>
<?php 

//mysqli function, mysqli class, PDO (PHP Data Object)
error_reporting(E_ERROR);
try{
	$id = $_GET['id'];
	$connection = mysqli_connect('localhost','root','','notice_forum');
	$sql = " UPDATE notice SET Status= '0' WHERE N_id='$id' ";
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
		
		header("location:admin_dept_notice.php?dname=$dname");
	}
}catch(Exception $e){
	die('Connection Error: ' . $e->getMessage());
}

 ?>