<?php

    session_start();
    if($_SESSION['user']!="Student" ){
        
        
        header('location: index.php');
    }
    
   
    $uname = $_SESSION['uname'];
    
    $dept = $_SESSION['dept'];
    $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
    $sql = "select * from student where S_uname='$uname' ";
    $res = mysqli_query($conn, $sql);
    
    $student = mysqli_fetch_assoc($res);
    $id = $student['S_id'];
    

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice Forum</title>
    <script src="https://kit.fontawesome.com/dd4b41394b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/depart.css">
</head>
<body>
   
        
    <div class="head_bar">
        <div class="header">
            
        <div class="title_bar">

            <div class="title">
                <h2><?php echo $dept;?> Department</h2>
                <h1>NOTICE FORUM</h1>
            </div>
           
        </div>
            
        </div>
        <div id="nav">
            <div id="menu">
                <ul>
                   
                    <li><a href="#admission" class="item">Admissions</a></li>
                    <li><a href="#exam" class="item">Exams</a></li>
                    <li><a href="#holiday" class="item">Holidays</a></li>
                    
                </ul>
            </div>
        </div>
    </div>
    <div class="body">
        <div class="profile-button"><button onclick="toggle()"><img src="icon/profile.png" alt=""><?php echo $uname;?></button></div>
        <div class="user-menu" id="menu-bar">
            <h1>Menu</h1>
            <ul>

                <li><a href="update_profile.php?id=<?php echo $id; ?>"><img src="icon/profile.png" >Update Profile</a></li>
                
                <li><a href="index.php"><img src="icon/logout.png" >Logout</a></li>
            </ul>
        </div>
        <section id="admission" class="topic-section">
            <div class="section-topic">
                <h2 >Admission</h2></a>
                <div class="file-body">
                    <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
                        $sql = "SELECT * FROM notice WHERE (Topic='Admission' and D_name='$dept' ) and Status=1 ORDER BY N_id DESC LIMIT 3";
                    
                        $res = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($res) > 0 ){?>
                        <div class="notice_body">
                                
                                <?php while($notice = mysqli_fetch_assoc($res)){ ?>
                                
                                    <div class="notice">

                                        <section>
                                            <div class="file_content">
                                                <div class="file">
                                                
                                                <a href="uploads/<?php echo $notice['N_name']; ?> " target="_blank"><img src="images/file.png" ></a>
                                                </div>
                                                <div class="description">
                                                    <p><?php echo $notice['N_description'] ; ?></p>
                                                    
                                                </div>
                                            </div>
                                        </section>
                                        
                                    </div>
                            <?php } } ?>
                </div>
                
                <a href="present-department-notice.php?topic=Admission"><h3>More</h3></a>
            </div>
        </section>
        <section id="exam" class="topic-section">
            <div class="section-topic">
                <h2 >Exam</h2></a>
                <div class="file-body">
                    <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
                        $sql = "SELECT * FROM notice WHERE (D_name='$dept' and Topic='Exam' ) and Status=1 ORDER BY N_id DESC Limit 3";
                    
                        $res = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($res) > 0 ){?>
                        <div class="notice_body">
                                
                                <?php while($notice = mysqli_fetch_assoc($res)){ ?>
                                
                                    <div class="notice">

                                        <section>
                                            <div class="file_content">
                                                <div class="file">
                                                
                                                <a href="uploads/<?php echo $notice['N_name']; ?> " target="_blank"><img src="images/file.png" ></a>
                                                </div>
                                                <div class="description">
                                                    <p><?php echo $notice['N_description'] ; ?></p>
                                                    
                                                </div>
                                            </div>
                                        </section>
                                        
                                    </div>
                            <?php } } ?>
                </div>
                
                <a href="present-department-notice.php?topic=Exam"><h3>More</h3></a>
            </div>
        </section>

        

        <section id="holiday" class="topic-section">
            <div class="section-topic">
                <h2 >Holiday</h2></a>
                <div class="file-body">
                    <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
                        $sql = "SELECT * FROM notice WHERE ( D_name='$dept' and Topic='Holiday') and Status=1 ORDER BY N_id DESC LIMIT 3 ";
                    
                        $res = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($res) > 0 ){?>
                        <div class="notice_body">
                                
                                <?php while($notice = mysqli_fetch_assoc($res)){ ?>
                                
                                    <div class="notice">

                                        <section >
                                            <div class="file_content">
                                                <div class="file">
                                                
                                                <a href="uploads/<?php echo $notice['N_name']; ?> " target="_blank"><img src="images/file.png" ></a>
                                                </div>
                                                <div class="description">
                                                    <p><?php echo $notice['N_description'] ; ?></p>
                                                    
                                                </div>
                                            </div>
                                        </section>
                                        
                                    </div>
                            <?php } } ?>
                </div>
                
                <a href="present-department-notice.php?topic=Holiday"><h3>More</h3></a>
            
        </section>
        
            
        
    </div>
    <script src="jquery/jquery.min.js"></script>
    <script>
        let menu = document.getElementById("menu-bar");
        function toggle(){
            menu.classList.toggle("open-menu");
        }


        window.onload(function(){
                
                $.ajax(
                    {
                        url : 'accept_notice.php',
                        
                        method : 'post',
                        success : function(response){
                            
                            
                                alert("new notice is published.")
                                
                            }
                        }
                    
                )
            });
    </script>

   
    

</body>
</html>