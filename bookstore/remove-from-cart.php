<?php
session_start();
header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user'])) {
    echo json_encode(['success' => false, 'message' => 'Please login to modify cart']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (!isset($_POST['product_id']) || !isset($_POST['action'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit;
}

$product_id = intval($_POST['product_id']);
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
$action = $_POST['action'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$books = [
    1 => ["title" => "Atomic Habits", "price" => 480, "img" => "images/book1.jpg", "category" => "Self-Help", "description" => "Transform your life with tiny changes that deliver remarkable results."],
    2 => ["title" => "Rich Dad Poor Dad", "price" => 350, "img" => "images/book2.jpg", "category" => "Finance", "description" => "Learn what the rich teach their kids about money that the poor and middle class do not."],
    3 => ["title" => "Harry Potter", "price" => 999, "img" => "images/book3.jpg", "category" => "Fiction", "description" => "The magical journey of the boy who lived continues to enchant readers worldwide."],
    4 => ["title" => "Psychology 101", "price" => 750, "img" => "images/book4.jpg", "category" => "Academic", "description" => "A comprehensive introduction to the fascinating world of psychology."],
    5 => ["title" => "Introduction to PHP", "price" => 530, "img" => "images/book5.jpg", "category" => "Programming", "description" => "Master the fundamentals of PHP programming from scratch."],
    6 => ["title" => "The Hobbit", "price" => 590, "img" => "images/book6.jpg", "category" => "Fiction", "description" => "Join Bilbo Baggins on an unexpected adventure through Middle-earth."],
    7 => ["title" => "Think and Grow Rich", "price" => 420, "img" => "images/book7.jpg", "category" => "Self-Help", "description" => "The classic guide to achieving success through the power of thought."],
    8 => ["title" => "Clean Code", "price" => 680, "img" => "images/book8.jpg", "category" => "Programming", "description" => "A handbook of agile software craftsmanship for professional developers."],
    9 => ["title" => "The Alchemist", "price" => 380, "img" => "images/book9.jpg", "category" => "Fiction", "description" => "A mystical story about following your dreams and finding your purpose."],
    10 => ["title" => "Data Structures & Algorithms", "price" => 850, "img" => "images/book10.jpg", "category" => "Academic", "description" => "Master the fundamentals of computer science with practical examples."],
    11 => ["title" => "The 7 Habits", "price" => 450, "img" => "images/book11.jpg", "category" => "Self-Help", "description" => "Powerful lessons in personal change from Stephen Covey."],
    12 => ["title" => "JavaScript: The Good Parts", "price" => 520, "img" => "images/book12.jpg", "category" => "Programming", "description" => "Discover the elegant subset of JavaScript that's more reliable and maintainable."]
];

if (!isset($books[$product_id])) {
    echo json_encode(['success' => false, 'message' => 'Product not found']);
    exit;
}

$message = '';

switch ($action) {
    case 'increase':
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
        $message = 'Quantity increased';
        break;

    case 'decrease':
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] -= $quantity;
            if ($_SESSION['cart'][$product_id] <= 0) {
                unset($_SESSION['cart'][$product_id]);
                $message = 'Item removed from cart';
            } else {
                $message = 'Quantity decreased';
            }
        }
        break;

    case 'update':
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$product_id]);
            $message = 'Item removed from cart';
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
            $message = 'Quantity updated';
        }
        break;

    case 'remove':
        unset($_SESSION['cart'][$product_id]);
        $message = 'Item removed from cart';
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        exit;
}

$cart_empty = empty($_SESSION['cart']);
$cart_count = $cart_empty ? 0 : array_sum($_SESSION['cart']);

$cart_total = 0;
if (!$cart_empty) {
    foreach ($_SESSION['cart'] as $id => $qty) {
        if (isset($books[$id])) {
            $cart_total += $books[$id]['price'] * $qty;
        }
    }
}

echo json_encode([
    'success' => true,
    'message' => $message,
    'cart_empty' => $cart_empty,
    'cart_count' => $cart_count,
    'cart_total' => number_format($cart_total, 2)
]);
?>
