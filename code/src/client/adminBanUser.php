<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include "../database/config.php";

    if(isset($_GET['id']) & isset($_SESSION['loggedIn']) & $_SESSION['admin'] == 'true'){
        $userName = $_GET['id'];

        $sql = "UPDATE comments SET content ='This Users Comments have been Restricted by an Admin' WHERE userName=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $userName);
        $stmt->execute();
        if ($stmt->error) {
            echo "please try again " . $stmt->error;
          }

        $sql = "DELETE FROM threads WHERE userName=?;";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $userName);
          $stmt->execute();
          if ($stmt->error) {
              echo "please try again " . $stmt->error;
            }
  


        else{
        
            header('location: ../client/adminIndex.php');
        }
}