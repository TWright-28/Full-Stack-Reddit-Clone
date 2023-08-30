<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
    include "../database/config.php";

    if(isset($_GET['id']) & isset($_SESSION['loggedIn']) & $_SESSION['loggedIn'] == 'true'){
        $userName = $_SESSION['userName'];
        $threadId = $_GET['id'];

        $sql = "DELETE FROM threads WHERE id=? and userName=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('is', $threadId, $userName);
        $stmt->execute();
        if ($stmt->error) {
            echo "please try again " . $stmt->error;
          }
        else{
            header('location: ../client/profile.php');
        }
}