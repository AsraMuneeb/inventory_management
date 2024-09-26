<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

<?php
include('../config.php');
include('../session.php');
include('../templates/header.php');

$sql = "SELECT * FROM salesmaster";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h5>Sales  <a style='color:red;font-size:20px;text-decoration:none' href='/inventory_management/sales/addsales.php'>+</a></h5><hr/>";
    echo "<table class='table ' id='invTable'>";
    echo "<thead><tr><th>Sale Id</th><th>Sale Date</th><th>Customer</th><th>Amount</th><th>Actions</th></tr></thead>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["SaleID"] . "</td>";

        $q = "select * from customers where CustomerID = ".$row['CustomerID'];
        $r = $conn->query($q);
        $cusRow = $r->fetch_assoc();


        echo "<td>" . $row["SaleDate"] . "</td>";
        echo "<td>" . $cusRow["CustomerName"] . "</td>";
        echo "<td>" . $row["TotalAmount"] . "</td>";
        echo "<td><a href='/inventory_management/sales/bill.php?p_id=". $row["SaleID"]."' style='heigh:30px;width:100px;font-size:10px;' class='btn btn-info'>View Receipt</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No product found.";
}
$conn->close();
?>
<script>
        $(document).ready( function () {
            $('#invTable').DataTable();
        });
    </script>