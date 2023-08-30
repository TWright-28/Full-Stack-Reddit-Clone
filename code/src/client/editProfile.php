<?php
include "../client/header.php";
include "../database/config.php";

if(isset($_SESSION['loggedIn']) & $_SESSION['loggedIn'] == true){
        $username = $_SESSION['userName'];
        $sql = "SELECT * FROM users WHERE userName='$username'";
        

        $result = $conn->query($sql);

        include ("../server/updatingProfile.php");
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
        <title>JEMS-EH</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="./css/index.css" />
        <link rel="stylesheet" href="./css/register.css" />

        </head>


        <body>
        <div class= "container sticky-top rounded-3">
        <div class="container text-right">
            
            <h1>Edit Your Account </h1>
            <div class="row p-1 mb-2 bg-white rounded border">
            <form action="editProfile.php" method="POST" enctype="multipart/form-data">
                <?php include('../client/errors.php'); ?>
                    <div class="form-group text-right">
                    <div class="row p-1 mb-2 bg-white rounded border">
                        
                            <label for="firstName" class = "mb-1"><h2>First Name</h2></label>
                            <input type="text" name = "firstName" class = "mb-1"/>
                            <br>
                         
                            
                            <label for = "lastName" class = "mb-1"><h4>Last Name</h4></label>
                            <input type="text" name = "lastName" class = "mb-1"/>
                            <br>

                            <label for="email"  class = "mb-1"><h4>Email</h4></label>
                            <input type="text" name="email" class = "mb-1"> 
                            <br>
                        
                            <label for="password1"  class = "mb-1"><h4>Password</h4></label>
                            <input type="text" name="password1" class = "mb-1">

                            <label for="password2"  class = "mb-1"><h4>Re-enter your new Password</h4></label>
                            <input type="text" name="password2" class = "mb-1">
                            <br>
                            <label for="image"  class = "mb-1"><h4>Profile Picture</h4></label>
                            <input type="file" name="image" class = "mb-1">
                            
                                            
                            <br>
                            <div class="input-group btn">
                            <button type="submit" class="btn" name="submit">Submit</button>
                            </div>          
                    </div>
                    </div>
                </form>
        
        
            </div>
        </div>
        </div>
        </body>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
        </html>
        <?php
            }
            else{
                header("../server/login.php");
            }
        ?>
    