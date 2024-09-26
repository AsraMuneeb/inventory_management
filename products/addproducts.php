<?php

include('../config.php');
include('../session.php');
include('../templates/header.php');

$sqlCategories = "SELECT * FROM Categories";
$resultCategories = $conn->query($sqlCategories);


$sqlVendors = "SELECT * FROM vendors";
$resultVendors = $conn->query($sqlVendors);

?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["productName"];
    $description = $_POST["description"];
    $quantityInStock = $_POST["quantityInStock"];
    $unitPrice = $_POST["unitPrice"];
    $vendorID = $_POST["vendorID"];
    $categoryID = $_POST["categoryID"];

    // Check if the product name already exists
    $checkProductQuery = "SELECT * FROM Inventory WHERE ProductName = '$productName'";
    $resultProduct = $conn->query($checkProductQuery);

    if ($resultProduct->num_rows > 0) {
        echo "Error: Product name already exists. Please choose a different name.";
    } else {
        // If product name is unique, proceed with the insertion
        $sql = "INSERT INTO Inventory (ProductName, Description, QuantityInStock, UnitPrice, ReorderLevel, VendorID, CategoryID) 
                VALUES ('$productName', '$description', '$quantityInStock', '$unitPrice', '0', '$vendorID', '$categoryID')";

        if ($conn->query($sql) === TRUE) {
            echo "New product created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>


<h5>Create Product</h5>
<br>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="productName">Product Name:</label>
    <input class="form-control col-md-6"  style="width:40%;" type="text" name="productName" required><br>

   
    <label for="quantityInStock">Quantity in Stock:</label>
    <input class="form-control col-md-6"  style="width:40%;" type="number" name="quantityInStock" required><br>

    <label for="unitPrice">Unit Price:</label>
    <input class="form-control col-md-6"  style="width:40%;" type="text" name="unitPrice" required><br>

    <label for="description">Description:</label>
    <textarea  class="form-control col-md-6"  style="width:40%;" name="description" rows="4" required></textarea><br>


    <label for="vendorID">Vendor</label>
    <select class="form-control col-md-6"  style="width:40%;" name="vendorID" required>
        <?php
        while ($row = $resultVendors->fetch_assoc()) {
            echo "<option class='khalid' value='" . $row["VendorID"] . "'>" . $row["VendorName"] . "</option>";
        }
        ?>
    </select><br>


    <label for="categoryID">Category:</label>
    <select class="form-control col-md-6"  style="width:40%;" name="categoryID" class="id" required>
        <?php
        while ($row = $resultCategories->fetch_assoc()) {
            echo "<option value='" . $row["CategoryID"] . "'>" . $row["CategoryName"] . "</option>";
        }
        ?>
    </select><br>

    <input type="submit" class="btn btn-success" value="Create Product">
</form>
