<?php 
    session_start();
    include('server.php'); 

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
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
      <link rel="stylesheet" href="style.css">
   </head>
   <body>
      <form action="setting_db.php" method="post">
         <?php include('error.php'); ?>
         <div class="container">
         <label>
            <h2 class="header">Setting</h2>
            <div class="setting">Username</div>
            <input type="text" class = "setting" name="displayname" value="<?php echo $_SESSION["displayname"];?>"/>
         </label>  
         <br>
         <label>
            <input type="file" name="image"/> 
         </label> 
         <?php if (isset($_SESSION['error'])) : ?>
         <div class="error">
            <?php 
               echo '<span style="color:red;">'.$_SESSION['error']."</span>";
               unset($_SESSION['error']);
               ?>
         </div>
         <?php endif ?>
         <div class="input-group">
            <button type="submit" name="setting" value="Submit" >save</button>
         </div>
         <p><a href="index.php">Home</a></p>
      </form>
      
   </body>
</html>
