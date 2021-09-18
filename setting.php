<?php
session_start();
include ('server.php');

if (!isset($_SESSION['username']))
{
    header('location: login.php');
}

if (isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>setting Page</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
   </head>
   <body>
      <form enctype="multipart/form-data" action="setting_db.php" method="post">
         <?php include ('error.php'); ?>
         <div class="container">
         <label>
            <h2 class="header">Setting</h2>
            <div class="setting">Username</div>
            <input type="text" class = "setting" name="displayname" value="<?php echo $_SESSION["displayname"]; ?>"/>
         </label>  
         <br>
         <label>
         <div class="setting">Bio</div>
            <textarea id="bio" name="bio" rows="4" cols="50" placeholder="about me"></textarea>    
            <br>
            <div id="characters"></div>
         </label>
         <br>
         <label>
            <input type="file" name="image"/> 
         </label> 
         <?php if (isset($_SESSION['error'])): ?>
         <div class="error">
            <?php
    echo '<span style="color:red;">' . $_SESSION['error'] . "</span>";
    unset($_SESSION['error']);
?>
         </div>
         <?php
endif ?>
         <div class="input-group">
            <button type="submit" name="setting" value="Submit" >save</button>
            <?php if (isset($_SESSION['save'])): ?>
               <?php
    echo $_SESSION["save"];
    unset($_SESSION['save']);
?>
            <?php
endif ?>
         </div>
         <p><a href="index.php">Home</a></p>
      </form>
      <script src="assets/javascript/bio.js"></script>

   </body>
</html>
