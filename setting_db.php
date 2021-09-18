<?php
session_start();
include ('server.php');
$errors = array();

if (isset($_POST['setting']))
{
    unset($_SESSION["error"]);

    if (!empty($_POST["displayname"]))
    {
        $username = $_SESSION["username"];
        $displayname = mysqli_real_escape_string($connect, $_POST['displayname']);
        $query = mysqli_query($connect, "SELECT * FROM user WHERE displayname = '$displayname' LIMIT 1");
        $result = mysqli_fetch_assoc($query);
        if (($result) && ($_SESSION["displayname"] != $displayname))
        {
            array_push($errors, "name already exists");
            $_SESSION["error"] = "name already exists";
            $_SESSION["save"] = "saved";
        }
        else
        {
            if (count($errors) == 0)
            {
                $_SESSION["save"] = "saved";
                $password = md5($password);
                $sql = "UPDATE user SET displayname='$displayname' WHERE username='$username'";
                if (mysqli_query($connect, $sql))
                {
                    $_SESSION["displayname"] = $displayname;
                    header('refresh:0;url=setting.php');
                }
                else
                {
                    header('refresh:0;url=setting.php');
                }

            }
            else
            {
                header('refresh:0;url=setting.php');
            }
        }

        if (!$_FILES["image"]['size'] == 0)
        {
            $name = $_FILES["image"]["name"];
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $allow = array(
                'gif',
                'png',
                'jpg'
            );
            if (in_array($extension, $allow))
            {
                $uploaddir = 'assets/img/profile/';
                $filename = 'm' . $_SESSION["id"] . ".png";
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . $filename))
                {
                    $sql = "UPDATE user SET profile='set' WHERE username='$username'";
                    if (mysqli_query($connect, $sql))
                    {
                        $_SESSION["profile"] = "set";
                        header('refresh:0;url=setting.php');

                    }
                    else
                    {
                        header('refresh:0;url=setting.php');
                    }
                }
                else
                {
                    array_push($errors, "unable to upload image");
                    $_SESSION["error"] = "unable to upload image";
                }
            }
            else
            {
                array_push($errors, "Not support file type");
                $_SESSION["error"] = "Not support file type";

            }
        }
    }
    if (!empty($_POST["bio"])) {
        $bio = mysqli_real_escape_string($connect, $_POST['bio']);
        $sql = "UPDATE user SET bio = '$bio' WHERE username='$username'";
        if (mysqli_query($connect, $sql)) {
            $_SESSION["bio"] = $bio;

        } else {
            array_push($errors, "unable to change bio");
            $_SESSION["error"] = "unable to change bio";
        }
    }
}
?>
