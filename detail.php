<?php 
include 'config.php';
session_start();

if(isset($_POST['view_more']))
{   
    $location =  $_POST['loc'];
    $job = $_POST['job'];
    $_SESSION['job'] = $job;
    $_SESSION['location'] = $location;
    header('location:All_jobs/view_job.php');
}

?>