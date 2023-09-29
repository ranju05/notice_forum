
<?php 
$dept='';
session_start();
if(!isset($_SESSION['dept']) &&  !isset($_SESSION['user'])){
    header("Location:index.php");
}
$dept = $_SESSION['dept'];

error_reporting(E_ERROR);
try{
	$connection = mysqli_connect('localhost','root','','notice_forum');
	$sql = "select * from notice where D_name='$dept' and Status=1 ORDER BY N_id DESC";
	$res = mysqli_query($connection,$sql);
	$data = [];
	if ($res->num_rows > 0) {
		while ($r = mysqli_fetch_assoc($res)) {
			array_push($data, $r);
		}
	}
	// print_r($data);
}catch(Exception $e){
	die('Connection Error: ' . $e->getMessage());
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="button">
        <ul>
            <li><button><a href="department.php">Home</a></button></li>
            <li><button><a href="index.php">Logout</a></button> </li>
        </ul>
    </div>
    <div class="title">
        <div class="element">
            <h1>
                <?php session_start();
                    echo $_SESSION['dept'];?>
            </h1>
            
            <h2>Dashboard</h2>
        </div>
    </div>
    <div class="body">
        
        
        <h3>Notices</h3>
        <table >
            <tr>
            <th colspan="6">
                <div class="upload">
                    <button>
                        <a href="upload_notice.php">New Upload</a>
                    </button>
                </div>
            </th>
            </tr>
            <tr>
                <th>Date</th>
                <th>Notice</th>
                <th>Topic</th>
                <th>Description</th>
                <th>Action</th>
                <th>Status</th>
            </tr>
            
            <?php foreach ($data as $key => $notice) { ?>
                <tr>
                    <td>
                        <?php echo substr($notice['N_id'], 0, 10);?>
                    </td>
                    <td><a href="uploads/<?php echo $notice['N_name'] ?>"><img src="<?php echo $notice['N_name'] ?>"></a></td>
                    <td><?php echo $notice['Topic'] ?></td>
                    <td><?php echo $notice['N_description'] ?></td>
                    <td>
                        <button onclick="confirmDelete()" id="delete" class="action"><a href="delete_notice.php?id=<?php echo $notice['N_id'] ?>">Delete</a></button>
                        <button id="update" class="action"><a href="update_notice.php?id=<?php echo $notice['N_id'] ?>">Update</a></button>
                    </td>
                    <td>
                        <?php if($notice['Status']==2){echo 'Pending';}
                        
                        else if($notice['Status']==1){echo 'Accepted';}
                        
                        else if($notice['Status']==0){echo 'Rejected';}
                        ?>

                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <script>
        function confirmDelete(){
            confirm('Are you sure you want to delete?');
        }
    </script>
    
    
</body>
</html>