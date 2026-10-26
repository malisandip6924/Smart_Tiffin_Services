<style>
    .plan-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
        margin-top: 20px;
    }

    .plan-table thead {
        background: linear-gradient(135deg, #ff7043);
        color: #fff;
    }

    .plan-table th {
        padding: 16px;
        text-align: left;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: .5px;
       
    }

    .plan-table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
        font-size: 15px;
        font-size: bold;

    }

    .plan-table img {
        width: 70px;
        height: 70px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid #ddd;
    }

    .status-active {
        background: #d4edda;
        color: #28a745;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
    }

    .status-deactive {
        background: #f8d7da;
        color: #dc3545;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
    }

    .action-btn {
        text-decoration: none;
    }

    .action-btn img {
        width: 32px;
        height: 32px;
        border: none;
        transition: .3s;
    }

    .action-btn img:hover {
        transform: scale(1.2);
    }

    .plan-table tr:nth-child(even) {
        background: #fafafa;
    }
</style>
<?php
    include("header.php");
?>
<?php
     include("connection.php");
    $q=mysqli_query($con,"select * from plan_detail");
    echo "<table class='plan-table'>";
    echo "<thead>";
    echo "<th>Plan Id </th>";
    echo "<th>Plan Details </th>";
    echo "<th>Days </th>";
    echo "<th>charge per Day </th>";
    echo "<th>Select Meal Type </th>";
    echo "<th>Photo </th>";
    echo "<th>Status </th>";
    echo "<th colspan=2> Action </th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
   while($row=mysqli_fetch_array($q))
     {
            echo "<tr>";
            echo "<td>".$row['plandetail_id']."</td>";
            echo "<td>".$row['plan_id']."</td>";
            echo "<td>".$row['days']."</td>";
            echo "<td>".$row['charger_per_day']."</td>";
            echo "<td>".$row['meal_type']."</td>";
            echo "<td><img src='./upload/$row[photo]'width='100' height='100'></td>";
            echo "<td>".$row['status']."</td>";
            echo "<td><a href='edit_plan_detail.php?plandetail_id=$row[0]' class='action-btn'><img src='./assets/img/edit.png' width='70' height='70'></a> </td>";
            echo "<td><a href='delete_plan_detail.php?plandetail_id=$row[0]' class='action-btn'><img src='./assets/img/logdel.png' width='70' height='70'></a> </td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
?>
<?php
    include("footer.php");
?>