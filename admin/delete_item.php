<?php
    include("connection.php");
    $id=$_GET['item_id'];
    $q=mysqli_query($con,"delete from item_master where item_id=$id");
    if($q)
        header('location:view_item.php');
    else
        echo "not deleted";
?>