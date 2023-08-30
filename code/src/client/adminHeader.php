<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if(isset($_SESSION['loggedIn']) & $_SESSION['admin'] == true){
   $userName = $_SESSION['userName'];
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
            <a href="../client/adminIndex.php" class="navbar-brand mb-3 mb-md-0 me-md-auto text-dark">
                <span class="fs-4 p-1 rounded-2 bg-warning me-1">JEMS-EH</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
            
                    
                <ul class="navbar-nav nav-pills me-auto my-2 my-lg-0 navbar-nav-scroll">';
                    if( basename($_SERVER['PHP_SELF'], '.php') == 'adminIndex' || basename($_SERVER['PHP_SELF'], '.php') == 'adminSearchIndex') {
                        echo '<li class ="nav-item">
                        <form method="GET" action="adminSearchIndex.php">
                            <input type="text" name = "search" class = "m-1" placeholder="Search"/>
                            <label for="filter">Search by:</label>
                            <select name="filter" id="filter">
                                <option value="title">Thread Title</option>
                                <option value="userName">User</option>
                                <option value="email">email</option>
                                <option value="category">Category</option>
                            </select>
                            <button type="submit" class="btn btn-secondary m-1" name="submitSearch">Submit</button> 

                        <form>
                        </li>';
                    } 
               
                echo '</ul>
                <div class="mt-2 text-end"> Welcome back ' . $userName . '</div>
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
                <ul class="navbar-nav nav-pills mx-auto my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                    <a href="#" class="nav-link active bg-warning text-black">Hot</a>
                    </li>
                    <li class="nav-item">
                    <a href="#" class="nav-link text-black">New</a>
                    </li>
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

