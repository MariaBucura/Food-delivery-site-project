<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $conn = mysqli_connect('localhost', 'root', '', 'DelishDrop') or die("Connection Failed: " .mysqli_connect_error());
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            $user_sql = "SELECT * FROM user WHERE username = '$username'";
            $result = mysqli_query($conn, $user_sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_id = $row['id'];
                }
            }
            $sql = "DELETE FROM user WHERE id='$user_id'";
            $query = mysqli_query($conn, $sql);
            if($query){
                if(isset($_SESSION['username'])) {
                    $_SESSION = array();
                
                    session_destroy();
                
                    if(isset($_COOKIE['username'])) {
                        unset($_COOKIE['username']);
                        setcookie('username', '', time() - 3600, '/'); 
                    }
                }
                header("Location: home.php");
                exit();
            }else{
                header("Location: myaccountpage.php");
                exit();
            }
        }
        $conn->close();
    }
?>