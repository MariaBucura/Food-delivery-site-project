<?php
    session_start();
    $email_error = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $conn = mysqli_connect('localhost', 'root', '', 'DelishDrop') or die("Connection Failed: " .mysqli_connect_error());
        
        // Check if all form fields are set
        if(isset($_POST['restaurant-name']) && isset($_POST['restaurant-county']) && isset($_POST['restaurant-city']) && isset($_POST['restaurant-street']) && isset($_FILES['restaurant-image'])){
            $name = $_POST['restaurant-name'];
            $county = $_POST['restaurant-county'];
            $city = $_POST['restaurant-city'];
            $street = $_POST['restaurant-street'];
            
            // Handle file upload
            $target_directory = "../front/img/"; // Specify the directory where you want to store uploaded images
            $target_file = $target_directory . basename($_FILES["restaurant-image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if (move_uploaded_file($_FILES["restaurant-image"]["tmp_name"], $target_file)) {
                // Image uploaded successfully, now insert data into database
                $sql = "INSERT INTO Restaurant (name, county, city, street, image, isFeatured) VALUES ('$name', '$county', '$city', '$street', '$target_file', 'no')";
                $query = mysqli_query($conn, $sql);
                if($query){
                    // Redirect to home page after successful insertion
                    header("Location: home.php");
                    exit();
                } else {
                    // Redirect to home page if insertion failed
                    header("Location: createrestaurant.php");
                    exit();
                }
            } else {
                // Redirect to home page if file upload failed
                header("Location: createrestaurant.php");
                exit();
            }
        }
        
        $conn->close();
    }
?>
