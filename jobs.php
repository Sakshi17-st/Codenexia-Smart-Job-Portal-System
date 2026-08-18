<?php 
include 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs</title>

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

            <a href="home.php" class="logo"><i class="fas fa-briefcase"></i>RMCS</a>
            <nav class="navbar">
                <a href="home.php">Home</a>
                <a href="about.html">About us</a>
                <a href="jobs.html">All jobs</a>
                <a href="contact.html">Contact us</a>
                <a href="profile.php">account</a>
            </nav>

            <a href="home.php" class="btn" style="margin-top: 0;">find job</a>

            <img src="images/moon.png" id="icon" class="m-logo" alt="" onclick="color_change()">
            
        </section>

    </header>

    <!-- header section ends  -->


    <!-- all jobs section starts  -->

    <section class="jobs-container">

        <h1 class="heading">Available jobs</h1>

        <div class="box-container">

            <?php
            $select = mysqli_query($conn, "SELECT * FROM jobinfo");
            $num = mysqli_num_rows($select);


            if($num > 0){
                while($row = mysqli_fetch_assoc($select)){
                    $location = $row['location'];
                    $job = $row['job'];
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

    </section>
    <br><br><br><br>


    <!-- all jobs section ends  -->


    <!-- footer section starts  -->

    <footer class="footer">

        <section class="grid">

            <div class="box">
                <h3>quick links</h3>
                <a href="home.php"><i class="fas fa-angle-right"></i> home</a>
                <a href="about.html"><i class="fas fa-angle-right"></i> about</a>
                <a href="jobs.html"><i class="fas fa-angle-right"></i> jobs</a>
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


    <script>

        let dropdown_items = document.querySelectorAll('.job-filter form .dropdown-container .dropdown .lists .items');

        dropdown_items.forEach(items => {
            items.onclick = () => {
                items_parent = items.parentElement.parentElement;
                let output = items_parent.querySelector('.output');
                output.value = items.innerText;
            }
        });


    </script>

</body>

</html>