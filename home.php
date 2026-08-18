<?php

include 'config.php';
session_start();
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

</head>

<body>
    <!-- header section starts  -->

    <header class="header">

        <section class="flex">

            <div id="menu-btn" class="fas fa-bars-staggered"></div>

            <a href="#" class="logo"><i class="fas fa-briefcase"></i>RMCS</a>
            <nav class="navbar">
                <a href="#">Home</a>
                <a href="about.html">About us</a>
                <a href="jobs.php">All jobs</a>
                <a href="contact.html">Contact us</a>
                <a href="profile.php" name="goto">account</a>
            </nav>
                <a href="#" class="btn" style="margin-top: 0;">Find job</a>
                
                <img src="images/moon.png" id="icon" class="m-logo" alt="" onclick="color_change()" >
                
        </section>

    </header>

    <!-- header section ends  -->

    <!-- home section starts  -->

    <div class="home-container">

        <section class="home">

            <form action="home.php" method="POST">
                <h3>find your next job</h3>
                <p>job location<span>*</span></p>
                <select name="location" id="location1" class="input">
                    <option value="" disabled selected>Location</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Pune">Pune</option>
                    <option value="Banglore">Banglore</option>
                    <option value="Chennai">Chennai</option>
                    <option value="Hyderabad">Hyderabad</option>
                    
                </select>
                <p>job title <span>*</span></p>
                <select name="job" id="title1" class="input" onchange="clear_txt()">
                    <option value="" disabled selected>Jobs</option>
                    <option value="Junior Web Developer">Jr.Developer</option>
                    <option value="Senior web developer">Sr.Developer</option>
                    <option value="Designer">Designer</option>
                    <option value="Database Admin">Database Admin</option>
                    <option value="Human Resource">Human Resource(H.R.)</option>
                    <option value="Cyber Security Expert">Cyber Security</option>
                    <option value="Full-Stack Developer">Full-Stack Developer</option>
                    <option value="Data Scientist">Data Scientist</option>
                </select>
                
                <img src="" id="pop_img" width="25rem"><div id="pop_alert"></div>
                               
                <input type="submit" value="search job" name="search" class="btn" ><!--onclick="search_here()"-->
            </form>
            <!-- Validation Query -->

            <?php 
            if(isset($_POST['search'])){
                if(isset($_POST['location']) && isset($_POST['job']))
                {

                    $job = $_POST['job'];
                    $location = $_POST['location'];

                    $query = "SELECT * FROM `jobinfo` WHERE location = '$location' AND job = '$job'";
                    $select = mysqli_query($conn,$query);
                    
                    if(mysqli_num_rows($select) > 0)
                    {
                        $_SESSION['job']=$job;
                        $_SESSION['location']=$location;
                        header('location:All_jobs/view_job.php');
                    }
                    else{
                        echo "<script> var pop_alrt = document.querySelector('#pop_alert');
                        var pop_img = document.querySelector('#pop_img');
                        pop_alrt.innerHTML='*Job not availabe at this location';
                        pop_img.src='images/warning.png'; </script>";
                    }
                }
                else
                {
                    echo "<script> var pop_alrt = document.querySelector('#pop_alert');
                        var pop_img = document.querySelector('#pop_img');
                        pop_alrt.innerHTML='*Make sure you selected a Location or Job !!';
                        pop_img.src='images/warning.png'; </script>";
                }
            }
            ?>
            <!-- Validation Query -->

        </section>

    </div>


    <!-- home section ends  -->


    <!-- category section starts  -->

    <section class="category">

        <h1 class="heading">job category</h1>

        <div class="box-container">

            <a class="box" >
                <i class="fas fa-code"></i>
                <div>
                    <h3>developer</h3>
                    <span></span>
                </div>
            </a>

            <a  class="box">
                <i class="fa-solid fa-pen-ruler"></i>
                <div>
                    <h3>designer</h3>
                    <span></span>
                </div>
            </a>

            <a  class="box">
                <i class="fa-solid fa-chalkboard-user"></i>
                <div>
                    <h3>Cyber security</h3>
                    <span></span>
                </div>
            </a>

            <a  class="box">
                <i class="fa-solid fa-magnifying-glass-chart"></i>
                <div>
                    <h3>Data Scientist</h3>
                    <span></span>
                </div>
            </a>

            <a  class="box">
                <i class="fa-solid fa-headset"></i>
                <div>
                    <h3>Full-Stack Developer</h3>
                    <span></span>
                </div>
            </a>

            <a  class="box">
                <i class="fa-sharp fa-solid fa-graduation-cap"></i>
                <div>
                    <h3>Human Resource</h3>
                    <span></span>
                </div>
            </a>

            <a  class="box">
                <i class="fa-solid fa-comments-dollar"></i>
                <div>
                    <h3>Software Engineer</h3>
                    <span></span>
                </div>
            </a>

            <a  class="box">
                <i class="fa-solid fa-database"></i>
                <div>
                    <h3>Database Admin</h3>
                    <span></span>
                </div>
            </a>

        </div>

    </section>


    <!-- category section ends  -->


    <!-- job section start  -->

    <section class="jobs-container">

        <h1 class="heading">latest jobs</h1>

        <div class="box-container">

            <?php
            $select = mysqli_query($conn, "SELECT * FROM jobinfo ORDER BY id desc");
            $num = mysqli_num_rows($select);
            $i = 0;

            if($num > 0){
                while($row = mysqli_fetch_assoc($select)){
                    $location = $row['location'];
                    $job = $row['job'];
                    $i++;
                    if($i == 7 )
                    {
                        break;
                    }
            ?>

            <div class="box">
                <div class="company">
                    <img src="<?php echo $row['image'];?>" alt="" srcset="">
                    <div>
                        <h3>RMCS.pvt</h3>
                    </div>
                </div>
                <h3 class="job-title"><?php echo $row['job'];?></h3>
                <p class="location"><i class="fas fa-map-marker-alt"><span><?php echo $row['location'];?></span></i></p>
                <div class="tags">
                    <p><i class="fas fa-indian-rupee-sign"><span><?php echo $row['salary'];?></span></i>
                        <i class="fas fa-briefcase"><span><?php echo $row['job_type'];?></span></i>
                        <i class="fas fa-clock"><span><?php echo $row['schedule'];?></span></i>
                    </p>
                </div>
                <div class="flex-btn">
                   
                     <form action="detail.php" method="Post"><input type="submit" value="view details" class="btn" name="view_more">
                        <input type="hidden" name="loc" value="<?php echo $location?>">
                        <input type="hidden" name="job" value="<?php echo $job?>">
                    </form>
                    <!-- <button type="submit" class="far fa-heart" name="save"></button> -->
                    
                </div>
            </div> 
            
            <?php
            }
        }
        ?>

        </div>
        <br>
        <div style="text-align:center; margin-top: 1rem;">
            <a href="jobs.php" class="btn">view all</a>
        </div>

    </section>
    <br><br><br><br>


    <!-- job section ends  -->


    <!-- footer section starts  -->

    <footer class="footer">

        <section class="grid">

            <div class="box">
                <h3>quick links</h3>
                <a href="#"><i class="fas fa-angle-right"></i> home</a>
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
                <a href="http://linkedin"><i class="fab fa-linkedin"></i> linkedin</a>
                <a href="http://youtube.com"><i class="fab fa-youtube"></i> youtube</a>
            </div>

        </section>

        <div class="credit">&copy; copyright @2023 by <span> The RMCS group </span> | all right reserved! <div>Thank You
            </div>
        </div>


    </footer>

    <!-- footer section ends  -->

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>