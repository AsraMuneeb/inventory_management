<?php
include('../config.php');
include('../session.php');
include('../templates/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CategoryName = $_POST["CategoryName"];

    $checkUsernameQuery = "SELECT * FROM categories WHERE CategoryName = '$CategoryName'";
    $resultUsername = $conn->query($checkUsernameQuery);

    if ($resultUsername->num_rows > 0) {
        echo "Error: Category already exists. Please choose a different username.";
    } else {
        $sql = "INSERT INTO categories (CategoryName) 
                VALUES ('$CategoryName')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
<h5>Create Categories</h5>
<br>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="username">CategoryName:</label>
    <input class="form-control col-md-6"  style="width:40%;" type="text" name="CategoryName" required><br>

    <input type="submit" value="Create Category" class="btn btn-success">
</form>




