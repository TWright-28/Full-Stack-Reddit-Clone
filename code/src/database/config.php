<?php


// $serverName = "localhost";
// $username = "root";
// $password = "";
// $dbname = "mydb";

// $conn = new mysqli($serverName, $username, $password, $dbname);

// if($conn->connect_error){
//    die("Connection Error " . $conn->connect_error);
// }



// 360 CONNECTION 

    $serverName = "";
   $username = "";
    $password = "";
    $dbname = "";

   $conn = new mysqli($serverName, $username, $password, $dbname);

   if($conn->connect_error){
      die("Connection Error " . $conn->connect_error);
   }

?>
