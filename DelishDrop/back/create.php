<?php
    session_start();
    $email_error = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        session_start();
        $conn = mysqli_connect('localhost', 'root', '', 'DelishDrop') or die("Connection Failed: " .mysqli_connect_error());
        if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM user WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $username_error = "User already exists!";
                $_SESSION['username_error'] = $username_error;
                $_SESSION['failed_signin'] = true;
                header("Location: " . $_SESSION['current_url']);
                exit();
            }


            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $salt = bin2hex(random_bytes(16));
                $passwordWithSalt = $password . $salt;
                $hashedPassword = password_hash($passwordWithSalt, PASSWORD_BCRYPT);

                $sql = "INSERT INTO User (username, email, password, isAdmin) VALUES ('$username', '$email', '$hashedPassword:$salt', 'no')";
                $query = mysqli_query($conn, $sql);
                if($query){
                    $_SESSION['username'] = $username;
                    setcookie('username', $username, time() + (86400 * 30), "/");
                    header("Location: " . $_SESSION['current_url']);
                    exit();
            } else {
                header("Location: " . $_SESSION['current_url']);
                exit();
            }

            
            }
            else{
                $email_error = "Invalid email adress!";
                $_SESSION['email_error'] = $email_error;
                $_SESSION['failed_signin'] = true;
                header("Location: " . $_SESSION['current_url']);
                exit();
            }
        }

        $conn->close();
    }



?>