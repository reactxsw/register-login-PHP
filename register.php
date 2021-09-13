<?php
session_start();
include ('server.php');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Register Page</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
      <script src="https://hcaptcha.com/1/api.js" async defer></script>
   </head>
   <body>
   <div class="container">
      <form action="register_db.php" method="post" autocomplete="off">
         <?php include ('error.php'); ?>
         <div class="container">
         <h1 class="mt-5">Register</h1>
         <hr>
         <div class="col-md-4">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off">
         </div>
         <div class="col-md-4">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <input type="text" class="form-control" name="email" placeholder="Email" autocomplete="off">
         </div>
         <div class="col-md-4">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <input type="password" class = "form-control" name="password" placeholder="Password" autocomplete="off">
         </div>
         <div class="col-md-4">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <input type="password" class = "form-control" name="password_confirm" placeholder="Confirm password" autocomplete="off">
         </div>
         <div class="h-captcha" data-sitekey="9786a494-a34e-4b7f-ad50-487eeee47f7e"></div>
         <?php if (isset($_SESSION['error'])): ?>
         <div class="error">
            <?php
    echo '<span style="color:red;">' . $_SESSION['error'] . "</span>";
    unset($_SESSION['error']);
?>
         </div>
         <?php
endif
?>

         <button type="submit" name="register" class="btn btn-success">Register</button>
         <p>Already a member? <a href="login.php" class="text-decoration-none">Sign in</a></p>
      </form>
         </div>
   </body>
</html>
