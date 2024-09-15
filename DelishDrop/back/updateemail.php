<?php
    $message = "";
    session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
        $conn = mysqli_connect('localhost', 'root', '', 'DelishDrop') or die("Connection Failed: " .mysqli_connect_error());
        if(isset($_POST['email'])){
            $new_email = $_POST['email'];
            $username = $_SESSION['username'];
            if (filter_var($new_email, FILTER_VALIDATE_EMAIL)){
                $sql = "UPDATE user SET email = '$new_email' WHERE username = '$username' ";
                $query = mysqli_query($conn, $sql);
            if($query){
                $message = "email updated successfully!";
                $_SESSION['message'] = $message;
                header("Location: accountsettings.php");
                exit();
            }else{
                $message = "Error updating email.";
                $_SESSION['message'] = $message;
                header("Location: accountsettings.php");
                exit();
            }
            }else{
                $message = "Invalid email adress.";
                $_SESSION['message'] = $message;
                header("Location: accountsettings.php");
                exit();
            }
        }
        $conn->close();
    }
?>