<?php
    include("connection.php");
    $pid=$_GET['plandetail_id'];
    $q=mysqli_query($con,"delete from plan_detail where plandetail_id=$pid");
    if($q)
        header('location:view_plan_detail.php');
    else
        echo "not deleted";
?>