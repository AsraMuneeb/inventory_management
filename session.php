<?php
  include('config.php');
  session_start();

  if(!isset($_SESSION['login_user'])){
    header("location: ../login.php");
    die();
 }
 else{
  if ($_SESSION['role']=='admin'){
    header("location: ../index.php");

  }
  if ($_SESSION['role']=='user'){
    header("location: ../sales/addSales.php");
  }
 }

?>