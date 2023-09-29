
<?php
    
    session_start();
    
    if(!isset($_SESSION['user'])  ){
        header('location: index.php');
    }
    
    $user=$_SESSION['user'];
    
    if($user=="Admin"){
        $dept="COLLEGE";
    }
    else{
        $dept=$_SESSION['dept'];
        
    }
    
    
    
    $topic = '';
    
    if(isset($_POST['cancel'])){
        if($user=='Admin'){
            header('location:admin.php');
        }
        if($user=="Department"){
            header('location:dashboard.php');
        }
    }
    if(isset($_POST['upload'])){
        $error=[];
        
        if(isset($_FILES['notice'])){
            $notice_name = $_FILES['notice']['name'];
            $notice_size = $_FILES['notice']['size'];
            $notice_tmp_name = $_FILES['notice']['tmp_name'];
            $notice_error = $_FILES['notice']['error'];
            
            if($notice_error===0){
                if($notice_size>10000000){
                    $error['notice']="file must be less than 10 MB";
                    
                }
                else{
                    $notice_ext = pathinfo($notice_name, PATHINFO_EXTENSION);
                    $notice_ext_lc  = strtolower($notice_ext);
                    $notice_format = array('jpg', 'jpeg', 'png');
                    if(in_array($notice_ext_lc , $notice_format)){
                        $new_notice_name = uniqid() . '.'. $notice_ext_lc;
                        $new_path = 'uploads/'. $new_notice_name;
                        move_uploaded_file($notice_tmp_name, $new_path); 
                    

                    }
                    else{
                        $error['notice']="invalid file type (must be jpg/png/jpeg)";
                    }
                }

            }
            
        
        else{
            $error['notice']="choose file";
        }
        if(isset($_POST['topic']) && !empty($_POST['topic']) && trim($_POST['topic'])){
            $topic = $_POST['topic'];
        }
        else{
            $error['topic']="select topic of the notice";
        }
        
        if(isset($_POST['description']) && !empty($_POST['description']) && trim($_POST['description'])){
            $description = $_POST['description'];
        }
        else{
            $error['description']="write description about the notice";
        }
        
        

        if(count($error)==0){
            if($user=="Department"){
                try{
                    
                    $connection = mysqli_connect('localhost', 'root', '', 'notice_forum');
                    
                    $sql = "INSERT INTO `notice`( `N_name`, `Topic`, `N_description`, `D_name`) VALUES ('$new_notice_name','$topic','$description','$dept' )";

                    
                    mysqli_query($connection, $sql);
                    if(mysqli_affected_rows($connection)==1){
                        
                        echo '<script> alert("uploaded successfully"); </script>';
                        
                    }
                    else{
                        echo '<script> alert("failed"); </script>';
                    }

                }
                catch(Exception $e){
                    die("connection error". $e-> getMessage());
                }
            }
        
        if($user=="Admin"){
            try{
                
                $connection = mysqli_connect('localhost', 'root', '', 'notice_forum');
                
                $sql = "INSERT INTO `notice`( `N_name`, `Topic`, `N_description`, `D_name`, `Status`) VALUES ('$new_notice_name','$topic','$description','$dept', '1' ) ";

                
                mysqli_query($connection, $sql);
                
                if(mysqli_affected_rows($connection)==1){
                    
                    echo '<script> alert("uploaded successfully"); </script>';
                    
                    
                }
                else{
                    echo '<script> alert("failed"); </script>';
                }

            }
            catch(Exception $e){
                die("connection error". $e-> getMessage());
            }
        }
    }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload</title>
    <link rel="stylesheet" href="css/update_profile.css" >
    
</head>
<body>
    <div class="body">
        
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <div class="line">  
                <label for="notice">Notice:</label>
                <input type="file"  name="notice" id="notice" value="<?php echo $new_notice_name; ?>" >
                <span><?php echo isset($error['notice'])?$error['notice']: '' ; ?></span>
            </div> 
            
            
            <div class="line">  
                <label for="topic">Topic:</label>
                <select name="topic" id="topic">
                    <option value="">Select</option>
                    <option value="Admission">Admission</option>
                    <option value="Exam">Exam</option>
                    <option value="Hostel">Hostel</option>
                    <option value="Sports">Sports</option>
                    <option value="Holiday">Holiday</option>
                </select>
                <span><?php echo isset($error['topic'])?$error['topic']: '' ; ?></span>
            </div> 
            <div class="line">
                <label for="description">Description:</label>
                <textarea name="description" id="description"  rows="8" cols="30" ></textarea>
                <span><?php echo isset($error['description'])? $error['description'] : ''; ?></span>
            </div>

            <div class="line-up">
                <input type="submit" name="upload" id ="upload" value="Upload">
                <input type="submit" name="cancel" id ="cancel" value="Cancel">
            </div>
    
        </form>
            
        

        
    </div>
    
    
    
    
</body>
</html>