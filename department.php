<?php

    session_start();
    if (!isset($_COOKIE['user'])){
        
        
        header('location: index.php');
    }
    
    $dept = $_SESSION['dept'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice Forum</title>
    <link rel="stylesheet" href="css/depart.css">
</head>
<body>
    <div class="header-first">
        <ul>
            <?php 
                
                if($_SESSION['user']=="Student"): ?>
                <li id="icon"><button onclick="toggleMenu()" ></a><img src="images/profile_icon.png" ></button></li>
            <?php 
            endif
            ?>

            
            
            <?php
                if($_SESSION['user']=="Department"): ?>
                <li><button class="top"><a href="dashboard.php">Dashboard</a></button></li>
                
                <li><button class="top"><a href="logout.php">Logout</a></button></li>

            <?php 
            endif;
            ?>
            
            

        </ul>
    </div> 
        
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

    <script>
        var menu = document.getElementById("menu");
        

        window.onscroll = function() {myFunction()};
        var sticky = menu.offsetTop;
        function myFunction() {
        if (window.pageYOffset >= sticky) {
            menu.classList.add("sticky");
           
        } else {
            menu.classList.remove("sticky");
            
        }
        }
    </script>   
    

</body>
</html>