<?php
include('../config.php');

?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Source Sans Pro', sans-serif;
}

.container {
    display: block;
    width: 100%;
    background: #fff;
    max-width: 350px;
    padding: 25px;
    margin: 50px auto 0;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
}

.receipt_header {
    padding-bottom: 40px;
    border-bottom: 1px dashed #000;
    text-align: center;
}

.receipt_header h1 {
    font-size: 20px;
    margin-bottom: 5px;
    text-transform: uppercase;
}

.receipt_header h1 span {
    display: block;
    font-size: 25px;
}

.receipt_header h2 {
    font-size: 14px;
    color: #727070;
    font-weight: 300;
}

.receipt_header h2 span {
    display: block;
}

.receipt_body {
    margin-top: 25px;
}

table {
    width: 100%;
}

thead, tfoot {
    position: relative;
}

thead th:not(:last-child) {
    text-align: left;
}

thead th:last-child {
    text-align: right;
}

thead::after {
    content: '';
    width: 100%;
    border-bottom: 1px dashed #000;
    display: block;
    position: absolute;
}

tbody td:not(:last-child), tfoot td:not(:last-child) {
    text-align: left;
}

tbody td:last-child, tfoot td:last-child{
    text-align: right;
}

tbody tr:first-child td {
    padding-top: 15px;
}

tbody tr:last-child td {
    padding-bottom: 15px;
}

tfoot tr:first-child td {
    padding-top: 15px;
}

tfoot::before {
    content: '';
    width: 100%;
    border-top: 1px dashed #000;
    display: block;
    position: absolute;
}

tfoot tr:first-child td:first-child, tfoot tr:first-child td:last-child {
    font-weight: bold;
    font-size: 20px;
}

.date_time_con {
    display: flex;
    justify-content: center;
    column-gap: 25px;
}

.items {
    margin-top: 25px;
}

h3 {
    border-top: 1px dashed #000;
    padding-top: 10px;
    margin-top: 25px;
    text-align: center;
    text-transform: uppercase;
}</style>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Sample</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="container">
    
    <div class="receipt_header">
    <h1>Receipt of Sale <span>LOGO HERE</span></h1>
    <h2>Address: Karachi <span></span></h2>
    </div>

    <?php   
    
    include('../config.php');

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];

    $s = "Select * from salesmaster where SaleID = '$p_id'";
    $s = $conn->query($s);
    $s = $s->fetch_assoc();


    $sql = "SELECT * FROM salesdetail WHERE SaleID = '$p_id'";
    
    $result = $conn->query($sql);

   
} else {
    echo "Missing purchase ID parameter";
}


    ?>
    
    <div class="receipt_body">

        <div class="date_time_con">
            <div class="date"><?php echo $s['SaleDate'];?></div>
        </div>

        <div class="items">
            <table>
        
                <thead>
                    <th>QTY</th>
                    <th>ITEM</th>
                    <th>AMT</th>
                </thead>
        
                <tbody>

                <?php
                 if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        $q = "select * from inventory where ProductID = ".$row['ProductID'];
                        $r = $conn->query($q);
                        $inventoryRow = $r->fetch_assoc();
                        echo "<tr>";
                        echo "<td>".$row['QuantitySold']."</td>";
                        echo "<td>".$inventoryRow['ProductName']."</td>";
                        echo "<td>".$row['UnitPrice']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "No records found for purchase ID: $p_id";
                }
                ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td>
            <div class="date">PKR.<?php echo $s['TotalAmount'];?></div>

                        </td>
                    </tr>

                </tfoot>

            </table>
        </div>

    </div>


    <h3>Thank You!</h3>

</div>

</body>
</html>