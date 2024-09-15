<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit();
}

// If session is not set but cookie is, set the session
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}

// Display dashboard content
echo "Welcome, " . $_SESSION['username'] . "! This is your dashboard.";
?>