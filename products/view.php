<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

<?php
include('../config.php');
include('../session.php');
include('../templates/header.php');

$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h5>Stock   <a style='color:red;font-size:20px;text-decoration:none' href='/inventory_management/products/addproducts.php'>+</a> </h5><hr/>";
    echo "<table class='table ' id='invTable'>";
    echo "<thead><tr><th>Product Id</th><th>Product Name</th><th>Quantity In Stock</th><th>Unit Price</th></tr></thead>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ProductID"] . "</td>";
        echo "<td>" . $row["ProductName"] . "</td>";
        echo "<td>" . $row["QuantityInStock"] . "</td>";
        echo "<td>" . $row["UnitPrice"] . "</td>";
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