<?php
    include("connection.php");
    $pid=$_GET['plan_id'];
    $q=mysqli_query($con,"delete from plan_master where plan_id=$pid");
    if($q)
        header('location:view_plan_master.php');
    else
        echo "not deleted";
?>