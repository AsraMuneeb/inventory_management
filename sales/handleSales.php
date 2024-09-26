<?php



include('../config.php');

$price = $_POST['price'];
$dataId = $_POST['dataId'];
$subtotal = $_POST['subtotal'];
$qty = $_POST['qty'];
$s_id = $_POST['sale_id'];

$sql = "INSERT INTO salesdetail (SaleID, ProductID,QuantitySold,UnitPrice,Subtotal) 
VALUES ('$s_id', '$dataId','$qty','$price','$subtotal')";
if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id; 
    echo $last_id;

    $checkProductQuery = "SELECT * FROM Inventory WHERE ProductID = '$dataId'";
    $resultProduct = $conn->query($checkProductQuery);

    if ($resultProduct->num_rows > 0) {
        $row = $resultProduct->fetch_assoc();
        $currentQty = $row['QuantityInStock'];
        $newQty = $currentQty - $qty;
        $updateQtyQuery = "UPDATE Inventory SET QuantityInStock = '$newQty' WHERE ProductID = '$dataId'";
        if ($conn->query($updateQtyQuery) === TRUE) {
            echo "Quantity updated successfully";
        } else {
            echo "Error updating quantity: " . $conn->error;
        }

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();
?>