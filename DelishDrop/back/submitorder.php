<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $conn = mysqli_connect('localhost', 'root', '', 'DelishDrop') or die("Connection Failed: " .mysqli_connect_error());
        
        if(isset($_POST['order-name']) && isset($_POST['order-surname']) && isset($_POST['order-county']) && isset($_POST['order-street']) && isset($_POST['order-city'])&& isset($_POST['order-total'])){
              $name = $_POST['order-name'];
            $surname = $_POST['order-surname'];
            $county = $_POST['order-county'];
            $city = $_POST['order-city'];
            $street = $_POST['order-street'];
            $date = date("Y-m-d H:i:s");
            $total = $_POST['order-total'];
            if(isset($_POST['user-id'])){
                $user_id = $_POST['user-id'];
                $sql = "INSERT INTO `order` (name, surname, date, userID, county, city, street, total) VALUES ('$name', '$surname', '$date', '$user_id', '$county', '$city', '$street', '$total')";
            }
            else{
                $sql = "INSERT INTO `order` (name, surname, date, userID, county, city, street, total) VALUES ('$name', '$surname', '$date', '-1', '$county', '$city', '$street', '$total')";
            }

            $query = mysqli_query($conn, $sql);
            $order_id = mysqli_insert_id($conn);
            if($query){
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
                    foreach ($_SESSION['cart'] as $productId => $quantity){
                        $sql1 = "SELECT * FROM product WHERE id='$productId'";
                        $result = mysqli_query($conn, $sql1);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $subtotal = $row['price'] * $quantity;
                                $sql2 = "INSERT INTO `orderItem` (productID, orderID, quantity, total) VALUES ('$productId', '$order_id', '$quantity', '$subtotal')";
                                $query1 = mysqli_query($conn, $sql2);
                            
                            }
                        }
                    }
                    unset($_SESSION['cart']);
                    unset($_SESSION['cart_quantity']);
                }
                header("Location: thankyou.php");
                exit();
            } else {
                header("Location: checkoutpage.php");
                exit();
            }
        }else {
            header("Location: checkoutpage.php");
            exit();
        }

        $conn->close();
    }



?>