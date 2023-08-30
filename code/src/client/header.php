<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include "../database/config.php";
if(isset($_SESSION['loggedIn'])){
   $userName = $_SESSION['userName'];
   $sql = "SELECT * FROM users  WHERE userName = '$userName';";

   $result = $conn->query($sql);
    $image = '';

   if ($result->num_rows > 0) {
       $info = $result->fetch_assoc();  
       $image = $info['image'];            
   };



echo '

    <!DOCTYPE html>
    <html lang="en">

    <head>
    <title>JEMS-EH</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
    <div class= "mx-2 sticky-top rounded-3">
    <div class="container-fluid sticky-top bg-white rounded-3">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <a href="../client/index.php" class="navbar-brand mb-3 mb-md-0 me-md-auto text-dark">
                <span class="fs-4 p-1 rounded-2 bg-warning me-1">JEMS-EH</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <div>
                    <button class="btn btn-outline-primary mx-1"> <a href="../client/profile.php"> View my Profile </a> </button>
                </div>

                    
                <ul class="navbar-nav nav-pills me-auto my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                    <a href="../client/indexHot.php" class="btn btn-outline-warning text-black mx-1">Hot</a>
                    </li>
                    <li class="nav-item">
                    <a href="../client/indexNew.php" class="btn btn-outline-warning text-black mx-1">New</a>
                    </li>
                    <li class="nav-item">
                    <a href="../client/liked.php" class="btn btn-outline-warning text-black mx-1">Liked</a>
                    </li>
                    <li class="nav-item">
                    <a href="../client/following.php" class="btn btn-outline-warning text-black mx-1">Following</a>
                    </li>
                    <li class="nav-item">
                    <a href="../client/create.php" class="btn btn-outline-warning text-black mx-1">Create New Thread</a>
                    </li>
                    ';
               
                    if( basename($_SERVER['PHP_SELF'], '.php') == 'index' || basename($_SERVER['PHP_SELF'], '.php') == 'searchIndex') {
                        echo '<li class ="nav-item">
                        <form method="GET" action="searchIndex.php">
                            <input type="text" name = "search" class = "m-1" placeholder="Search"/>
                            <label for="filter">Search by:</label>
                            <select name="filter" id="filter">
                                <option value="title">Thread Title</option>
                                <option value="userName">User</option>
                                <option value="category">Category</option>
                            </select>
                            <button type="submit" class="btn btn-secondary m-1" name="submitSearch">Submit</button> 

                        </form>
                        </li>';
                    } 
                    echo '
                </ul>
                <div class="mt-2 text-end"> Welcome back ' . $userName . ' <img src ="'. $image . '" width =50 height =50 ></div>

                <div class = "text-end">
                    <button class="btn btn-outline-primary mx-1"> <a href="../client/logout.php"> LogOut </a> </button>
                </div>
            </div>
        </nav>
    </div>
    </div>
    </body>
    </html>';
}
else {
    echo '
    <!DOCTYPE html>
    <html lang="en">

    <head>
    <title>JEMS-EH</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
    <div class= "sticky-top rounded-3">
    <div class="container-fluid sticky-top bg-white rounded-3">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <a href="../client/index.php" class="navbar-brand mb-3 mb-md-0 me-md-auto text-dark">
                <span class="fs-4 p-1 rounded-2 bg-warning me-1">JEMS-EH</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav nav-pills mx-auto my-2 my-lg-0 navbar-nav-scroll">
                <li class="nav-item">
                <a href="../client/indexHot.php" class="btn btn-outline-warning text-black mx-1">Hot</a>
                </li>
                <li class="nav-item">
                <a href="../client/indexNew.php" class="btn btn-outline-warning text-black mx-1">New</a>
                </li>
                    ';
                    if( basename($_SERVER['PHP_SELF'], '.php') == 'index' || basename($_SERVER['PHP_SELF'], '.php') == 'searchIndex') {
                        echo '<li class ="nav-item">
                        <form method="GET" action="searchIndex.php">
                            <input type="text" name = "search" class = "m-1" placeholder="Search"/>
                            <label for="filter">Search by:</label>
                            <select name="filter" id="filter">
                                <option value="title">Thread Title</option>
                                <option value="userName">User</option>
                                <option value="category">Category</option>
                            </select>
                            <button type="submit" class="btn btn-secondary m-1" name="submitSearch">Submit</button> 

                        <form>
                        </li>';
                    } 
                    echo '
                </ul>
                <div class="col-md-5 text-end">
                    <button type="button" class="btn btn-outline-warning text-black me-2" onclick="loginButton()">Login</button>
                    <button type="button" class="btn btn-outline-warning text-black me-2" onclick="registerButton()">Register</button>
                </div>
            </div>
        </nav>
    </div>
    </div>
    </body>
    </html>';
}
?>
<script src="../client/script/index.js"></script>

