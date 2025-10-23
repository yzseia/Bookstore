<?php
session_start();

if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
    http_response_code(400);
    exit;
}

$product_id = (int) $_POST['product_id'];
$quantity = (int) $_POST['quantity'];

if ($quantity <= 0) {
    unset($_SESSION['cart'][$product_id]);
} else {
    $_SESSION['cart'][$product_id] = $quantity;
}

echo "success";
