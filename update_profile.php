<?php
    $id = $_GET['id'];
    
    session_start();
    if(!isset($_SESSION['user']) ){
        header('Location: index.php');
    }
    if(isset($_SESSION['dept'])){
        $department = $_SESSION['dept'];
    }
    $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
    $sql = "select * from student where S_id=$id ";
    $res = mysqli_query($conn, $sql);
    
    $student = mysqli_fetch_assoc($res);
    
    
    $name =$uname=$dept=$email=$pw=$cpw='';
    
    
    if(isset($_POST['update'])){
        
        $error=[];
        if(isset($_POST['dept']) && !empty($_POST['dept']) && trim($_POST['dept'])){
            $dept = $_POST['dept'];
        }
        else{
            $error['dept']= "Select department";
        }
        if(isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])){
            if(!preg_match('/^[A-Z][a-zA-Z\s]+$/', $_POST['name'])){
                $error['name']="Enter valid name";
            }
            $name = $_POST['name'];
        }
        else{
            $error['name']= "Enter name";
        }
    
        if(isset($_POST['uname']) && !empty($_POST['uname']) && trim($_POST['uname'])){
            if(!preg_match('/^[a-zA-Z0-9\s]+$/', $_POST['uname'])){
                $error['uname']="Enter valid username";
            }
            $uname = $_POST['uname'];
        }
        else{
            $error['uname']= "Enter uname";
        }
        if(isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])){
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $error['email']="invalid email";
            }
            $email = $_POST['email'];
        }
        else{
            $error['email']= "Enter email";
            
        }
        if(isset($_POST['pw']) && !empty($_POST['pw'])  ){
            $small = preg_match('/[a-z]/', $_POST['pw']);
            $capital = preg_match('/[A-Z]/', $_POST['pw']);
            $number = preg_match('/[0-9]/', $_POST['pw']);
            $special = preg_match('/[\@\!\.\,\"\:\;\$\*\#\_]/', $_POST['pw']);
            $len  = strlen($_POST['pw']);
            if($small == 1 && $capital == 1 && $special == 1 && $number == 1 && $len>=8 && $len <=16){
                $pw = $_POST['pw'];
            }
            else{
                $error['pw'] = "password should include at least 8 character including capital and  small letter , number, special character";
            }
         }
         else{
            $error['pw']="enter password";
         }
        if(isset($_POST['cpw']) && !empty($_POST['cpw'])  ){
            if($_POST['cpw']!=$pw){
                $error['cpw']="Password doesn't match";
            }
        }
        else{
            $error['cpw']= "Enter confirm password";
        }

            if(count($error)==0){
                try{
                    
                    $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
                    $sql = "UPDATE `student` SET `S_name`='$name',`S_uname`='$uname',`D_name`='$dept',`S_email`='$email', `S_pw`='$pw' WHERE S_id='$id' ";
                    mysqli_query($conn,$sql);
                    if ($conn->affected_rows > 0) {
                        
                            header('location:department-student.php');
                            
                    
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
    

?>
<?php 
//mysqli function, mysqli class, PDO (PHP Data Object)
error_reporting(E_ERROR);
try{
	$connection = mysqli_connect('localhost','root','','notice_forum');
	$sql = "select * from student where S_id='$id' ";
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
    <title>update</title>
    <link rel="stylesheet" href="css/update_profile.css" >
    
</head>
<body>
    <div class="back">
        <button><a href="department-student.php"><img src="icon/back.png"></a></button>
    </div> 
    <div class="body">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
           
           
            <div class="line" id="div_name">
                <label for="name">Name:</label>
                <input type="text"  name="name" id="name"  placeholder="eg. Ranju " value="<?php echo  $name;?>">
                <span class="error"><?php echo isset($error['name'])? $error['name'] : ''?></span>
                
                
            </div>
            <div class="line" id="div_uname">
                <label for="uname">Username:</label>
                <input type="text"  name="uname" id="uname"   value="<?php echo  $uname;?>">
                <span class="error" id="error_uname"><?php echo isset($error['uname'])? $error['uname'] : ''?></span>
                
                
            </div>
           
            <div class="line" id="div_dept">
                <label for="dept">Department:</label>
                <select name="dept" id="dept">
                    <option value="">Select</option>
                    <option value="BCA">BCA</option>
                    <option value="BIT">BIT</option>
                    <option value="BscCSIT">BScCSIT</option>
                </select>
                
                <span class="error"><?php echo isset($error['dept'])? $error['dept'] : ''?></span>
                
            </div>
           

           
            <div class="line">
                <label for="email">Email:</label>
                <input type="email"  name="email" id="email" >
                <span class="error"><?php echo isset($error['email'])? $error['email'] : ''?></span>
                
            </div>
            
            <div class="line">
                <label for="pw">Password:</label>
                <input type="password" class="pass" name="pw" id="pw" placeholder="should contain atleast 1 capital, small letter, number and special character">
                <span class="error"><?php echo isset($error['pw'])? $error['pw'] : ''?></span>
            </div>
            <div class="line">
                <label for="cpw">Confirm password:</label>
                <input type="password" class="pass" name="cpw" id="cpw">
                
                <span class="error"><?php echo isset($error['cpw'])? $error['cpw'] : ''?></span>
            </div>
            <div class="showpass">
                <input type="checkbox" onclick="show_hide()">Show password
            </div>
            <div class="line-up">
                <input type="submit" name="update" id ="update" value="Update">
            </div>
            
    
        </form>
    </div>
    <script>
        document.getElementById('name').value="<?php echo $student['S_name']; ?>";
        document.getElementById('uname').value="<?php echo $student['S_uname']; ?>";
        document.getElementById('dept').value="<?php echo $student['D_name']; ?>";
        document.getElementById('email').value="<?php echo $student['S_email']; ?>";
       

        function show_hide() {
            var x = document.getElementById("pw");
            
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }

            var x = document.getElementById("cpw");
            
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
        }
    </script>
    
</body>
</html>