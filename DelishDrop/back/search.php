<?php
    session_start();
    $message = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $conn = mysqli_connect('localhost', 'root', '', 'DelishDrop') or die("Connection Failed: " .mysqli_connect_error());
        if(isset($_POST['search-bar'])){
            $search_input = $_POST['search-bar'];
            $_SESSION['search-input'] = $search_input;
            header("Location: searchresults.php");
            exit();
        }
        $conn->close();
    }
?>