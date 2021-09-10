<?php 
    session_start();
    include('server.php');
    
    $errors = array();

    if (isset($_POST['setting'])) {
        unset($_SESSION['error']);
        $username = $_SESSION['username'];
        $displayname = mysqli_real_escape_string($connect, $_POST['displayname']);

        $query = mysqli_query($connect, "SELECT * FROM user WHERE displayname = '$displayname' LIMIT 1");
        $result = mysqli_fetch_assoc($query);
        if (($result) && ($_SESSION["displayname"] != $displayname)) {
            array_push($errors, "name already exists");
            $_SESSION['error'] = "name already exists";
            echo "saved";

        }
        $directory = "assets/img/profile/";
        $filename = 'm'.$_SESSION["id"].'.png';
        $target_file = $directory.$filename; 

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $resize = new ResizeImage($target_file);
            $resize->resizeTo(125, 125, 'exact');
            $resize->saveImage($filename);
        
        } else {
            array_push($errors, "Unable to upload image");
            $_SESSION['error'] = "Unable to upload image";
        }

        if (count($errors) == 0) {
            echo "saved";
            $password = md5($password);
            $sql = "UPDATE user SET displayname='$displayname' WHERE username='$username'";
            if (mysqli_query($connect, $sql)) {
                echo "Record updated successfully";
                $_SESSION['displayname'] = $displayname;
                $_SESSION['success'] = "You are now logged in";
                header('location: setting.php');
            } else {
                echo "Error updating record: " . mysqli_error($conn);
                header('location: setting.php');
            }
            
        } else {
            header("location: setting.php");
        }
    }

?>
