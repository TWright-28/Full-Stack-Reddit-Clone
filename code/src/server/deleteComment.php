<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include "../database/config.php";

    if(isset($_GET['id']) & isset($_GET['threadID']) & isset($_SESSION['loggedIn']) & $_SESSION['loggedIn'] == 'true'){
        $userName = $_SESSION['userName'];
        $commentId = $_GET['id'];
        $threadID = $_GET['threadID'];

        $sql = "UPDATE comments SET content ='This comment has been deleted' WHERE id=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $commentId);
        $stmt->execute();
        if ($stmt->error) {
            echo "please try again " . $stmt->error;
          }
        else{
        
            header('location: ../client/thread.php?ID=' . $threadID);
        }
}