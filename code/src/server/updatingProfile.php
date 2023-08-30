<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

// initializing variables
include "../database/config.php";
$username = "";
$email    = "";
$errors = array(); 
$image = "";
include "../client/errors.php";

//Checking that the user is trying to submit and is logged in.
if (isset($_POST['submit'])) {
    if(isset($_SESSION['loggedIn']) & $_SESSION['loggedIn'] == 'true'){
        $username = $_SESSION['userName'];
        // receive all input values from the form

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password2']);

        //Check if any data is empty or incorrect
        if (empty($email)) { array_push($errors, "Email is required"); }
        if (empty($password_1)) { array_push($errors, "Password is required"); }
        if (empty($firstname)) { array_push($errors, "First is required"); }
        if (empty($lastname)) { array_push($errors, "Last Name is required"); }
        if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
        }
        //email validation
        $sqlemail = "SELECT * FROM users WHERE email='$email' and username!='$username'";
        $query = mysqli_query($conn, $sqlemail);
        
        if (mysqli_num_rows($query) > 0) {
            array_push($errors, "That email is already taken");
        } 

        //ImAge validation 
        if($_FILES["image"]["error"] == 4) {
          array_push($errors, "You Need to Upload a Profile Picture");
        }else{
            $target_dir = "../client/images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image"]["tmp_name"]);
              if($check == false) {
                array_push($errors, "You must select an Image");
                }
            
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
            array_push($errors, " You can only upload a JPG, PNG or a JPEG");
            }
        }


        //check if there are errors, if not we update the users information
        if (count($errors) == 0) {

            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $passwordHash = md5($password_1);
            $sql = "UPDATE users SET email=?, password= ?, firstName = ?, lastName=?, image =? WHERE userName=?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssss', $email, $passwordHash, $firstname, $lastname, $target_file, $username);
            $stmt->execute();
            if ($stmt->error) {
                echo "please try again " . $stmt->error;
              }
            else{
                header('location: ../client/index.php');
        
            }
        }
    }
}


?>
