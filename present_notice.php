<?php
 $topic=$_GET['topic'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice Forum</title>
    <link rel="stylesheet" href="css/present_notice.css">
</head>
<body>
    <div class="header">
        <div class="buttons">
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div class="title">
            <h1><?php echo $topic; ?></h1>
        </div>
    </div>
    <div class="content">
        <?php
             $conn = mysqli_connect('localhost', 'root', '', 'notice_forum');
             $sql = "SELECT * FROM notice WHERE Topic='$topic' and Status=1 ORDER BY N_id DESC ";
         
             $res = mysqli_query($conn, $sql);
             if(mysqli_num_rows($res) > 0 ){?>
             <div class="notice_body">
                     
                    <?php while($notice = mysqli_fetch_assoc($res)){ ?>
                    
                        <div class="notice">

                            <section>
                                <div class="file_content">
                                    <div class="file">
                                    
                                    <a href="uploads/<?php echo $notice['N_name']; ?> " target="_blank"><img src="<?php echo $notice['N_name'] ?>" ></a>
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
    
    
    
    
</body>
</html>