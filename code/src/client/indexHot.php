<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
    include "../client/header.php";
    include "../database/config.php";
    $sql = "SELECT threads.id as id, threads.userName as userName, threads.title as title, threads.category as category, threads.familyFriendly as familyFriendly, threads.description, COUNT(likes.threadID) as Likes  FROM threads INNER JOIN likes WHERE threads.id = likes.threadID and friendsOnly = 'no' GROUP BY id ORDER BY Likes DESC;";
    $result = $conn->query($sql);

    
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
    <div class="row p-1 mt-2 mb-2 bg-white rounded border">
    <table class="table">
      <thead>
        <tr>
          <th>User</th>
          <th>Title</th>
          <th>Category</th>
          <th>Family Friendly</th>
          <th>Likes</th>
        </tr>
      </thead>
      <tbody> 
        <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
        ?>
                    <tr>  
                    <?php 
                    if (isset($_SESSION['userName']) && $row['userName'] == $_SESSION['userName']) { ?>
                      <td><?php echo '<a href="profile.php">', $row['userName'],' (you)</a>'; ?></td>
                    <?php } else { ?>
                      <td><?php echo '<a href="indivPage.php?name=',$row['userName'],'">', $row['userName'],'</a>'; ?></td>
                    <?php } ?> 
                    <td><?php echo '<a href="thread.php?ID=' , $row['id'] , '">' , $row['title'] , '</a>'; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['familyFriendly']; ?></td>
                    <td><?php echo $row['Likes']; ?></td>
                    </tr>                       
        <?php
          }
        }
        ?>                
      </tbody>
    </table>
    </div>
  </div>
</div>
</body>

<?php
include "../client/footer.php";
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
  integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<script src="./script/index.js"></script>
</html>