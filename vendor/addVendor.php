<?php
include('../config.php');
include('../session.php');
include('../templates/header.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $VendorName = $_POST["VendorName"];
    $ContactPerson = $_POST["ContactPerson"];
    $ContactNumber = $_POST["ContactNumber"];
    $Email = $_POST["Email"];

    $checkUsernameQuery = "SELECT * FROM vendors WHERE VendorName = '$VendorName'";
    $resultUsername = $conn->query($checkUsernameQuery);

    if ($resultUsername->num_rows > 0) {
        echo "Error: Vendor already exists. Please choose a different Vendor name.";
    } else {
        $sql = "INSERT INTO vendors (VendorName, ContactPerson, ContactNumber, Email) 
                VALUES ('$VendorName', '$ContactPerson', '$ContactNumber', '$Email')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<h2>Create Vendor</h2>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="username">VendorName:</label>
    <input class="form-control" style="width:40%"  type="text" name="VendorName" required><br>

    <label for="password">ContactPerson:</label>
    <input class="form-control" style="width:40%"  type="text" name="ContactPerson" required><br>


    <label for="firstName">ContactNumber:</label>
    <input class="form-control" style="width:40%"  type="text" name="ContactNumber" required><br>


    <label for="lastName">Email:</label>
    <input class="form-control" style="width:40%"  type="email" name="Email" required><br>


    <input class="btn btn-success" type="submit" value="Create User">
</form>




