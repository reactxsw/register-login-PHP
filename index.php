<?php 
    session_start();
    include('server.php'); 

    if (!isset($_SESSION["username"])) {
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
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

    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="homeheader">
        <h2>Home Page</h2>
    </div>

    <div class="homecontent">
        <?php
            if ($_SESSION["profile"] == "blank"){
                $img_path = 'assets/img/blank.png';

            } else {
                $filename = 'm'.$_SESSION["id"];
                $img_path = 'assets/img/profile/'.$filename.'.png';
            }
        ?>    

        <?php if (isset($_SESSION['displayname'])) : ?>
            <img src="<?php echo $img_path; ?>" style="width:125px; height:125px;"/>
            <p>Welcome   <?php echo $_SESSION["displayname"]; ?></p>
            <p>Welcome   <?php echo $_SESSION["id"]; ?></p>
            <p>Welcome   <?php echo $_SESSION["profile"]; ?></p>
            <p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
            <p><a href="setting.php" style="color: black;">Setting</a></p>

        <?php endif ?>
    </div>

</body>
</html>
