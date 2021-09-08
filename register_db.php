<?php 
    session_start();
    include('server.php');
    
    $errors = array();


    if (isset($_POST['register'])) {
        unset($_SESSION['error']);
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);
        $password_cornfirm = mysqli_real_escape_string($connect, $_POST['password_confirm']);

        if (isset($_POST['submit']) ) {
            $data = array(
                'secret' => "0xEe6aE2ae3931Bd7b6FA2a17490EF89f632fF587D",
                'response' => $_POST['h-captcha-response']
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://hcaptcha.com/siteverify");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $responseData = json_decode($response);
            if(!$responseData->success) {
                echo 'Robot verification failed, please try again.';
            }
        }

        if (empty($password)) {
            array_push($errors, "Password is required");
            $_SESSION['error'] = "Password is required";
        } else {
            if (strlen($password) < 8) {
                array_push($errors, "Password must be atleast 8 letters");
                $_SESSION['error'] = "Password must be atleast 8 letters";
            }
        }

        if (empty($password_cornfirm)) {
            array_push($errors, "Confirm your password");
            $_SESSION['error'] = "Confirm your password";
        }

        if (!empty($password_cornfirm && $password != $password_cornfirm)) {
            array_push($errors, "The two passwords do not match");
            $_SESSION['error'] = "The two passwords do not match";
        }

        if (empty($email)) {
            array_push($errors, "Email is required");
            $_SESSION['error'] = "Email is required";

        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Invalid email");
                $_SESSION['error'] = "Invalid email";
              } else {
                $query = mysqli_query($connect, "SELECT * FROM user WHERE email = '$email' LIMIT 1");
                $result = mysqli_fetch_assoc($query);
                if ($result) {
                    array_push($errors, "email already exists");
                    $_SESSION['error'] = "email already exists";
    
                }
              }
        }
        
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

        if (!count($errors) > 0) {
            $password = md5($password);

            $sql = "INSERT INTO user (username, displayname, email, password) VALUES ('$username', '$username', '$email', '$password')";
            if ($sql) {
                mysqli_query($connect, $sql);

                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');

            }

        } else {
            header("location: register.php");
        }
    }
?>