<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

// initializing variables
include "../database/config.php";
$username = "";
$email    = "";
$image = "";
$errors = array(); 
include "../client/errors.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// REGISTER USER
if (isset($_POST['submit'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($conn, $_POST['userName']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
  $lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
  $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($firstname)) { array_push($errors, "First is required"); }
  if (empty($lastname)) { array_push($errors, "Last Name is required"); }
  if ($password_1 != $password_2) {
	  array_push($errors, "The two passwords do not match");
  }
     

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE userName='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['userName'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
 
    $target_dir = "../client/images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($_FILES["image"]["error"] == 4) {
      array_push($errors, "You Need to Upload a Profile Picture");
    }else{
        $check = getimagesize($_FILES["image"]["tmp_name"]);
          if($check == false) {
            array_push($errors, "You must select an Image");
            }
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
        array_push($errors, " You can only upload a JPG, PNG or a JPEG");
        }
    }
    
  if (count($errors) == 0) {
    $passwordHash = md5($password_1);
    $sql = "INSERT INTO users (userName, email, password, firstName, lastName, image) VALUES(?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $username, $email, $passwordHash, $firstname, $lastname, $target_file);
    $stmt->execute();

  	$_SESSION['userName'] = $username;
  	$_SESSION['loggedIn'] = "true";
    $user = "SELECT id FROM users WHERE userName='$username'";
    $userID = $conn->query($user)->fetch_assoc();
    $_SESSION['userID'] = $userID['id'];
    
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jemseh.noreply@gmail.com'; //Your Gmail
    $mail->Password = 'ysdvkfifmltvmkuv'; //Your gmail password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('jemseh.noreply@gmail.com');

    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);

    $mail->Subject = "Welcome to Jems-Eh";
    $mail->Body = "Thank you for signing up with Jems-Eh! Your account has successfully been created!";
    $mail->send();


    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }


  	header('location: ../client/index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($conn, $_POST['userName']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $passwordHash = md5($password);
  	$query = "SELECT * FROM users WHERE userName='$username' AND password='$passwordHash';";
  	$results = mysqli_query($conn, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['userName'] = $username;
  	  $_SESSION['loggedIn'] = "true";
      $user = "SELECT id FROM users WHERE userName='$username'";
      $userID = $conn->query($user)->fetch_assoc();
      $_SESSION['userID'] = $userID['id'];
  	  header('location: ../client/index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}


?>
