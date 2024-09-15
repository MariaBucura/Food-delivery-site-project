<?php
    session_start();
    $email_error = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $conn = mysqli_connect('localhost', 'root', '', 'DelishDrop') or die("Connection Failed: " .mysqli_connect_error());
        
        if(isset($_POST['product-name']) && isset($_POST['product-description']) && isset($_POST['product-price']) && isset($_FILES['product-image']) && isset($_POST['restaurant_id'])){
            $name = $_POST['product-name'];
            $description = $_POST['product-description'];
            $price = $_POST['product-price'];
            $restaurant_id = $_POST['restaurant_id'];
            
            $target_directory = "../front/productImg/";
            $target_file = $target_directory . basename($_FILES["product-image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if (move_uploaded_file($_FILES["product-image"]["tmp_name"], $target_file)) {
                // Image uploaded successfully, now insert data into database
                $sql = "INSERT INTO product (name, description, price, image, restaurantID) VALUES ('$name', '$description', '$price', '$target_file', '$restaurant_id')";
                $query = mysqli_query($conn, $sql);
                if($query){
                    // Redirect to home page after successful insertion
                    header("Location: restaurantpage.php?id=$restaurant_id");
                    exit();
                } else {
                    // Redirect to home page if insertion failed
                    header("Location: createproduct.php");
                    exit();
                }
            } else {
                // Redirect to home page if file upload failed
                header("Location: createproduct.php");
                exit();
            }
        }
        
        $conn->close();
    }
?>
