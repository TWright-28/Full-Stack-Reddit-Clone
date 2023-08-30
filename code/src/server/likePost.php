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
if (isset($_REQUEST['liked'])){
  if(isset($_SESSION['loggedIn']) & $_SESSION['loggedIn'] == 'true'){
    $threadID = $_REQUEST['liked'];
    $userID = $_SESSION['userID'];
    $getLikes = "SELECT * FROM likes WHERE threadID='$threadID';";
    $likeList = $conn->query($getLikes);
    $alreadyLiked = false;
    $numLikes = $likeList->num_rows;
    if ($numLikes > 0) {
        while($liked = $likeList->fetch_assoc()) {
            if ($liked['userID'] == $userID) {
                $alreadyLiked = true;
            }
        }
    }
    if (count($errors) == 0) {
        $res = new stdClass();
        if ($alreadyLiked) {
            $sql = "DELETE FROM likes WHERE threadID=? AND userID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $threadID, $userID);
            $stmt->execute();
            $res->class = "bi bi-heart";
        } else {
            $sql = "INSERT INTO likes (threadID, userID) VALUES(?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $threadID, $userID);
            $stmt->execute();
            $res->class = "bi bi-heart-fill";
        }
        $getLikes = "SELECT * FROM likes WHERE threadID='$threadID';";
        $likeList = $conn->query($getLikes);
        $alreadyLiked = false;
        $numLikes = $likeList->num_rows;
        $res->likes=$numLikes;
        
        $myJSON = json_encode($res);
        echo $myJSON;
  	    //header("location: ../client/thread.php?ID=".$threadID);
  	}else {
  		array_push($errors, "There was an error creating the comment");
  	}
  }else{
    //header('location: ../server/login.php');
  }
  
}

?>