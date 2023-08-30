<?php

    include "../client/header.php";
    include "../database/config.php";
    include "../server/createComment.php";
    $threadID = $_GET['ID'];
    $sql = "SELECT * FROM threads WHERE id = '$threadID';";
    $result = $conn->query($sql);

    $commentsAll = "SELECT * FROM comments WHERE threadId = '$threadID';";
    $commentResults = $conn->query($commentsAll);
    $loggedin = false;
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']=='true'){
      $loggedin = true;
    }
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
  <div class= "container sticky-top rounded-3 mt-2">
  <div class="container">
    <h1></h1>
    <div class="row p-1 mb-2 bg-white rounded border">
        <table class="table">
        <tbody> 
            <?php
                if ($result->num_rows > 0) {
                    $thread = $result->fetch_assoc();
            ?>
                        <tr>
                        <?php
                            $rowID = $thread['id'];
                            $getLikes = "SELECT * FROM likes WHERE threadID='$rowID';";
                            $likeList = $conn->query($getLikes);
                            $toDisplayImage = 'bi bi-heart';
                            if (!$loggedin) {
                                $toDisplayImage = 'bi bi-heart disabled';
                            } else if ($likeList->num_rows > 0) {
                                while($liked = $likeList->fetch_assoc()) {
                                    if ($liked['userID'] == $_SESSION['userID']) {
                                        $toDisplayImage='bi bi-heart-fill';
                                    }
                                }
                            }
                        ?>
                        <td><h2><?php echo $thread['title']; ?></h2></td>
                        <td>Author: <?php echo $thread['userName']; ?></td>
                        <td>
                            <?php if ($thread['userName']==$_SESSION['userName']) { ?>
                                <span>Likes:</span>
                            <?php } else { ?>
                            <form onsubmit="like(<?php echo $thread['id']?>)" action="#">
                                <button type="submit" id="heart" class="<?php echo $toDisplayImage?>" name="ID" value="<?php echo $thread['id']?>"></button>
                            </form>
                            <?php } ?>
                            <span id="numLikes" class="ms-3"><?php echo $likeList->num_rows ?></span>
                        </td>
                        </tr>
            <?php
            
            }
            ?>                
        </tbody>
        </table>
        <div> 
            <span><h6>Description:</h6></span>
            <?php echo $thread['description']; ?>
        </div>
    </div>
    <div class="row p-1 mb-2 bg-white rounded border">
        <table class="table table-bordered">
            <thead>
                <h3>Comments: </h3>
            </thead>
            <button class="btn btn-warning col-2 mb-1" type="button" data-bs-toggle="collapse" data-bs-target="#newComment">Comment</button>
            <div class="collapse width" id="newComment">
                    <form action="thread.php?ID=<?php echo $thread['id'] ?>" method="POST">
                        <textarea class="col-12" placeholder="Your comment here..." id="content" name="content"></textarea>
  	                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            <tbody>
                <?php
                    if ($commentResults->num_rows > 0) {
                        while ($row = $commentResults->fetch_assoc()) {
                ?>
                    <tr>
                        <button class="btn" data-bs-toggle="collapse" data-bs-target="#comments">
                            <div>
                                
                                <p class="col-1 text-primary"><?php echo $row['username']; ?></p>
                                <p class="col-12"><?php echo $row['content']; ?></p>                                
                            </div>
                        </button>
                        <?php
                            if (isset($_SESSION['userName'])) {
                                    if($row['username'] == $_SESSION['userName']){?>
                                        <a class="btn btn-danger" href="../server/deleteComment.php?id=<?php echo $row['id']; ?>&threadID=<?php echo $row['threadID']; ?>">Delete</a>          
                                    <?php } ?>
                        <?php if($row['username'] != $_SESSION['userName']){?>

                            <button class="btn btn-warning text-center col-2 mb-1" type="button" data-bs-toggle="collapse" data-bs-target="#newComment2">Reply</button>
                            <div class="collapse width" id="newComment2">
                            <form action="../server/replyComment.php?id=<?php echo $row['id']; ?>&threadID=<?php echo $row['threadID'];?>" method="POST">
                                <textarea class="col-12" placeholder="Your Reply here..." id="content2" name="content2"></textarea>
  	                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                            </div>
         
                        <?php } ?>
                    </tr>                       
                 <?php
                            }
                        }
                    }
                ?> 
            </tbody>
        </table>
    </div>
  </div>
</div>
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
  integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<script src="./script/index.js"></script>
<script>
function like(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        const response = JSON.parse(this.responseText);
        document.getElementById("heart").className=response.class;
        document.getElementById("numLikes").innerHTML=response.likes;
      }
    };
    xmlhttp.open("GET", "../server/likePost.php?liked="+id, true);
    //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}
</script>
</html>