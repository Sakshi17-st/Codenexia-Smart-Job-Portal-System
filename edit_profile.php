<?php

include 'config.php';
session_start();
// error_reporting(0);

$user_id = $_SESSION['user_email'];

if(isset($_POST['update_profile'])){

   $update_name =$_POST['update_name'];
   $update_address =mysqli_real_escape_string($conn,$_POST['update_add']);
   $update_decript =mysqli_real_escape_string($conn,$_POST['update_desc']);
   $update_quali =mysqli_real_escape_string($conn,$_POST['update_quali']);
   $update_skills =mysqli_real_escape_string($conn,$_POST['update_skills']);

   mysqli_query($conn, "UPDATE `userinfo` SET name = '$update_name', address = '$update_address' , description = '$update_decript' , qualification = '$update_quali' , skills = '$update_skills' WHERE email = '$user_id'");
    $message[]="Profile edited Successfully!";

   $old_pass = $_POST['old_pass'];
   $update_pass = $_POST['update_pass'];
   $new_pass = $_POST['new_pass'];
   $confirm_pass = $_POST['confirm_pass'];

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = '*old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = '*confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `userinfo` SET password = '$confirm_pass' WHERE email = '$user_id'");
         $message[] = '*password updated successfully!';
      }
   }

   // Uploading images
   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'Temp_img/'.$update_image;
   
   if(!empty($update_image)){
      if($update_image_size > 20000000){
         $message[] = '*image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `userinfo` SET image = '$update_image' WHERE email = '$user_id'");
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = '*image updated succssfully!';
      }
   }
   // Uploading images
   
   // Uploading Resume
   $update_cv = $_FILES['update_cv']['name'];
   $update_cv_size = $_FILES['update_cv']['size'];
   $update_cv_tmp_name = $_FILES['update_cv']['tmp_name'];
   $update_cv_folder = 'Temp_file/'.$update_cv;
   
   if(!empty($update_cv)){
      if($update_cv_size > 20000000){
         $message[] = '*Document size is too large';
      }else{
         $cv_update_query = mysqli_query($conn, "UPDATE `userinfo` SET resume = '$update_cv' WHERE email = '$user_id'");
         if($cv_update_query){
            move_uploaded_file($update_cv_tmp_name, $update_cv_folder);
         }
         $message[] = '*CV updated succssfully!';
      }
   }
   // Uploading Resume


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>

        .update-profile{
            min-height: 100vh;
            background-color: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding:10px;:
        }

        .update-box{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction:column;
            background-color:var(--wheat);
            padding : 40px 60px;
            border-radius:25px;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
            margin-bottom:80px;
            margin-top:10px;
        }

        form{
            display:flex;
            flex-direction:column;
            /* text-align:center; */
            align-items: center;
            justify-content: center;
        }

        .img{
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
            height: 250px;
            width: 250px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom:40px; 
        }

        .input{
            width: 100%;
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

        #cv{
         width:50rem;
         height:50rem;
         display:none;
         margin-bottom:50px; 
         box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
        }

        @media (max-width:768px){
        #cv{
         width:25rem;
         height:25rem;
         object-fit: cover;
         overflow-y:none;
        }
      }

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

    <section>

<div class="update-profile">

   <?php
      $select = mysqli_query($conn, "SELECT * FROM `userinfo` WHERE email = '$user_id'");
      $result = mysqli_num_rows($select);
      if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select);
      }
   ?>
    <div class='update-box'>
   <form action="edit_profile.php" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/user2.png" class="img">';
         }else{
            echo '<img src="Temp_img/'.$fetch['image'].'" class="img">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message" style="color:red; font-size:12px;">'.$message.'</div>';
            }
         }
      ?>
      <div class="flex">
         <div class="inputBox">
            <span>username :</span>
            <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="input" spellcheck="false">

            <span>update your pic :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="input">

            <span>your Address :</span>
            <input type="text" name="update_add" value="<?php echo $fetch['address']; ?>" class="input" spellcheck="false">

            <span>Qualification :</span>
            <textarea name="update_quali" class="input " spellcheck="false"><?php echo $fetch['qualification']; ?></textarea>

            <span>Skills :</span>
            <textarea name="update_skills" class="input " spellcheck="false"><?php echo $fetch['skills']; ?></textarea>

            <span>Description :</span>
            <textarea name="update_desc" class="input " spellcheck="false"><?php echo $fetch['description']; ?></textarea>
            
            <span >update your CV : </span><p style="color:red; font-size:1.5rem; display:inline;">(*Please Upload a PDF doument only)</p>
            <input type="file" name="update_cv" accept="application/pdf" class="input">
            <?php
            $tmp_cv = $fetch['resume'];
            if(!empty($tmp_cv)){
            ?>
            <a id="view-cv" class="back" style="cursor:pointer; color:blue" onclick="cv_view()">View CV</a><br><br><br><br>
            <?php
            echo '<center style="margin-bottom:10px;"><object id="cv"data="Temp_file/'.$fetch['resume'].'"></object></center>';
            echo '<script> function cv_view(){
               var x = document.getElementById("cv");
               var v = document.getElementById("view-cv")
               if (x.style.display === "flex") {
                 x.style.display = "none";
                 v.innerHTML="View CV";
                  }
                  else{
                 x.style.display = "flex";
                 v.innerHTML="View Less";
               }
            }</script>';
            ?>
        <?php }?>
         </div>

         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="input" maxlength="8" minlength="8">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="input" maxlength="8" minlength="8">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="input" maxlength="8" minlength="8">
         </div>
      </div>
      <br>
      <input type="submit" value="update profile" name="update_profile" class="btn">
      <a class="back" href="profile.php" class="delete-btn">&lt; Go Back</a>
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
                <a href="http://youtube"><i class="fab fa-youtube"></i> youtube</a>
            </div>
        
        </section>
        
        <div class="credit">&copy; copyright @2023 by <span> The RMCS group </span> | all right reserved!</div>
        
        </footer>
        
        <!-- footer section ends  -->

</body>
</html>