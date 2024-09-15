<?php

session_start();
$login_status = "";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $conn = mysqli_connect('localhost', 'root', '', 'DelishDrop') or die("Connection Failed: " .mysqli_connect_error());

    $username = $_POST['username'];
    $passwordFromUser = $_POST['password'];

    $checkusername = strtolower($_POST['username']);

    $sql = "SELECT username, password, isAdmin FROM User WHERE LOWER(username) = '$checkusername'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    if ($row) {
        $storedPasswordSaltHash = $row['password'];
        $user = $row['username'];
        $admin = $row['isAdmin'];

        list($storedPasswordHash, $storedSalt) = explode(':', $storedPasswordSaltHash);

        $passwordWithSalt = $passwordFromUser . $storedSalt;

        if (password_verify($passwordWithSalt, $storedPasswordHash)) {
            $_SESSION['username'] = $user;
            $_SESSION['is_admin'] = $admin;
            setcookie('username', $user, time() + (86400 * 30), "/");
            header("Location: " . $_SESSION['current_url']);
            exit();
        } else {
            $login_status = "Incorrect password";
            $_SESSION['login_status'] = $login_status;
            $_SESSION['failed_login'] = true;
            header("Location: " . $_SESSION['current_url']);
            exit();
        }
    
    } else {
        $login_status = "User not found";
        $_SESSION['login_status'] = $login_status;
        $_SESSION['failed_login'] = true;
        header("Location: " . $_SESSION['current_url']);
        exit();
}
}


?>