<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:index.php');
}
$user = $id = $name = $uname = $email =$id= $pw = $cpw=$encryptpw='';


if(isset($_POST['Add']))
{
    $error = [];
    
            if(isset($_POST['uname']) && !empty($_POST['uname']) && trim($_POST['uname'])){
                if(!preg_match('/^[a-zA-Z0-9\s]+$/', $_POST['uname'])){
                    $error['uname']="Enter valid username";
                }
                $uname = $_POST['uname'];
            }
            else{
                $error['uname']= "Enter username";
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
                else{
                    $encryptpw = md5($pw);
                }
            }
            else{
                $error['cpw']= "Enter confirm password";
            }  
            if(count($error)==0){
                try{
                    $connect = mysqli_connect('localhost', 'root', '', 'notice_forum');
                
                        $sql = "INSERT INTO `admin`(`A_username`,`A_email`, `A_pw`) VALUES ('$uname', '$email',  '$encryptpw' )";
                        mysqli_query($connect,$sql);
                        if (mysqli_affected_rows($connect) == 1) {
                            echo  "<script> alert('Registered successfully ); </script>";
                            header("location:admin.php");
                        } else {
                            echo (" failed");
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
        <div class="back">
            <button><a href="admin.php">BACK</a></button>
        </div>

        <div class="title">

            <div class="block">
        
                <form  method="post" enctype="multipart/form-data">
            
            
            
            

                    <div class="line" id="div_uname">
                        <label for="uname">Username:</label>
                        <input type="text"  name="uname" id="uname"   value="<?php echo  $uname;?>">
                        <span class="error" id="error_uname"><?php echo isset($error['uname'])? $error['uname'] : ''?></span>
                        
                        
                    </div>
                    <div class="line">
                        <label for="email">Email:</label>
                        <input type="email"  name="email" id="email" >
                        <span class="error"><?php echo isset($error['email'])? $error['email'] : ''?></span>
                        
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
                    <input type="submit" name="Add" id="Add" value="Add">
                    </div>
                    
                

                

                </form>
            </div>
        </div>
        <script src="jquery/jquery.min.js"></script>
        <script type="text/javascript">
            

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