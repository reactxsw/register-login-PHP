<?php 
    session_start();
    include('server.php');
    
    $errors = array();

    if (isset($_POST['setting'])) {
        unset($_SESSION['error']);
        $current_username = mysqli_real_escape_string($connect, $_SESSION['username']);
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        if (empty($username)) {
            array_push($errors, "Username is required");
            $_SESSION['error'] = "Username is required";

        } else {
            $query = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username' LIMIT 1");
            $result = mysqli_fetch_assoc($query);
            if ($result) {
                array_push($errors, "Username already exists");
                $_SESSION['error'] = "Username already exists";

            }
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $sql = "UPDATE user SET displayname='$username' WHERE username='$current_username'";
            if (mysqli_query($connect, $sql)) {
                echo "Record updated successfully";
                $_SESSION['username'] = $username;
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