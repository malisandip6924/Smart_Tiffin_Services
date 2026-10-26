<?php
    include("connection.php");
    $thali_id=$_GET['thali_id'];
    $q=mysqli_query($con,"delete from thali_master where thali_id=$thali_id");
    if($q)
        header('location:view_special.php');
    else
        echo "not deleted";
?>