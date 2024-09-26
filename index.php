<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

<?php
include('config.php');
include('session.php');
include('templates/header.php');


$sql = "SELECT SUM(TotalAmount) AS total_sum FROM salesmaster";
$result = $conn->query($sql);
$result = $result->fetch_assoc();

$sql2 = "SELECT SUM(TotalAmount) AS total_sum FROM purchasemaster";
$result2 = $conn->query($sql2);
$result2 = $result2->fetch_assoc();


$sql3 = "SELECT COUNT(*) AS customer_count FROM customers";
$result3 = $conn->query($sql3);
$result3 = $result3->fetch_assoc();

$sql4 = "SELECT COUNT(*) AS cat_count FROM categories";
$result4 = $conn->query($sql4);
$result4 = $result4->fetch_assoc();

$sql5 = "SELECT COUNT(*) AS pro_count FROM inventory";
$result5 = $conn->query($sql5);
$result5 = $result5->fetch_assoc();

$sql6 = "SELECT COUNT(*) AS ven_count FROM vendors";
$result6 = $conn->query($sql6);
$result6 = $result6->fetch_assoc();

$sql7 = "SELECT COUNT(*) AS us_count FROM users";
$result7 = $conn->query($sql7);
$result7 = $result7->fetch_assoc();


?>


<div class="container">
    <div class="row">
        <div class="col-md-3">
        <div class="card p-5">
        <h6 class="mb-2">Sales</h6>        
        <h3><span style="font-size:12px;">PKR</span> <?php echo $result['total_sum'];?></h3>        
        </div>
    </div>


    <div class="col-md-3">
        <div class="card p-5">
        <h6>Purchase</h6>        
        <h4><span style="font-size:12px;">PKR</span> <?php echo $result2['total_sum'];?></h4>        
        </div>
    </div>


    <div class="col-md-3">
        <div class="card p-5">
        <h6>Customers</h6>        
        <h4> <?php echo $result3['customer_count'];?></h4>        
        </div>
    </div>


    
    <div class="col-md-3">
        <div class="card p-5">
        <h6>Categories</h6>        
        <h4> <?php echo $result4['cat_count'];?></h4>        
        </div>
    </div>



    
    <div class="col-md-3 mt-2">
        <div class="card p-5">
        <h6>Products</h6>        
        <h4> <?php echo $result5['pro_count'];?></h4>        
        </div>
    </div>

        
    <div class="col-md-3 mt-2">
        <div class="card p-5">
        <h6>Vendors</h6>        
        <h4> <?php echo $result6['ven_count'];?></h4>        
        </div>
</div>


<div class="col-md-3 mt-2">
        <div class="card p-5">
        <h6>Users</h6>        
        <h4> <?php echo $result7['us_count'];?></h4>        
        </div>
</div>


    

</div>
</div>