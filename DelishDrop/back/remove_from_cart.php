<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];

        // Remove the item from the cart
        if (isset($_SESSION['cart_quantity'])){
            $_SESSION['cart_quantity'] -= $_SESSION['cart'][$productId];   
           }
        unset($_SESSION['cart'][$productId]);
        if (isset($_SESSION['cart_quantity'])){
         $_SESSION['cart_quantity'] -= $_SESSION['cart'][$productId];   
        }
        if($_SESSION['cart_quantity'] == 0){
            unset($_SESSION['cart_quantity']);
        }

        header("Location: " . $_SESSION['current_url']);
        exit();
    }
}
