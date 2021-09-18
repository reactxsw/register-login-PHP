<?php
session_start();
include ('server.php');

if (!isset($_SESSION["username"]))
{
    header('location: login.php');
}

if (isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION["username"]);
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
</head>
<body>
        <?php
if ($_SESSION["profile"] == "blank")
{
    $img_path = 'assets/img/blank.png';

}
else
{
    $filename = 'm' . $_SESSION["id"];
    $img_path = 'assets/img/profile/' . $filename . '.png';
}
?>  

    <div class="card" style="width:250px">
        <img class="card-img-top" src="<?php echo $img_path; ?>" alt="Card image" style="width:100%" height="225px">
        <div class="card-body">
            <h4 class="card-title"><?php echo $_SESSION["displayname"]; ?></h4>
            <p class="card-text"><?php echo $_SESSION["bio"]; ?></p>
        </div>
        <div class="card-footer">
            <?php echo $_SESSION["permission"]; ?>
        </div>
    </div>
    <button type="button" onclick="window.location.href='setting.php'" class="btn btn-secondary btn-lg btn-block">Edit profile</button>

            <p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
</body>
</html>
