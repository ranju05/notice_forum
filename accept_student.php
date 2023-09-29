
<?php 

    try{
        $id = $_GET['id'];
        
        $connection = mysqli_connect('localhost','root','','notice_forum');
        $sql = "UPDATE `student` SET `Status`=1 WHERE 	`S_id`='$id' ";
        
        mysqli_query($connection,$sql);
        if ($connection->affected_rows > 0) {
            echo '<script> alert(Accepted); </script>';
            header('location:user.php');
        }
        else{
            echo '<script> alert(Already accepted); </script>';
            header('location:user.php');
        }
    }catch(Exception $e){
        die('Connection Error: ' . $e->getMessage());
    }
    




 ?>