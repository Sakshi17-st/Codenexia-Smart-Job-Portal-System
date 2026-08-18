<?php
include 'config.php';
error_reporting(0);
session_start();
$cuser_email = $_SESSION['user_email'];

if(isset($cuser_email)){
   header('location:home.php');
}

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $pass = $_POST['password'];

   $query = "SELECT * FROM `userinfo` WHERE email = '$email' && password = '$pass'";
   $select = mysqli_query($conn,$query);

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);

    //   Session variables

      $_SESSION['user_email'] = $row['email'];  
      $_SESSION['user_name'] = $row['name'];  
      $_SESSION['user_pass'] = $row['password'];  
      $_SESSION['user_address'] = $row['address'];  
      $_SESSION['user_img'] = $row['image'];  
      $_SESSION['user_desc'] = $row['description'];

    //   Session variables
    if($_SESSION['user_name'] == "admin" && $_SESSION['user_pass'] == "admin321")
    {
        // header('location:admin.php');
        $success_msg[] = "Login Successful !" ;
        echo "<script>setTimeout(\"location.href = 'dashboard.php';\",1400);</script>";
    }
    else{ 
        // header('location:home.php');
        $success_msg[] = "Login Successful !" ;
        echo "<script>setTimeout(\"location.href = 'home.php';\",1400);</script>";

    }
   }
   else{
    $message[] = "*Incorrect Email or Password" ;
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">


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

            <a href="home.php" class="btn" style="margin-top: 0;">find job</a>

            <img src="images/moon.png" id="icon" class="m-logo" alt="" onclick="color_change()" >

        </section>

    </header>

    <!-- header section ends  -->


    <!-- account section starts  -->


    <div class="account-form-container">

        <section class="account-form">

            <form action="login.php" method="POST">
                <h3>welcome back</h3>
                <input type="email" required name="email" placeholder="enter your email" class="input" autocomplete="off">
                <input type="password" required name="password" maxlength="8" minlength="8" placeholder="enter your password"
                    class="input">

                    <?php
                     if(isset($message)){
                        foreach($message as $message){
                            echo "<img src='images/warning.png' width='25rem'><div id='pop_alert'>".$message."<div>";
                        }
                    }
                     if(isset($success_msg)){
                        foreach($success_msg as $success_msg){
                            echo "<img src='images/checked.png' width='25rem'><div id='pop_alert' style='color:green'>".$success_msg."<div>";
                        }
                    }
                    ?>
                <p><span>don't have an account? <a href="register.php">register now</a></span></p>
                <input type="submit" value="login now" name="submit" class="btn">
            </form>

        </section>

    </div>


    <!-- account section ends -->


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




    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>