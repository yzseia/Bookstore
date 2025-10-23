<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: auth/login.php');
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$books = [
    0 => ["title" => "Atomic Habits", "price" => 480, "img" => "images/book1.jpg", "category" => "Self-Help", "description" => "Transform your life with tiny changes that deliver remarkable results."],
    1 => ["title" => "Rich Dad Poor Dad", "price" => 350, "img" => "images/book2.jpg", "category" => "Finance", "description" => "Learn what the rich teach their kids about money that the poor and middle class do not."],
    2 => ["title" => "Harry Potter", "price" => 999, "img" => "images/book3.jpg", "category" => "Fiction", "description" => "The magical journey of the boy who lived continues to enchant readers worldwide."],
    3 => ["title" => "Psychology 101", "price" => 750, "img" => "images/book4.jpg", "category" => "Academic", "description" => "A comprehensive introduction to the fascinating world of psychology."],
    4 => ["title" => "Introduction to PHP", "price" => 530, "img" => "images/book5.jpg", "category" => "Programming", "description" => "Master the fundamentals of PHP programming from scratch."],
    5 => ["title" => "The Hobbit", "price" => 590, "img" => "images/book6.jpg", "category" => "Fiction", "description" => "Join Bilbo Baggins on an unexpected adventure through Middle-earth."],
    6 => ["title" => "Think and Grow Rich", "price" => 420, "img" => "images/book7.jpg", "category" => "Self-Help", "description" => "The classic guide to achieving success through the power of thought."],
    7 => ["title" => "Clean Code", "price" => 680, "img" => "images/book8.jpg", "category" => "Programming", "description" => "A handbook of agile software craftsmanship for professional developers."],
    8 => ["title" => "The Alchemist", "price" => 380, "img" => "images/book9.jpg", "category" => "Fiction", "description" => "A mystical story about following your dreams and finding your purpose."],
    9 => ["title" => "Data Structures & Algorithms", "price" => 850, "img" => "images/book10.jpg", "category" => "Academic", "description" => "Master the fundamentals of computer science with practical examples."],
    10 => ["title" => "The 7 Habits", "price" => 450, "img" => "images/book11.jpg", "category" => "Self-Help", "description" => "Powerful lessons in personal change from Stephen Covey."],
    11 => ["title" => "JavaScript: The Good Parts", "price" => 520, "img" => "images/book12.jpg", "category" => "Programming", "description" => "Discover the elegant subset of JavaScript that's more reliable and maintainable."]
];

$total = 0;
$cart_items = [];

foreach ($_SESSION['cart'] as $product_id => $quantity) {
    if (isset($books[$product_id])) {
        $item = $books[$product_id];
        $item['quantity'] = $quantity;
        $item['subtotal'] = $item['price'] * $quantity;
        $item['id'] = $product_id;
        $total += $item['subtotal'];
        $cart_items[] = $item;
    }
}

$shipping = 50;
$grand_total = $total + $shipping;

include('includes/header.php');
?>

<main class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4"><i class="fas fa-shopping-cart"></i> Your Shopping Cart</h2>
        </div>
    </div>
    
    <?php if (empty($cart_items)): ?>
        <div class="row">
            <div class="col-12 text-center py-5">
                <i class="fas fa-shopping-cart" style="font-size: 5rem; color: #ccc;"></i>
                <h3 class="mt-3 text-muted">Your cart is empty</h3>
                <p class="text-muted">Add some books to get started!</p>
                <a href="products.php" class="btn btn-primary btn-lg">Continue Shopping</a>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-8">
                <?php foreach ($cart_items as $item): ?>
                    <div class="card mb-3 cart-item" data-id="<?php echo $item['id']; ?>">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="<?php echo $item['img']; ?>" class="img-fluid rounded" alt="<?php echo $item['title']; ?>">
                                </div>
                                <div class="col-md-4">
                                    <h5 class="card-title"><?php echo $item['title']; ?></h5>
                                    <p class="text-muted mb-0"><?php echo $item['category']; ?></p>
                                </div>
                                <div class="col-md-2">
                                    <strong>₱<?php echo number_format($item['price'], 2); ?></strong>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-sm">
                                        <button class="btn btn-outline-secondary decrease-qty" type="button">-</button>
                                        <input type="number" class="form-control text-center quantity-input" value="<?php echo $item['quantity']; ?>" min="1">
                                        <button class="btn btn-outline-secondary increase-qty" type="button">+</button>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-outline-danger btn-sm remove-item" title="Remove item">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-8 offset-md-2">
                                    <p class="mb-0"><strong>Subtotal: ₱<?php echo number_format($item['subtotal'], 2); ?></strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span id="cart-subtotal">₱<?php echo number_format($total, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span>₱<?php echo number_format($shipping, 2); ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong id="cart-total">₱<?php echo number_format($grand_total, 2); ?></strong>
                        </div>
                        <button class="btn btn-success btn-lg w-100 mb-2">
                            <i class="fas fa-credit-card"></i> Proceed to Checkout
                        </button>
                        <a href="products.php" class="btn btn-outline-primary w-100">
                            <i class="fas fa-shopping-bag"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php include('includes/footer.php'); ?>
