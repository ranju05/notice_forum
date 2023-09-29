
<?php
$user='';
$uname = '';
$pw = '';
    if(isset($_POST['Login'])){
        $error=[];
        if(isset($_POST['user']) && !empty($_POST['user']) && trim($_POST['user'])){
            $user = $_POST['user'];
            if($user == "Admin"){
                if(isset($_POST['uname']) && !empty($_POST['uname']) && trim($_POST['uname'])){
        
                    if(preg_match('/^[a-zA-Z0-9\s]+$/', $_POST['uname'])){
                        
                            $uname=$_POST['uname'];
                        
                    }
                    else{
                        $error['uname']="enter valid username";
                    }
                    
                }
                else{
                    $error['uname']= "Enter username";
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
                        $error['pw'] = "Enter valid  password";
                    }
                }
                else{
                    $error['pw']="enter password";
                }
                
            }
            if($user == "Department"){
                if(isset($_POST['dept']) && !empty($_POST['dept']) && trim($_POST['dept'])){
            
                    $dept = $_POST['dept'];
                }
                else{
                    $error['dept']= "Select department";
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
                        $error['pw'] = "Enter valid  password";
                    }
                }
                else{
                    $error['pw']="enter password";
                }
            }

            if($user=="Student"){
                if(isset($_POST['dept']) && !empty($_POST['dept']) && trim($_POST['dept'])){
            
                    $dept = $_POST['dept'];
                }
                else{
                    $error['dept']= "Select department";
                }
                if(isset($_POST['uname']) && !empty($_POST['uname']) && trim($_POST['uname'])){
                
                    if(preg_match('/^[a-zA-Z0-9\s]+$/', $_POST['uname'])){
                        
                            $uname=$_POST['uname'];
                        
                    }
                    else{
                        $error['uname']="enter valid username";
                    }
                    
                }
                else{
                    $error['uname']= "Enter username";
                }
                
                if(isset($_POST['pw']) && !empty($_POST['pw'])  ){
                    $small = preg_match('/[a-z]/', $_POST['pw']);
                    $capital = preg_match('/[A-Z]/', $_POST['pw']);
                    $number = preg_match('/[0-9]/', $_POST['pw']);
                    $special = preg_match('/[\@\!\.\,\"\:\;\$\*\#\_]/', $_POST['pw']);
                    $len  = strlen($_POST['pw']);
                    if($small == 1 && $capital == 1 && $special == 1 && $number == 1 && $len>=8 && $len <=16){
                        $pw = $_POST['pw'];
                        $encryptpw = md5($pw);
                        
                        
                    }
                    else{
                        $error['pw'] = "Enter valid  password";
                    }
                }
                else{
                    $error['pw']="enter password";
                }
        
                


            }
            

            
        } else {
            $error['user']= "Select user";
        }
        
        
        
            
        if($user=="Student"){
            if(count($error)==0){
                try{
                    $connect = mysqli_connect('localhost', 'root', '', 'notice_forum');
                    
                    $sql = "select * from student where D_name= '$dept' and S_uname='$uname' and S_pw = '$encryptpw' ";  
                    $result = mysqli_query($connect, $sql);  
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    if($row['Status']==2){  
                        echo '<script> alert("Registration pending"); </script>';
                        
                        
                    }
                    else{
                        
                        $count = mysqli_num_rows($result);  
                        
                        if($count == 1){  
                            session_start();
                            $_SESSION['dept']= $dept;
                            $_SESSION['user'] = $user;
                            $_SESSION['uname']=$uname;
                            setcookie('user', $user);
                            setcookie('dept', $dept);
                            setcookie('uname', $uname);
                            header("location:department-student.php");
                            

                        }  
                        
                    }
                }
                catch (Exception $e) {
                    echo "Database Error: " . $e->getMessage();
                } 
            }
        }
        if($user=="Department"){
            if(count($error)==0){
                try{
                    $connect = mysqli_connect('localhost', 'root', '', 'notice_forum');
                    $sql = "select * from department where D_name = '$dept' and D_pw = '$pw'  ";  
                    $result = mysqli_query($connect, $sql);  
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                    
                    if($row['Status']==1){
                        $count = mysqli_num_rows($result);  
                        
                        if($count == 1){  
                            session_start();
                            $_SESSION['dept']= $dept;
                            $_SESSION['user'] = $user;
                            setcookie('user', $user);
                            setcookie('dept', $dept);
                            
                            header("Location:department.php");
                            

                        }  
                        else{  
                            echo '<script>alert("login failed")</script>';  
                        }
                    }
                    else{
                        echo "<script>alert('Registration pending');</script>";
                    }
                }
                catch (Exception $e) {
                    echo "Database Error: " . $e->getMessage();
                }
            } 
        }

        if($user=="Admin"){
            if(count($error)==0){
                
                
                try{
                    $connect = mysqli_connect('localhost', 'root', '', 'notice_forum');
                    $sql = "select * from admin where A_username = '$uname' and A_pw = '$pw'";  
                    $result = mysqli_query($connect, $sql);  
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                    $count = mysqli_num_rows($result);  
                    
                    if($count == 1){  
                        session_start();
                        $_SESSION['user'] = $user;
                        $_SESSION['uname'] = $uname;
                        setcookie('user', $user);
                        setcookie('uname', $uname);
                        header("Location:admin.php");
                        

                    }  
                    else{  
                        echo '<script>alert("login failed")</script>'; 
                    }
                }
                catch (Exception $e) {
                    echo "Database Error: " . $e->getMessage();
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
    <title>Login</title>
    <link rel="stylesheet" href="css/registration.css">
</head>
<body>
<div class="title">
    <a href="index.php" id="link" ><h1>XYZ Campus</h1></a>
    <h3>Online Notice Forum</h3>
    </div>
    <div class="block">
        <form  method="post" >
            <h2>Login</h2>
            <div class="line" id="div_user">
                <label for="user">User:</label>
                <select name="user" id="user" >
                    <option >Choose</option>
                    <option value="Student" >Student</option>
                    <option value="Department" >Department</option>
                    <option value="Admin">Admin</option>
                    
                </select>
                
                <span class="error"><?php echo isset($error['user'])? $error['user'] : ''?></span>
            </div>
            <div class="line" id="div_dept">
                <label for="dept">Department:</label>
                <select name="dept" id="dept">
                    <option value="">Select</option>
                    
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
                                <option value="<?php echo $dept['D_name'];?>"><?php echo $dept['D_name'];?></option>
                            <?php } ?>


                        </div>
                        <?php }  ?>
                
                    
                    
                    
                </select>
                <span class="error"><?php echo isset($error['dept'])? $error['dept'] : ''?></span>
                
            </div>
            <div class="line" id="div_uname">
                <label for="uname">Username:</label>
                <input type="text"  name="uname" id="uname" value="<?php echo $uname;?>">
                <span class="error"><?php echo isset($error['uname'])? $error['uname'] : ''?></span>
                
                
            </div>
            <div class="line">
                <label for="pw">Password:</label>
                <input type="password"  name="pw" id="pw">
                <span class="error"><?php echo isset($error['pw'])? $error['pw'] : ''?></span>
            </div>
            <div class="line" id="show_hide" class="show_hide">
                <input type="checkbox" onclick="show_hide()" >Show password
            </div>
            <div id="line">
            <input type="submit" name="Login"  value="Login">
            </div>
            <div class="line">
            <p >Not registered?<a href="registration.php">REGISTER HERE</a></p>
            </div>
            

        </form>
    </div>
    <script src="jquery/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#div_dept').hide();
            $('#div_uname').hide();
            $('#show_hide').hide();
            $('#user').change(function(){
                if($(this).val() == "Department"){
                    $('#div_dept').show();
                    $('#div_uname').hide();
                    $('#show_hide').show();
                   
                }
                if($(this).val() == "Student"){
                    $('#div_uname').show();
                    $('#div_dept').show();
                    $('#show_hide').show();
                }
                
                
                if($(this).val() == "Admin"){
                    $('#div_uname').show();
                    $('#div_dept').hide();
                    $('#show_hide').show();
                }
                
                
            });

        });

        

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