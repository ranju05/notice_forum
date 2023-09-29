<?php
    session_start();
    
    if(!isset($_SESSION['user'])  ){
        header("location:index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/dd4b41394b.js" crossorigin="anonymous"></script>
    <link  rel="stylesheet"href="css/admin.css" >
</head>
<body>
    <div class="header">
        <div class="button">
            <ul>
                
                <li><button><a href="add_admin.php">Add Admin</a></button></li>
                <li><button><a href="logout.php">Logout</a></button></li>
            </ul>
            
            
        </div>
        
        <div class="title">
            <h2>Welcome Admin,</h2>
            
                <h1>Dashboard</h1>
            
        </div>
        
        

    </div>
    <!--<div class="profile_wrap">
            <div class="profile">
                <div class="user">
                <i class="fa-regular fa-user fa-2xl"></i>
                    <h2><?php echo $uname ; ?></h2>
                </div>
                <hr>
            </div>

        </div>
-->
    <div class="body">
        
        <button id="notice"><a href="admin_display_notice.php">Notices</a></button>
        <button id="user"><a href="user.php">Users</a></button>
        <button id="upload"><a href="upload_notice.php?user='Admin'">New Upload</a></button>

    </div>
        
            
    
</body>
</html>