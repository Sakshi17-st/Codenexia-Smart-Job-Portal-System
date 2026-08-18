<?php

include 'config.php';
session_start();
error_reporting(0);
$cuser_email = $_SESSION['user_email'];

if(!isset($cuser_email))
{
    header('location:login.php');
}
else
{
    if($cuser_email != "admin.root@rmcs.com")
    {
    header('location:login.php');
    }
}

// Total No of Users

$total_users_que = mysqli_query($conn,"SELECT * FROM userinfo");
$total_users = mysqli_num_rows($total_users_que)-1;
if($total_users < 0){
    $total_users = 0;
}

// Total No of Jobs

$total_jobs_que = mysqli_query($conn,"SELECT * FROM jobinfo");
$total_jobs = mysqli_num_rows($total_jobs_que);

// Total No of Request

$total_req_que = mysqli_query($conn,"SELECT * FROM admin_table");
$total_req= mysqli_num_rows($total_req_que);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <!-- custom Js file link  -->
    <script src="js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


    
    <style>
    
      .container{
        min-height: 50vh;
        background-color: var(--light-bg);
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .category{
        background-color:var(--light-bg);
        min-height: 50vh;
        width:100%;
        text-align:center;
        color:var(--title-color);
        background-color:var(--wheat);
        }
      
       table{  
        width:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        border-spacing:3rem;
        margin-bottom:4rem;
        background-color:var(--shade);
        /* box-shadow:0 .5rem 1rem rgba(0, 0, 0, .2); */
       }

       .btn{
        background: var(--green);
        }

        .btn:hover{
         background: var(--dark-red);
       }

       td{ 
        width:50%;
        padding:5rem 8rem;
        box-shadow:0 .5rem 1rem rgba(0, 0, 0, .2);
        border-radius:50px;
        background-color:var(--light-bg);
        cursor:default;
       }

       td:hover{
        background-color:var(--dark-blue);
       }

       h3{
        color:var(--title-color);
        text-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
        font-size:3rem;
        text-transform:capitalize;
       }


       h1{
        text-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
        display:block;
        margin-top:30px;
        font-size:3.5rem;
       }

       a{
        color:var(--title-color);
        font-size:2rem;
       }

       #i-con{
        font-size:6.5rem;
       }

       @media (max-width:768px){
        .category{
            overflow-y:scroll;
        }
        table{
            width: 80rem;
        }
     }
     @media (max-width:450px){
        html{
            font-size: 50%;
        }
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
                <a href="#">dashboard</a>
                <a href="admin.php">Admin Panel</a>
                <a href="admin_add.php">Add Post</a>
            </nav>

            <a href="logout.php" class="btn" style="margin-top: 0;">Logout</a>

            <img src="images/moon.png" id="icon" class="m-logo" alt="" onclick="color_change()" >

        </section>

    </header>

    <!-- header section ends  -->

    <!-- Body start -->


    <div class="container">
    <div class="category">

    <table>
        <h1 class="heading">Dashboard</h1>
        
        <div class="box-container">
            
        <tr>
            <td>
            <a class="box" >
                <i id="i-con" class="fa-solid fa-users"></i>
                <div class="thold">
                    <h3>users</h3>
                    <span><?php echo $total_users?></span>
                </div>
            </a>
            </td>

            <td>
            <a  class="box">
                <i id="i-con" class="fa-solid fa-briefcase"></i>
                <div class="thold">
                    <h3>Jobs Listed</h3>
                    <span><?php echo $total_jobs?></span>
                </div>
            </a>
            </td>

            </tr>

            <tr>
            <td>
            <a class="box" href="admin.php" style="cursor:pointer;">
                <i id="i-con" class="fa-sharp fa-regular fa-comment"></i>
                <div class="thold">
                    <h3>Requests</h3>
                    <span><?php echo $total_req?></span>
                </div>
            </a>
            </td>

            <td>
            <a class="box" href="admin_add.php" style="cursor:pointer;">
                <i id="i-con" class="fa-solid fa-plus"></i>
                <div class="thold">
                    <h3>add jobs</h3>
                    <span></span>
                </div>
            </a>
            </td>

            </tr>
</div>  
</table>
    </div>
    </div>

    
    <!-- Body ends-->


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


