<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
    include "../database/config.php";

    if(isset($_GET['id']) & isset($_SESSION['loggedIn']) & $_SESSION['admin'] == 'true'){
        $threadId = $_GET['id'];

        $sql = "DELETE FROM threads WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $threadId);
        $stmt->execute();
        if ($stmt->error) {
            echo "please try again " . $stmt->error;
          }
        else{
            header('location: ../client/adminIndex.php');
        }
}