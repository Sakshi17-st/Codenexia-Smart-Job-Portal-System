<?php
include 'config.php';
error_reporting(0);
session_start();
$cuser_email = $_SESSION['user_email'];

if (!isset($cuser_email)) {
    header('location:login.php');
} else {
    if ($cuser_email != "admin.root@rmcs.com") {
        header('location:login.php');
    }
}

if(isset($_POST['add_post'])){
    if(isset($_POST['location']) && isset($_POST['job']))
    {
        $location =$_POST['location'];
        $job =$_POST['job'];
        $salary =$_POST['salary'];
        $jobtype =$_POST['job_type'];
        $schedule =$_POST['schedule'];
        $requirement =mysqli_real_escape_string($conn,$_POST['requirement']);
        $qualification = mysqli_real_escape_string($conn,$_POST['qualification']);
        $skill =mysqli_real_escape_string($conn,$_POST['skill']);
        $desc =mysqli_real_escape_string($conn,$_POST['description']);

         // Uploading images
        $images = $_FILES['images']['name'];
        $update_image_size = $_FILES['images']['size'];
        $update_image_tmp_name = $_FILES['images']['tmp_name'];
        $update_image_folder = 'images/'.$images;
        move_uploaded_file($update_image_tmp_name, $update_image_folder);
        $images = $update_image_folder;

         
        $query ="SELECT * FROM `jobinfo` WHERE location = '$location' AND job = '$job'";
        $select = mysqli_query($conn,$query);

        if(mysqli_num_rows($select) > 0)
        {
            $message[] = 'Post Already ExistS !'; 
        }
        else{
                $insert = mysqli_query($conn, "INSERT INTO `jobinfo`(location,job,salary,job_type, schedule,requirements,qualifications,skills,job_description,image) VALUES('$location','$job','$salary','$jobtype','$schedule','$requirement','$qualification' , '$skill','$desc','$images')");
                

        }

        if($insert){
            $message[] = "Post Added Successful !" ;
         }
         else{
            $message[] = ' Failed to add a Post !';
         }

    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>

    <!-- Css File -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Js File -->
    <script src="js/script.js"></script>

    <style>
        .add_box{
            min-height: 100vh;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding:10px;:
        }

        .add_contain{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction:column;
            background-color:var(--wheat);
            width: 80%;
            padding : 40px 60px;
            border-radius:25px;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
            margin-bottom:80px;
            margin-top:10px;
        }

        form{
            display:flex;
            flex-direction:column;
        }
        
        .input{
            width: 600px;
            border-radius: .5rem;
            margin-bottom: 2.5rem ;
            margin-top: 1rem ;
            background-color: var(--light-bg);
            padding: 1.4rem;
            font-size: 1.6rem;
            color: var(--black);
        }
        
        span{
            text-transform:capitalize;
            color:var(--title-color);
            font-size: 18px;
            font-weight:bold;
            text-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
        }

        .btn{
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
            border-radius:25px;
            background-color: var(--blue);

        }

        .btn:hover
        {
            background-color: var(--dark-blue);
        }
        
        #rm_post{
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
            border-radius:25px;
            background-color:var(--red);
        }
        #rm_post:hover{
            background-color: var(--dark-red);
        }


        @media (max-width:768px){
        .add_box{
            overflow-y:scroll;
        }
        .input{
            width: 200px;
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
                <a href="dashboard.php">dashboard</a>
                <a href="admin.php">Admin Panel</a>
                <a href="#">Add Post</a>
            </nav>

            <a href="logout.php" class="btn" style="margin-top: 0;">Logout</a>

            <img src="images/moon.png" id="icon" class="m-logo" alt="" onclick="color_change()">

        </section>

    </header>

    <!-- header section ends -->

    <section>

    <div class="add_box" >
        <div class="add_contain" >

        <form action="admin_add.php" method="post" enctype="multipart/form-data">

            <center style="margin-bottom:50px;">
                <span style="font-size:2.5rem;">Add a new Post</span><br>
            <?php
            if(isset($message)){
            foreach($message as $message){
               echo '<div class="message" style="color:red; font-size:12px;">'.$message.'</div>';
            }
         }
            ?>
            </center> 
                <span>Job Location : </span>
                <select name="location" id="location1" class="input">
                    <option value="" disabled selected>Location</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Pune">Pune</option>
                    <option value="Banglore">Banglore</option>
                    <option value="Chennai">Chennai</option>
                    <option value="Hyderabad">Hyderabad</option>
                </select>

                <span>Job Title : </span>
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

                <span>Salary : </span>
                <input type="text" name="salary" class="input"
                spellcheck="false" required>

                <span>Job Type : </span>
                <input type="text" name="job_type" class="input"
                spellcheck="false" required>

                <span>Schedule : </span>
                <input type="text" name="schedule" class="input"
                spellcheck="false" required>
                
                <span>Requirement :</span>
                <textarea name="requirement" class="input " spellcheck="false" required placeholder="Insert ' * ' at beginning for every point"></textarea>

                <span>Qualification :</span>
                <textarea name="qualification" class="input " spellcheck="false" required placeholder="Insert ' * ' at beginning for every point"></textarea> 

                <span>Skills : </span>
                <textarea name="skill" class="input " spellcheck="false" required placeholder="Insert ' * ' at beginning for every point"></textarea>

                <span>Description : </span>
                <textarea name="description" class="input " spellcheck="false" required placeholder="Insert ' * ' at beginning for every point"></textarea>

                <span>Upload Image : </span>
                <input type="file" name="images" accept="image/jpg, image/jpeg, image/png" class="input" required>

                <center>
                    <input type="submit" value="add post" name="add_post" class="btn" style="width:200px">
                </center>
                
                    
    </form>
</div>
</div>


        </section>



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