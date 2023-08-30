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
  if(isset($_SESSION['loggedIn']) & $_SESSION['loggedIn'] == 'true'){
    $userName = $_SESSION['userName'];
    $parentID = $_GET['id'];
    $threadID = $_GET['threadID'];
    $content = mysqli_real_escape_string($conn, $_POST['content2']);
    


  if (empty($content)) {
    array_push($errors, "Comment cannot be empty");
  }
 

  if (count($errors) == 0) {
  	
    //$query = "INSERT INTO threads (threadID, parentID, content, userName) VALUES('$threadID', '$parentID', '$content', '$userName')";
  
    $sql = "INSERT INTO comments (threadID, parentID, content, userName) VALUES(?,?,?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiss', $threadID, $parentID, $content, $userName);
    $stmt->execute();


  	  header('location: ../client/thread.php?ID='.$threadID);
  	}else {
  		array_push($errors, "There was an error creating the reply");
  	}
  }else{
    header('location: ../server/login.php');
  }
  




?>
