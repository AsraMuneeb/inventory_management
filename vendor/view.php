<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

<?php
include('../config.php');
include('../session.php');
include('../templates/header.php');

$sql = "SELECT * FROM vendors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h5>All vendors <a style='color:red;font-size:20px;text-decoration:none' href='/inventory_management/vendor/addVendor.php'>+</a></h5><hr/>";
    echo "<table class='table ' id='customerTable'>";
    echo "<thead><tr><th>Vendor Name</th><th>Contact Person</th><th>ContactNumber</th><th>Email</th></tr></thead>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["VendorName"] . "</td>";
        echo "<td>" . $row["ContactPerson"] . "</td>";
        echo "<td>" . $row["ContactNumber"] . "</td>";
        echo "<td>" . $row["Email"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No vendors found.";
}

$conn->close();
?>
<script>
        $(document).ready( function () {
            $('#customerTable').DataTable();
        });
    </script>