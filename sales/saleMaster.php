<?php
include('../config.php');

$totalPrice = $_POST['totalPrice'];
$CustomerID = $_POST['CustomerID'];

$sql = "INSERT INTO salesmaster (TotalAmount, CustomerID) VALUES ('$totalPrice', '$CustomerID')";
if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id; 
    echo $last_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
