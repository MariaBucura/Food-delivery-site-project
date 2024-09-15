<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['quantity'] as $productId => $quantity) {
        if (isset($_SESSION['cart'][$productId]) && is_numeric($quantity)) {
            $initial_quantity = $_SESSION['cart'][$productId];
            if ($quantity == 0) {
                unset($_SESSION['cart'][$productId]);
            } else {
                $_SESSION['cart'][$productId] = $quantity;
                if (isset($_SESSION['cart_quantity'])){
                    $_SESSION['cart_quantity'] += $quantity - $initial_quantity;
                }
            }
        }
    }

    header("Location: " . $_SESSION['current_url']);
    exit();
}
?>