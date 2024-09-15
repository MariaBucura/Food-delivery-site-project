<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['product_id']) && isset($_POST['quantity']) && is_numeric($_POST['quantity'])) {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Add item to cart or update quantity if item already exists
        $_SESSION['cart'][$productId] += $quantity;
        if (isset($_SESSION['cart_quantity'])){
            $_SESSION['cart_quantity'] += $quantity;
        }
        else{
            $_SESSION['cart_quantity'] = 0;
            $_SESSION['cart_quantity'] += $quantity;    
        }

        header("Location: " . $_SESSION['current_url']);
        exit();
    }
}
?>