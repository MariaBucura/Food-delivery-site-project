<?php
    session_start();
    $message = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $conn = mysqli_connect('localhost', 'root', '', 'DelishDrop') or die("Connection Failed: " .mysqli_connect_error());
        if(isset($_POST['old-password']) && isset($_POST['new-password'])){
            $username = $_SESSION['username'];
            $old_password = $_POST['old-password'];
            $new_password = $_POST['new-password'];

            $sql = "SELECT * FROM user WHERE username = '$username'";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($query);
            if($row){
                $storedPasswordSaltHash = $row['password'];
                list($storedPasswordHash, $storedSalt) = explode(':', $storedPasswordSaltHash);
                $passwordWithSalt = $old_password . $storedSalt;
                if (password_verify($passwordWithSalt, $storedPasswordHash)){
                    $salt = bin2hex(random_bytes(16));
                    $new_password_salt = $new_password . $salt;
                    $hashed_new_password = password_hash($new_password_salt, PASSWORD_BCRYPT);

                    $sql_password = "UPDATE user SET password = '$hashed_new_password:$salt' WHERE username = '$username'";
                    $query = mysqli_query($conn, $sql_password);
                    $message = "Password updated successfully!";
                    $_SESSION['password-message'] = $message;
                    header("Location: accountsettings.php");
                    exit();
                }else{
                    $message = "Incorrect password!";
                    $_SESSION['password-message'] = $message;
                    header("Location: accountsettings.php");
                    exit();
                }
            }else{
                $message = "Error updating password.";
                $_SESSION['password-message'] = $message;
                header("Location: accountsettings.php");
                exit();
            }
        }
        $conn->close();
    }
?>