<!DOCTYPE html>
<html>
<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    session_destroy();
}
    header('Location: index.php');
?>
</html>