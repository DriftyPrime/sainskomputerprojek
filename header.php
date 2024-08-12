<?php session_start();?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/style.css">
    <head>
        <meta charset="UTF-8">
        <title> Kehadiran Hari Sukan SMKSBS</title>
        <style>
            body
            {
                background-image: url("image/national-sports-day-illustration_23-2148993654.avif");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: 100% 100%;
            }
        </style>
    </head>
    <body>
      
        <ul class="nav">
            <div class="logo">
                <a href="index.php" style="text-decoration: none; color:#ffffff;"
                    onmouseover="this.style.color='#c1c1c1'"
                    onmouseout="this.style.color='#ffffff'">
                 HOME</a>
            </div> 
            <?php
                include_once'includes/dbh.inc.php';
                include_once'includes/checkadminoruser.php';

                if(isset($_SESSION["id"]))
                {
                    if(checkAdminOrUser($conn, $_SESSION["id"]) == 'admin')
                    {
                        echo '<li><a href="query.php">PESERTA</a></li>';
                        echo '<li><a href="upload.php">UPLOAD</a></li>';
                    }
                }

           
 
                
            ?>
            
            <li><a href="aktiviti.php">AKTIVITI</a></li>
            <li class="dropdown">
                <a href="javascript: void(0)" class="dropbtn">Akaun</a>
                <div class="dropdown-content">
                   <?php   
                        if(isset($_SESSION["id"]))
                        {
                            //logged in
                            echo"<a href='profile.php'>Profil</a>";
                            echo"<a href='includes/logout.php'>Log Out</a>";
                        }else
                        {
                            //not logged in
                            echo"<a href='loginpage.php'>Log In</a>";
                            echo"<a href='signup.php'>Daftar</a>";
                        }
                    ?>
                </div>
            </li>
        </ul>
        
        
        
        
    </body>
</html>