<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:index.php');
}






?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notices</title>
    <link rel="stylesheet" href="css/admin_display_notice.css">
</head>
<body>
    <div class="back">
        <button><a href="admin.php">BACK</a></button>
    </div>
    <div class="header">
        <h1>Notices</h1>
    </div>
    <div class="body">
        <div class="department">
                
                    <button><a href="admin_dept_notice.php? dname=COLLEGE">COLLEGE</a></button>
                


            </div>
        <?php
        try{
            $con=mysqli_connect('localhost', 'root','','notice_forum');
            $sql="SELECT * FROM `department`";
            $res=mysqli_query($con, $sql);
            $data = [];
            if ($res->num_rows > 0) {
                while ($r = mysqli_fetch_assoc($res)) {
                    array_push($data, $r);
                }
            }
        }
        catch(Exception $e){
            die('Connection Error: ' . $e->getMessage());
        }
            foreach($data as $key => $dept){?>
            <div class="department">
                <?php if($dept['Status']==1){?>
                    <button><a href="admin_dept_notice.php? dname=<?php echo $dept['D_name'];?>"><?php echo $dept['D_name']; ?></a></button>
                <?php } ?>


            </div>
            <?php }  ?>
        
    </div>

    
    
</body>
</html>