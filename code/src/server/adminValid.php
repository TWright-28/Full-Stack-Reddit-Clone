<?php
include "../database/config.php";
$errors = array(); 
if (isset($_POST['adminLog'])) {
    // receive all input values from the form
    $adminKey = mysqli_real_escape_string($conn, $_POST['adminKey']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if (empty($adminKey)) {
        array_push($errors, "Admin Key is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {

        $query = "SELECT * FROM admins WHERE adminKey='$adminKey' AND password='$password'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['userName'] = 'Admin';
          $_SESSION['loggedIn'] = "true";
          $_SESSION['admin'] = true;
          header('location: ../client/adminIndex.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

?>