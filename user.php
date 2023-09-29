<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:index.php");
    }
    $user = $_SESSION['user'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice</title>
    <link rel="stylesheet" href="css/user.css">
</head>
<body>
    
    <div class="head_bar">
        <div class="page">
            <button><a href="admin.php">Dashboard</a></button>
        </div>
        <div class="title">
            <h1>User</h1>
        </div>
        <div id="nav">
            <div id="menu">
                <ul>
                    <li ><a href="#student" class="item">Student</a></li>
                    <li><a href="#department" class="item">Department</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="user_body">
        <section id="student">
            <div class="section">
                <div class="body">
                    <table >
                    
                        <tr>
                            
                            <th>Name</th>
                            <th>Id-card</th>
                            <th>Department</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    
                        <?php 
                             try{
                                $connection = mysqli_connect('localhost','root','','notice_forum');
                                $sql = "select * from student ";
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
                            foreach ($data as $key => $student) { ?>
                            <tr>
                                <td><?php echo $student['S_name']; ?> </td>
                                <td><a href="suploads/<?php echo $student['S_identity'] ?>"><img src="<?php echo $student['S_identity'] ?>"></a></td>
                                <td><?php echo $student['D_name']; ?> </td>
                                <td><?php echo $student['S_email']; ?> </td>
                                <td>
                                    <?php if($student['Status']==NULL){echo 'Pending';}
                                    
                                    else if($student['Status']==1){echo 'Accepted';}
                                    
                                    else if($student['Status']==0){echo 'Rejected';}
                                    ?>

                                </td>
                            
                                <td>
                                    <button style="background-color:red" onclick="confirmDelete()" ><a href="delete_student.php?id=<?php echo $student['S_id'] ?>">Delete</a></button>
                                    <button style="background-color:green"><a href="accept_student.php?id=<?php echo $student['S_id'] ?>">Accept</a></button>
                                    <button style="background-color:yellow" onclick="confirmReject()"><a href="reject_student.php?id=<?php echo $student['S_id'] ?>">Reject</a></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                    
            </div>
        </section>
        

        <section id="department">
            <div class="section">
                <div class="body">
                    <table >
                    
                        <tr>
                            
                            <th>Name</th>
                            <th>I-card</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    
                        <?php 
                             try{
                                $connection = mysqli_connect('localhost','root','','notice_forum');
                                $sql = "select * from department ";
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
                            foreach ($data as $key => $department) { ?>
                            <tr>
                                <td><?php echo $department['D_name']; ?> </td>
                                <td><a href="suploads/<?php echo $department['D_identity'] ?>"><img src="<?php echo $department['D_identity'] ?>"></a></td>
                                <!--<td>
                                    <?php echo substr($department['D_id'], 0, 10);?>
                                </td>
                            -->
                                <td><?php echo $department['D_email']; ?> </td>
                                <td>
                                    <?php if($department['Status']==2){echo 'Pending';}
                                    
                                    else if($department['Status']==1){echo 'Accepted';}
                                    
                                    else if($department['Status']==0){echo 'Rejected';}
                                    ?>

                                </td>
                            
                                <td>
                                    <button style="background-color:red" onclick="confirmDelete()" ><a href="delete_department.php?id=<?php echo $department['D_id'] ?>">Delete</a></button>
                                    <button style="background-color:green"><a href="accept_department.php?id=<?php echo $department['D_id'] ?>">Accept</a></button>
                                    <button style="background-color:yellow" onclick="confirmReject()"><a href="reject_department.php?id=<?php echo $department['D_id'] ?>">Reject</a></button>
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