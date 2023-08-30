<?php
include("../client/header.php");
include "../database/config.php";

if(isset($_SESSION['loggedIn']) & $_SESSION['loggedIn'] == true){
        $username = $_SESSION['userName'];
        $sql = "SELECT * FROM users WHERE userName='$username'";
        $result = $conn->query($sql);

        $sql2 = "SELECT * FROM threads WHERE userName='$username'";
        $result2 = $conn->query($sql2);

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
        <div class="container text-center">
            <h1>Your Account </h1>
            <div class="row p-1 mb-2 bg-white rounded border">
            <table class="table">
            <thead>
                <tr>
                <th>Username</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Profile Picture</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                            <tr>
                            <td><?php echo $row['userName']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['firstName']; ?></td>
                            <td><?php echo $row['lastName']; ?></td>
                            <td><img src= '<?php echo $row['image']; ?>' width="100" height="100"></td>
                            </tr>                       
                <?php
                }
                }
                ?>                
            </tbody>
            </table>
            </div>
            <button ><a href="editProfile.php">Edit Profile Information</a></button>
        </div>
        </div>

        <div class= "container sticky-top rounded-3">
        <div class="container text-center">
            <h1>Your Threads </h1>
            <div class="row p-1 mb-2 bg-white rounded border">
            <table class="table">
            <thead>
                <tr>
                <th>Username</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) {
                ?>
                            <tr>
                            <td><?php echo $row['userName']; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td></a>&nbsp;<a class="btn btn-danger" href="deleteThread.php?id=<?php echo $row['id']; ?>">Delete</a></td>           
                            </tr>                       
                <?php
                }
                }
                ?>                
            </tbody>
            </table>
        </div>
        </body>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
        <script src="./script/index.js"></script>
        </html>
        <?php
            }
            else{
                header("../server/login.php");
            }
        ?>
    