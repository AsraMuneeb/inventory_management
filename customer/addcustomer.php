<?php

include('../config.php');
include('../session.php');
include('../templates/header.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CustomerName = $_POST["CustomerName"];
    $ContactNumber = $_POST["ContactNumber"];
    $Email = $_POST["Email"];

    $checkUsernameQuery = "SELECT * FROM customers WHERE CustomerName = '$CustomerName'";
    $resultUsername = $conn->query($checkUsernameQuery);

    if ($resultUsername->num_rows > 0) {
        echo "Error: Customer already exists. Please choose a different Vendor name.";
    } else {
        $sql = "INSERT INTO customers (CustomerName, ContactNumber, Email) 
                VALUES ('$CustomerName',  '$ContactNumber', '$Email')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<h5>Create Customer</h5>
<br>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="username">CustomerName:</label>
    <input class="form-control col-md-6"  style="width:40%;" type="text" name="CustomerName" required><br>

    <label for="firstName">ContactNumber:</label>
    <input type="text"  class="form-control col-md-6" style="width:40%;"   name="ContactNumber" required><br>


    <label for="lastName">Email:</label>
    <input type="text"  class="form-control col-md-6" style="width:40%;"   name="Email" required><br>


    <input type="submit" value="Create Customer" class="btn btn-success">
</form>




