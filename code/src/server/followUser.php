<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
// initializing variables
include "../database/config.php";
$errors = array(); 
include "../client/errors.php";

// CHECK USER is logged in
if (isset($_REQUEST['follow'])){
  if(isset($_SESSION['loggedIn']) & $_SESSION['loggedIn'] == 'true'){
    $indivName = $_REQUEST['follow'];
    $userID = $_SESSION['userID'];
    $sql = "SELECT id FROM users WHERE userName='$indivName'";
    $result = $conn->query($sql);
    if ($result->num_rows>0) {
        $indiv = $result->fetch_assoc();
        $indivID = $indiv['id'];
    }
    $alreadyFollowing = false;
    $toCheck = "SELECT * FROM friends WHERE userID='$userID';";
    $followList = $conn->query($toCheck);
    if ($followList->num_rows > 0) {
        while($following = $followList->fetch_assoc()) {
            if ($following['friendID'] == $indivID) {
                $alreadyFollowing = true;
            }
        }
    }
    if (count($errors) == 0) {
        if ($alreadyFollowing) {
            $sql = "DELETE FROM friends WHERE userID=? AND friendID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $userID, $indivID);
            $stmt->execute();
            echo 'Unfollowed';
        } else {
            $sql = "INSERT INTO friends (userID, friendID) VALUES(?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $userID, $indivID);
            $stmt->execute();
            echo "Followed";
        }
        
  	    //header("location: ../client/thread.php?ID=".$threadID);
  	}else {
  		array_push($errors, "There was an error creating the comment");
  	}
  }else{
    //header('location: ../server/login.php');
  }
  
}

?>