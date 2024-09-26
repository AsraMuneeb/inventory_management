<?php
include('../config.php');

$totalPrice = $_POST['totalPrice'];
$vendorId = $_POST['vendorId'];

$sql = "INSERT INTO purchasemaster (TotalAmount, VendorID) VALUES ('$totalPrice', '$vendorId')";
if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id; 
    echo $last_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
