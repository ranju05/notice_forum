<?php
    
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice Forum</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="header">
        <ul>
            <li><button class="top"><a href="registration.php">Register</a></button></li>
            <li><button class="top"><a href="login.php">Login</a></button></li>

        </ul>
    </div>
    <div id="header">
        <div class="title_bar">

            <div class="title">
                <h2>Padmakanya Multiple Campus</h2>
                <h1>NOTICE FORUM</h1>
            </div>
            
        </div>
        <div id="nav" >
            <div id="menu">
                <ul >
                    
                    <li><a href="#admission" class="item">Admissions</a></li>
                    <li><a href="#exam" class="item">Exams</a></li>
                    <li><a href="#sports" class="item">Sports</a></li>
                    <li><a href="#hostel" class="item">Hostel</a></li>
                    <li><a href="#holiday" class="item">Holidays</a></li>
                    

                </ul>
            </div>
        </div>
    </div>
    <div class="picture">
        <img src="images/pk_front1.jpg" alt="picture">
    </div>
    
    <div class="body">
        <section id="admission" class="topic-section">
            <div class="section-topic">
                <h2 >Admission</h2></a>
                <div class="file-body">
                    <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
                        $sql = "SELECT * FROM notice WHERE Topic='Admission' and Status=1 ORDER BY N_id DESC ";
                    
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
                                                    <p>Department:<?php echo $notice['D_name'] ; ?></p>
                                                    
                                                </div>
                                            </div>
                                        </section>
                                        
                                    </div>
                            <?php } } ?>
                </div>
                
                <a href="present_notice.php?topic=Admission"><h3>More</h3></a>
            </div>
        </section>
        <section id="exam" class="topic-section">
            <div class="section-topic">
                <h2 >Exam</h2></a>
                <div class="file-body">
                    <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
                        $sql = "SELECT * FROM notice WHERE Topic='Exam' and Status=1 ORDER BY N_id DESC Limit 3";
                    
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
                                                    <p>Department:<?php echo $notice['D_name'] ; ?></p>
                                                    
                                                </div>
                                            </div>
                                        </section>
                                        
                                    </div>
                            <?php } } ?>
                </div>
                
                <a href="present_notice.php?topic=Exam"><h3>More</h3></a>
            </div>
        </section>

        <section id="sports" class="topic-section">
            <div class="section-topic">
                <h2 >Sports</h2></a>
                <div class="file-body">
                    <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
                        $sql = "SELECT * FROM notice WHERE Topic='Sports' and Status=1 ORDER BY N_id DESC ";
                    
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
                                                    <p>Department:<?php echo $notice['D_name'] ; ?></p>
                                                    
                                                </div>
                                            </div>
                                        </section>
                                        
                                    </div>
                            <?php } } ?>
                </div>
                
                <a href="present_notice.php?topic=Sports"><h3>More</h3></a>
            </div>
        </section>

        <section id="hostel" class="topic-section">
            <div class="section-topic">
                <h2 >Hostel</h2></a>
                <div class="file-body">
                    <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
                        $sql = "SELECT * FROM notice WHERE Topic='Hostel' and Status=1 ORDER BY N_id DESC ";
                    
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
                                                    <p>Department:<?php echo $notice['D_name'] ; ?></p>
                                                    
                                                </div>
                                            </div>
                                        </section>
                                        
                                    </div>
                            <?php } } ?>
                </div>
                
                <a href="present_notice.php?topic=Hostel"><h3>More</h3></a>
            </div>
        </section>

        <section id="holiday" class="topic-section">
            <div class="section-topic">
                <h2 >Holiday</h2></a>
                <div class="file-body">
                    <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
                        $sql = "SELECT * FROM notice WHERE Topic='Holiday' and Status=1 ORDER BY N_id DESC ";
                    
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
                                                    <p>Department:<?php echo $notice['D_name'] ; ?></p>
                                                    
                                                </div>
                                            </div>
                                        </section>
                                        
                                    </div>
                            <?php } } ?>
                </div>
                
                <a href="present_notice.php?topic=Holiday"><h3>More</h3></a>
            
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