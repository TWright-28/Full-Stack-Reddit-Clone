<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../client/css/register.css" />

	<script src="../client/script/register.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
        
<?php
include "../client/header.php";
include('registerUser.php') 
?>

<!DOCTYPE html>
<html>
<head>
  <title>JEMS-EH Register Page</title>
</head>
<body>
  <div class="container header d-flex justify-content-center">
  	<h2>Register</h2>
  </div>
	
  <div class="container d-flex justify-content-center">
	<form name = "mainForm" method="post" action="register.php" enctype="multipart/form-data">
		<?php include('../client/errors.php'); ?>
		<div class="input-group mb-2">
		<input type="text" name="userName" value="<?php echo $username; ?>" placeholder="Username">
		</div>
		<div class="input-group mb-2">
		<input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email Address">
		</div>
		<div class="input-group mb-2">
		<input type="text" name="firstName" placeholder="First Name">
		</div>
		<div class="input-group mb-2">
		<input type="text" name="lastName" placeholder="Last Name">
		</div>
		<div class="input-group mb-2">
		<input type="password" name="password_1" placeholder="Password">
		</div>
		<div class="input-group mb-2">
		<input type="password" name="password_2" placeholder="Confirm Password">
		</div>
		<div class="input-group mb-2">
		<input type="file" name="image" placeholder="Profile Picture">
		</div>
		<div class="input-group mb-2">
		<button type="submit" class="btn btn-primary" name="submit">Register</button>
		</div>

		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
	</form>
  </div>
</body>
</html>

<?php
include "../client/footer.php";
?>