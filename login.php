<?php
    session_start();
    include('server.php'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="login_db.php" method="post">
        <div class="input-group">
            <h2 class="header">Login</h2>
            <label for="username">Username</label>
            <input type="text" autocomplete='off' name="username">
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" autocomplete='off' name="password">
        </div>
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <p>
                    <?php 
                        echo '<span style="color:red;">'.$_SESSION['error'].'</span>';
                        unset($_SESSION['error']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <div class="input-group">
            <button type="submit" name="login_user" class="btn">Login</button>
        </div>
        <p>Not yet a member? <a href="register.php">Sign Up</a></p>
    </form>

</body>
</html>