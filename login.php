<form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
</form>


<?php
   include("config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE Username = '$username' and Password = '$password'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    echo $row['UserRole'];
    $count = mysqli_num_rows($result);

    if($count == 1) {
        $_SESSION['login_user'] = $username;
        $_SESSION['role'] = $row['UserRole'];
        if ($_SESSION['role']=='admin'){
            header("location: index.php");
        
          }
          else {
            header("location: sales/addSales.php");
          }
    }
    else{
        echo "<p>Invalid Credentials</p>";
        
    }
   }

   ?>