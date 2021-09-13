<?php
session_start();
include ('server.php');

$errors = array();

if (isset($_POST['login_user']))
{
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    if (empty($password) && empty($username))
    {
        array_push($errors, "Username and password is required");
        $_SESSION['error'] = "Username and password is required";
    }
    else
    {
        if (empty($password))
        {
            array_push($errors, "Password is required");
            $_SESSION['error'] = "Password is required";
        }

        if (empty($username))
        {
            array_push($errors, "Username is required");
            $_SESSION['error'] = "Username required";
        }
    }

    if (count($errors) == 0)
    {
        $password = md5($password);
        $query = "SELECT id, username, displayname, email, profile FROM user WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) == 1)
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                $_SESSION['username'] = $row["username"];
                $_SESSION['displayname'] = $row["displayname"];
                $_SESSION["id"] = $row["id"];
                $_SESSION["profile"] = $row["profile"];
            }

            header("location: index.php");
        }
        else
        {
            array_push($errors, "Wrong Username or Password");
            $_SESSION['error'] = "Wrong Username or Password!";
            header("location: login.php");
        }
    }
    else
    {
        header("location: login.php");
    }
}

?>
