<?php
$email = $_POST['email'];
try{
    $connect = mysqli_connect('localhost', 'root', '', 'notice_forum');
    $sql = "select * from student where S_email='$email' ";  
    $result = mysqli_query($connect, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
    
    if($count == 1){  
        echo "email already registered";
    }  
    else{  
        echo " available";  
    }
}
catch (Exception $e) {
    echo "Database Error: " . $e->getMessage();
} 



?>