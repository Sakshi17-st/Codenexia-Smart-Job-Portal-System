<?php

include 'config.php';
session_start();
$cuser_email = $_SESSION['user_email'];

if(!isset($cuser_email)){
   header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Profile Page */

        .profile_container{
            min-height: 100vh;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding:10px;
            overflow-x:0;
        }

        .profile {
            width: 40%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction:column;
            background-color:var(--wheat);
            padding : 50px 40px;
            border-radius:25px;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
        }
        
        .profile_img{
            height: 250px;
            width: 250px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
            margin-bottom:30px;    
        }

        .message{
            overflow-x:0;
            margin:10px 0;
            border-radius: 5px;
            padding:30px;
            background-color: var(--gray);
            color:var(--white1);
            font-size: 18px;
            margin-bottom:35px;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
            }

            h3{ 
                text-transform: uppercase;
                text-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
            }

            h4{
                display: inline;
                font-size:20px;
                text-transform: capitalize;
                text-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
            }

        .edit_btn,.logout_btn{
            width: 100%;
            border-radius: 25px;
            padding:8px 30px;
            color: var(--white1);   
            background-color: var(--blue);
            text-align: center;
            cursor: pointer;
            font-size: 18px;   
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
            margin-top:8px
        }

        
        .edit_btn:hover{
            background-color: var(--dark-blue);
            }   

        .logout_btn{
            background-color: var(--red);
            padding-left : 65px;
            padding-right : 65px;
        }

        .logout_btn:hover{
         background-color: var(--dark-red);
        }

        @media (max-width:865px){
            .message {
                width:100%;
                font-size:12px;
                margin:0;
            }

            h3,h4{
                font-size:14px;
            }

            .profile{
                width:80%;
            }

            .profile_img{
                height: 150px;
                width: 150px;
            }
           
        }

        /*Profile Page */
    </style>

     <!-- custom js file link  -->
     <script src="js/script.js"></script>
</head>
<body>
      <!-- header section starts  -->

    <header class="header">

        <section class="flex">

            <div id="menu-btn" class="fas fa-bars-staggered"></div>

            <a href="home.php" class="logo"><i class="fas fa-briefcase"></i>RMCS</a>
            <nav class="navbar">
                <a href="home.php">Home</a>
                <a href="about.html">About us</a>
                <a href="jobs.php">All jobs</a>
                <a href="contact.html">Contact us</a>
                <a href="profile.php">account</a>
            </nav>

            <a href="home.php" class="btn" style="margin-top: 0;">Find job</a>

            <img src="images/moon.png" id="icon" class="m-logo" alt="" onclick="color_change()" >

        </section>

    </header>

    <!-- header section ends  -->

<div class="profile_container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `userinfo` WHERE email = '$cuser_email'");
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }

        if($fetch['name'] != "admin"){
         if($fetch['image'] == ''){
            echo '<img src="images/user2.png" class="profile_img">';
         }else{
            echo '<img src="Temp_img/'.$fetch['image'].'" class="profile_img">';
         }
        }
        else{
            echo '<img src="images/admin.png" class="profile_img">';
        }
      ?>

      <div class="message">
        <?php 
        if($fetch['name'] != "")
        echo "<center><h3>".$fetch['name']."</h3></center>"."<br><br>"; 

        if($fetch['email'] != "" && $fetch['name'] != "admin")
        echo "<h4>Email</h4> : ".$fetch['email']."<br><br>"; 

        if($fetch['address'] != ""&& $fetch['name'] != "admin")
        echo "<h4>Address</h4> : ".$fetch['address']."<br><br>"; 

        if($fetch['qualification'] != ""&& $fetch['name'] != "admin")
        echo "<h4>Qualification</h4> : ".$fetch['qualification']."<br><br>"; 
        
        if($fetch['skills'] != ""&& $fetch['name'] != "admin")
        echo "<h4>Skills</h4> : ".$fetch['skills']."<br><br>"; 

        if($fetch['description'] != ""&& $fetch['name'] != "admin")
        echo "<h4>About Me</h4> : ".$fetch['description']."<br><br>"; 

        if($fetch['name'] != "admin")
        echo '<br><center><a href="inbox.php" class="edit_btn"><img src="images/notification.gif" width="18px" style="border-radius:50%;"> View Inbox</a></center>';
        
        if( $fetch['name'] == "admin"){
            echo "<h4>This Admin login !!</h4>";
            echo "<style>.edit_btn{display:none;}</style>";
            echo '<center><a href="dashboard.php" ><button class="btn">Admin Panel</button></a></center>';
        }
        ?>
    </div>
      <a href="edit_profile.php"> <button class="edit_btn">update profile</button> </a>
      <a href="logout.php"><button class="logout_btn">logout</button></a>
   </div>

</div>

     <!-- footer section starts  -->

     <footer class="footer">

<section class="grid">

    <div class="box">
        <h3>quick links</h3>
        <a href="home.php"><i class="fas fa-angle-right"></i> home</a>
        <a href="about.html"><i class="fas fa-angle-right"></i> about</a>
        <a href="jobs.php"><i class="fas fa-angle-right"></i> jobs</a>
        <a href="contact.html"><i class="fas fa-angle-right"></i> contact us</a>
        <a href="home.php"><i class="fas fa-angle-right"></i> filter search</a>
    </div>

    <div class="box">
        <h3>extra links</h3>
        <a href="profile.php"><i class="fas fa-angle-right"></i> account</a>
        <a href="login.php"><i class="fas fa-angle-right"></i> login</a>
        <a href="register.php"><i class="fas fa-angle-right"></i> register</a>
        <a href="home.php"><i class="fas fa-angle-right"></i> post job</a>
        <a href="home.php"><i class="fas fa-angle-right"></i> dashboard</a>
    </div>

    <div class="box">
        <h3>follow us</h3>
        <a href="http://facebook.com"><i class="fab fa-facebook-f"></i> facebook</a>
        <a href="http://twitter.com"><i class="fab fa-twitter"></i> twitter</a>
        <a href="http://instagram.com"><i class="fab fa-instagram"></i> instagram</a>
        <a href="http://linkedin.com"><i class="fab fa-linkedin"></i> linkedin</a>
        <a href="http://youtube.com"><i class="fab fa-youtube"></i> youtube</a>
    </div>

</section>

<div class="credit">&copy; copyright @2023 by <span> The RMCS group </span> | all right reserved!</div>

</footer>

<!-- footer section ends  -->

</body>
</html>