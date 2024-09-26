<?php
include('../config.php');
include('../session.php');
include('../templates/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $userRole = $_POST["userRole"];

    $checkUsernameQuery = "SELECT * FROM Users WHERE Username = '$username'";
    $resultUsername = $conn->query($checkUsernameQuery);

    $checkEmailQuery = "SELECT * FROM Users WHERE Email = '$email'";
    $resultEmail = $conn->query($checkEmailQuery);

    if ($resultUsername->num_rows > 0) {
        echo "Error: Username already exists. Please choose a different username.";
    } elseif ($resultEmail->num_rows > 0) {
        echo "Error: Email already exists. Please use a different email address.";
    } else {
        $sql = "INSERT INTO Users (Username, Password, FirstName, LastName, Email, UserRole) 
                VALUES ('$username', '$password', '$firstName', '$lastName', '$email', '$userRole')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<h5>Create User</h5>
<br>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="username">Username:</label>
    <input class="form-control" style="width:40%"  type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input class="form-control" style="width:40%" type="password" name="password" required><br>

    <label for="firstName">First Name:</label>
    <input class="form-control" style="width:40%" type="text" name="firstName" required><br>

    <label for="lastName">Last Name:</label>
    <input class="form-control" style="width:40%" type="text" name="lastName" required><br>

    <label for="email">Email:</label>
    <input class="form-control" style="width:40%" type="email" name="email" required><br>

    <label for="userRole">User Role:</label>
    <select class="form-control" name="userRole"  style="width:40%">
    <option value="user">user</option>
    <option value="admin">admin</option>
    </select>

    <br>
    <input type="submit" value="Create User" class="btn btn-success">
</form>




