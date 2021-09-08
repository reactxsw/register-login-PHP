<?php 
   session_start();
   include('server.php'); 
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Register Page</title>
      <link rel="stylesheet" href="style.css">
      <script src="https://hcaptcha.com/1/api.js" async defer></script>
   </head>
   <body>
      <form action="register_db.php" method="post">
         <?php include('error.php'); ?>
         <div class="container">
         <label>
            <h2 class="header">Register</h2>
            <div class="register">Username</div>
            <input type="text" class = "register" name="username">
         </label>
         <label>
            <div class="register">Email</div>
            <input type="text" class = "register" name="email">
         </label>
         <label>
             <div class="register">password</div>
            <input type="password" class = "register"  name="password">
         </label>
         <label>
            <div class="register">corfirm password</div>
            <input type="password" class = "register"  name="password_confirm">
         </label>
            <div class="h-captcha" data-sitekey="9786a494-a34e-4b7f-ad50-487eeee47f7e"></div>
            
         <?php if (isset($_SESSION['error'])) : ?>
         <div class="error">
            <?php 
               echo '<span style="color:red;">'.$_SESSION['error']."</span>";
               unset($_SESSION['error']);
               ?>
         </div>
         <?php endif ?>
         <div class="input-group">
            <button type="submit" name="register" value="Submit" >Register</button>
         </div>
         <p>Already a member? <a href="login.php">Sign in</a></p>
      </form>
   </body>
</html>