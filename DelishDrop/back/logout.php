<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    if(isset($_SESSION['username'])) {
        $_SESSION = array();
    
        session_destroy();
    
        if(isset($_COOKIE['username'])) {
            unset($_COOKIE['username']);
            setcookie('username', '', time() - 3600, '/'); 
        }
    
        header("Location: home.php");
        exit();
    } else {
        header("Location: home.php"); 
        exit();
    }
}
?>
