<?php
session_start();
include('../admin/connection.php');
if (isset($_SESSION['uid']))
    {
$email=$_SESSION['email'];
$uid=$_SESSION['uid'];
$plandetail_id=$_SESSION['plandetail_id'];
$rate=$_SESSION['rate'];
$startdate=date('d/m/Y');
$q=mysqli_query($con,"insert into add_to_cart values('',$uid,$plandetail_id,$rate,'$startdate',0)");
if($q)
    {
    echo "<script>alert('Your plan is added into the cart')
    window.location.assign('checkout.php')</script>";
    }
else
    {
    echo "not inserted";

    }
    }
    else{
        echo "<script>alert('first u have to login');window.location.assign('login.php')</script>";

            }
?>