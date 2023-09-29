<?php
    $id = $_GET['id'];
    
    session_start();
    if(!isset($_SESSION['user']) ){
        header('Location: index.php');
    }
    if(isset($_SESSION['dept'])){
        $department = $_SESSION['dept'];
    }
    
    
    $topic =$description=$new_notice_name='';
    
    
    if(isset($_POST['update'])){
        
        $err=[];
        if(isset($_POST['topic']) && !empty($_POST['topic']) && trim($_POST['topic'])){
             $topic = $_POST['topic'];
        }
        else{
            $err['topic']="select topic of the notice";
        }
        if(isset($_POST['description']) && !empty($_POST['description']) && trim($_POST['description'])){
            $description = $_POST['description'];
        }
        else{
            $err['description']="write description";
        }
        if(isset($_FILES['notice'])){
            $notice_name = $_FILES['notice']['name'];
            $notice_size = $_FILES['notice']['size'];
            $notice_tmp_name = $_FILES['notice']['tmp_name'];
            $error = $_FILES['notice']['error'];

            if($error==0){
                if($notice_size>10000000){
                    $err['notice']="file must be less than 10 MB";
                    
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
                        $err['notice']="invalid file type (must be jpg/png/jpeg)";
                    }
                }
            }
            else{
                $err['notice']="Select file";
            }

            if(count($err)==0){
                try{
                    
                    $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
                    $sql = "UPDATE `notice` SET `N_name`='$new_notice_name',`Topic`='$topic',`N_description`='$description', `Status`=NULL WHERE N_id='$id' ";
                    mysqli_query($conn,$sql);
                    if ($conn->affected_rows > 0) {
                        if($_SESSION['user']=="Department"){
                            header('location:dashboard.php');
                        }
                        if($_SESSION['user']=="Admin"){
                            header('location:notice.php');
                        }
                    
                    }
                    $conn->close();
                }
                catch(Exception $e){
                    die('Connection Error: ' . $e->getMessage());
                }
                }

        }
        else{
            $err="unexpected error";
        }
    }

?>
<?php 
//mysqli function, mysqli class, PDO (PHP Data Object)
error_reporting(E_ERROR);
try{
	$connection = mysqli_connect('localhost','root','','notice_forum');
	$sql = "select * from notice where N_id='$id' ";
	$res = mysqli_query($connection,$sql);
	if ($res->num_rows > 0) {
		$record = mysqli_fetch_assoc($res);
		// print_r($record);
		// $name = $record['name'];
		extract($record);
	} 
}catch(Exception $e){
	die('Connection Error: ' . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload</title>
    <link rel="stylesheet" href="css/upload.css" >
    
</head>
<body>
    <div class="body">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
            <div class="line">  
                <label for="notice">Notice:</label>
                <input type="file" id="notice" name="notice"  >
                <span><?php echo isset($err['notice'])?$err['notice']: '' ; ?></span>
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
                <span><?php echo isset($err['topic'])?$err['topic']: '' ; ?></span>
            </div> 
            <div class="line">
                <label for="description">Description:</label>
                <input type="text" name="description" id="description">
            </div>
            <div class="line">
                <input type="submit" name="update" id ="update" value="Update">
            </div>
    
        </form>
    </div>
    <script>
        //document.getElementById('notice').value="<?php echo $record['N_name']; ?>";
        document.getElementById('topic').value="<?php echo $record['Topic']; ?>";
        document.getElementById('description').value="<?php echo $record['N_description']; ?>";
    </script>
    
</body>
</html>