<?php
session_start();
include ('server.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <form action="login_db.php" method="post">
        <h1 class="mt-5">Login Page</h1>
        <hr>
        <div class="col-md-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" autocomplete='off' class="form-control" name="username">
        </div>
        <div class="col-md-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" autocomplete='off' class="form-control" name="password">
        </div>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error">
                <p>
                    <?php
    echo '<span style="color:red;">' . $_SESSION['error'] . '</span>';
    unset($_SESSION['error']);
?>
                </p>
            </div>
        <?php
endif ?>
        <br>
        <button type="submit" name="login_user" class="btn btn-success">Login</button>
        <p>Not yet a member? <a href="register.php" class="text-decoration-none">Sign Up</a></p>
    </form>
    </div>

</body>
</html>
