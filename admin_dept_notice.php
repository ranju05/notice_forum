<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location:index.php");
    }
    
    $dname = $_GET['dname'];
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice</title>
    <link rel="stylesheet" href="css/notice.css">
</head>
<body>
    <div class="head_bar">
        <div class="page">
        <button><a href="admin_display_notice.php">Back</a></button>
            <button><a href="admin.php">Dashboard</a></button>
        </div>
        <div class="title">
            <h2><?php echo $dname;?></h2>
            <h1>Notice</h1>
        </div>
        
    </div>
    
    <div class="notice_body">
        <section id="Department">
            <div class="section">
                <div class="body">
                    <table >
                    
                        <tr>
                            
                            <th>Date</th>
                            <th>Notice</th>
                            <th>Topic</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    
                        <?php 
                             try{
                                $connection = mysqli_connect('localhost','root','','notice_forum');
                                $sql = "select * from notice where D_name='$dname' ORDER BY N_id DESC";
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
                            foreach ($data as $key => $notice) { ?>
                            <tr>
                                <td>
                                    <?php echo substr($notice['N_id'], 0, 10);?>
                                </td>
                            
                                <td><a href="uploads/<?php echo $notice['N_name'] ?>"><img src="<?php echo $notice['N_name'] ?>"></a></td>
                                
                                <td><?php echo $notice['Topic'] ?></td>
                                <td><?php echo $notice['N_description'] ?></td>
                                <td>
                                    <?php if($notice['Status']==2){echo 'Pending';}
                                    
                                    else if($notice['Status']==1){echo 'Accepted';}
                                    
                                    else if($notice['Status']==0){echo 'Rejected';}
                                    ?>

                                </td>
                                <td>
                                    <button style="background-color:red" onclick="confirmDelete()" ><a href="delete_notice.php?id=<?php echo $notice['N_id'] ?>">Delete</a></button>
                                    <button style="background-color:blue"><a href="update_notice.php?id=<?php echo $notice['N_id'] ?>">Update</a></button>
                                    <button style="background-color:green"><a href="accept_notice.php?id=<?php echo $notice['N_id'] ?>">Accept</a></button>
                                    <button style="background-color:yellow" onclick="confirmReject()"><a href="reject_notice.php?id=<?php echo $notice['N_id'] ?>">Reject</a></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                    
            </div>
        </section>
        
                      
                    
        
        
    </div>
    <script>
        function confirmDelete(){
            confirm('Are you sure you want to delete?');
        }
        function confirmReject(){
            confirm('Are you sure you want to reject?');
        }
    </script>
</body>
</html>