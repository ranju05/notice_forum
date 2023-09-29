<?php
$user = $id = $name = $uname = $email =$id= $pw = $cpw=$encryptpw='';


if(isset($_POST['Submit']))
{
    $error = [];
    if(isset($_POST['user']) && !empty($_POST['user']) && trim($_POST['user'])){
        $user = $_POST['user'];
        

        if($user=="Department"){
            if(isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])){
                $name = $_POST['name'];
            }
            else{
                $error['name']= "Enter name";
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
            if(isset($_FILES['identity'])  ){
                $id_name = $_FILES['identity']['name'];
                $id_size = $_FILES['identity']['size'];
                $id_tmp_name = $_FILES['identity']['tmp_name'];
                $id_error = $_FILES['identity']['error'];
    
                if($id_error===0){
                    if($id_size>10000000){
                        $error['identity']="file must be less than 10 MB";
                        
                    }
                    else{
                        $id_ext = pathinfo($id_name, PATHINFO_EXTENSION);
                        $id_ext_lc  = strtolower($id_ext);
                        $id_format = array('jpg', 'jpeg', 'png');
                        if(in_array($id_ext_lc , $id_format)){
                            $new_id_name = uniqid() . '.'. $id_ext_lc;
                            $new_path = 'suploads/'. $new_id_name;
                            move_uploaded_file($id_tmp_name, $new_path); 
                            $id = $new_id_name;
    
                        }
                        else{
                            $error['identity']="invalid file type (must be jpg/png/jpeg)";
                        }
                    }
    
                }
                else{
                    $error="unknown error occured";
                }
            }
            else{
                $error['identity']="choose file";
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
                else{
                    $encryptpw= md5($pw);
                }
            }
            else{
                $error['cpw']= "Enter confirm password";
            }
            if(count($error)==0){
                try{
                    $connect = mysqli_connect('localhost', 'root', '', 'notice_forum');
                
                        $sql = "INSERT INTO `department`( `D_name`,`D_identity`,`D_email`, `D_pw`) VALUES ( '$name','$id', '$email', '$encryptpw' )";
                        mysqli_query($connect,$sql);
                        if (mysqli_affected_rows($connect) == 1) {
                            echo  "<script> alert('Registered successfully ...please wait for confirmation'); </script>";
                            
                        } else {
                            echo '<script>alert("Registration failed")</script>';
                        }
                    }
                    
                catch (Exception $e) {
                    echo "Database Error: " . $e->getMessage();
                }
            }
            else{
                echo "failed";
            }
        }

        if($user=="Student"){
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
            
            
            if(isset($_FILES['identity']) ){
                
                $id_name = $_FILES['identity']['name'];
                $id_size = $_FILES['identity']['size'];
                $id_tmp_name = $_FILES['identity']['tmp_name'];
                $id_error = $_FILES['identity']['error'];
    
                if($id_error===0){
                    if($id_size>10000000000){
                        $error['identity']="file must be less than 10 MB";
                        
                    }
                    else{
                        $id_ext = pathinfo($id_name, PATHINFO_EXTENSION);
                        $id_ext_lc  = strtolower($id_ext);
                        $id_format = array('jpg', 'jpeg', 'png');
                        if(in_array($id_ext_lc , $id_format)){
                            $new_id_name = uniqid() . '.'. $id_ext_lc;
                            $new_path = 'suploads/'. $new_id_name;
                            move_uploaded_file($id_tmp_name, $new_path); 
                            $id = $new_id_name;
                            
    
                        }
                        else{
                            $error['identity']="invalid file type (must be jpg/png/jpeg)";
                        }
                    }
    
                }
                else{
                    $error="unknown error occured";
                }
            }
            else{
                $error['identity']="choose file";
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
                else{
                    $encryptpw=md5($pw);
                }
            }
            else{
                $error['cpw']= "Enter confirm password";
            }
            if(count($error)==0){
                try{
                    $connect = mysqli_connect('localhost', 'root', '', 'notice_forum');
                    
                        $sql = "INSERT INTO `student`(`S_name`,`S_uname`,`D_name`,  `S_email`,`S_identity`, `S_pw`) VALUES ('$name', '$uname','$dept',  '$email','$id',  '$encryptpw')";
                        mysqli_query($connect,$sql);
                        if (mysqli_affected_rows($connect) == 1) {
                            echo  "<script>alert('Registered successfully ...please wait for confirmation')</script>";
                            
                        } else {
                            echo  "Registration failed";
                        }
                    }
                catch (Exception $e) {
                    echo "Database Error: " . $e->getMessage();
                }
            }
            else{
                echo "registration failed";
            }
        }
    }
    else{
        $error['user']= "Select user";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="css/registration.css">
    
</head>
<body>
    
    
<div class="title">
    <a href ="index.php" id="link"><h1>Padmakanya Multiple Campus</h1></a>
    <h3>Online Notice Forum</h3>
    </div>
    <div class="block">
        <form  method="post" enctype="multipart/form-data">
            <h2>Register Here</h2>
            <div class="line">
                <label for="user">User:</label>
                <select name="user" id="user" >
                    <option >Select</option>
                    <option value="Student">Student</option>
                    <option value="Department">Department</option>
                    
                    
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
            <div class="line" id="div_name">
                <label for="name">Name:</label>
                <input type="text"  name="name" id="name"  value="<?php echo  $name;?>">
                <span class="error"><?php echo isset($error['name'])? $error['name'] : ''?></span>
                
                
            </div>

            <div class="line" id="div_uname">
                <label for="uname">Username:</label>
                <input type="text"  name="uname" id="uname"   value="<?php echo  $uname;?>">
                <span class="error" id="error_uname"><?php echo isset($error['uname'])? $error['uname'] : ''?></span>
                
                
            </div>
            <div class="line" id="div_email">
                <label for="email">Email:</label>
                <input type="email"  name="email" id="email" >
                <span class="error" id="error_email"><?php echo isset($error['email'])? $error['email'] : ''?></span>
                
            </div>
            
            <div class="line" id="div_id">
                <label for="identity">ID:</label>
                <input type="file"  name="identity" id="identity" >
                <span class="error" id="error_identity"><?php echo isset($error['identity'])? $error['identity'] : ''?></span>
                
                
            </div>
            
            <div class="line">
                <label for="pw">Password:</label>
                <input type="password"  name="pw" id="pw" placeholder="should contain atleast 1 capital, small letter, number and special character">
                <span class="error"><?php echo isset($error['pw'])? $error['pw'] : ''?></span>
            </div>
            <div class="line">
                <label for="cpw">Confirm password:</label>
                <input type="password"  name="cpw" id="cpw">
                <span class="error"><?php echo isset($error['cpw'])? $error['cpw'] : ''?></span>
            </div>
            <div class="line" id="show_hide" class="show_hide">
                <input type="checkbox" onclick="show_hide()" >Show password
            </div>
            
            
            <div class="line">
            <input type="submit" name="Submit" id="Submit" value="Submit">
            </div>
            
            <div class="line">
            <p>Already registered?<a href="login.php">Login</a></p>
            </div>

            

        </form>
    </div>
    <script src="jquery/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#div_name').hide();
            $('#div_uname').hide();
            $('#div_dept').hide();
            $('#div_id').hide();
            $('#user').change(function(){
                if($(this).val() == "Student"){
                    $('#div_name').show();
                    $('#div_uname').show();
                    $('#div_dept').show();
                    $('#div_id').show();
                }
                
                if($(this).val() == "Department"){
                    
                    $('#div_name').show();
                    $('#div_uname').hide();
                    $('#div_id').show();
                   
                }
                
                
                
            });



            $('#uname').keyup(function(){
                let value = $(this).val();
                $.ajax(
                    {
                        url : 'check_username.php',
                        data:{'uname' : value},
                        method : 'post',
                        success : function(response){
                            $('#error_uname').html(response).css('color', 'black');
                            $('#Submit').attr('disabled', true);
                            $('#Submit').css("background","grey");
                            if(response == " available"){
                                $('#Submit').attr('disabled', false);
                                $('#Submit').css("background","linear-gradient(to right, rgb(232, 20, 186) ,rgb(50, 50, 156), rgb(232, 20, 186))");
                            }
                        }
                    }
                )
            });
            

           
        
        $('#email').keyup(function(){
                let value = $(this).val();
                $.ajax(
                    {
                        url : 'check_email.php',
                        data:{'email' : value},
                        method : 'post',
                        success : function(response){
                            $('#error_email').html(response).css('color', 'black');
                            $('#Submit').attr('disabled', true);
                            $('#Submit').css("background","grey");
                            if(response == " available"){
                                $('#Submit').attr('disabled', false);
                                $('#Submit').css("background","linear-gradient(to right, rgb(232, 20, 186) ,rgb(50, 50, 156), rgb(232, 20, 186))");
                            }
                        }
                    }
                )
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