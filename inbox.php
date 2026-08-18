<?php 
include 'config.php';
session_start();
error_reporting(0);
$cuser_email = mysqli_real_escape_string($conn,$_SESSION['user_email']);

if(!isset($cuser_email))
{
    header('location:login.php');
}
else
{
    if($cuser_email == "admin.root@rmcs.com")
    {
    header('location:admin.php');
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- custom Js file link  -->
    <script src="js/script.js"></script>
    <style>
         .contain{
            min-height: 60vh;
            display:flex;
            text-align:center;
            align-items:center;
            justify-content:center;
            flex-direction:column;
            background-color: var(--light-bg);
        }

        .success_box{
            width:40%;
            background-color:var(--wheat);
            padding : 80px 50px;
            border-radius:5px;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
        }


        .msg{
            text-shadow:0 .5rem 1rem rgba(0, 0, 0, .2);
            font-size:2.8rem;
            color:var(--blue);
            text-transform:uppercase;
            margin-top: 20px;
        }

        .back{
            text-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
            color : var(--red);
            margin-top:10px;
            font-size:14px;
            font-weight:bold;
        }
        
        .back:hover{
            color : var(--black1);
        }


    </style>
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

    <?php
    
    $query = mysqli_query($conn,"SELECT * FROM notify WHERE email = '$cuser_email' ");
    $num = mysqli_num_rows($query);

    if($num > 0){
        $res = mysqli_fetch_assoc($query);
        $msg = $res['msg'];
           
        if(!empty($msg)){
            echo '<div class="contain">
            <div class="success_box"><img src="images/inbox.gif" width="50px" height="50px"><br><h2 class="msg">'.$msg.'</h2></div><a class="back" href="profile.php" class="delete-btn">&lt; Go Back</a></div>';
        }
        else{
            echo '<div class="contain">
            <div class="success_box">
            <img src="images/inbox.gif" width="60px" height="60px"><br><h2 class="msg">INBOX IS EMPTY !</h2></div><a class="back" href="profile.php" class="delete-btn">&lt; Go Back</a></div>';
        }    

    }
    else{
        echo '<div class="contain">
        <div class="success_box">
        <img src="images/inbox.gif" width="60px" height="60px"><br><h2 class="msg">INBOX IS EMPTY !</h2></div><a class="back" href="profile.php" class="delete-btn">&lt; Go Back</a></div>';
    }
    
    
    ?>


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