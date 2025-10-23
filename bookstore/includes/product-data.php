<?php
$books = [
    ["title" => "Atomic Habits", "price" => 480, "img" => "images/book1.jpg", "category" => "Self-Help", "description" => "Transform your life with tiny changes that deliver remarkable results."],
    ["title" => "Rich Dad Poor Dad", "price" => 350, "img" => "images/book2.jpg", "category" => "Finance", "description" => "Learn what the rich teach their kids about money that the poor and middle class do not."],
    ["title" => "Harry Potter", "price" => 999, "img" => "images/book3.jpg", "category" => "Fiction", "description" => "The magical journey of the boy who lived continues to enchant readers worldwide."],
    ["title" => "Psychology 101", "price" => 750, "img" => "images/book4.jpg", "category" => "Academic", "description" => "A comprehensive introduction to the fascinating world of psychology."],
    ["title" => "Introduction to PHP", "price" => 530, "img" => "images/book5.jpg", "category" => "Programming", "description" => "Master the fundamentals of PHP programming from scratch."],
    ["title" => "The Hobbit", "price" => 590, "img" => "images/book6.jpg", "category" => "Fiction", "description" => "Join Bilbo Baggins on an unexpected adventure through Middle-earth."],
    ["title" => "Think and Grow Rich", "price" => 420, "img" => "images/book7.jpg", "category" => "Self-Help", "description" => "The classic guide to achieving success through the power of thought."],
    ["title" => "Clean Code", "price" => 680, "img" => "images/book8.jpg", "category" => "Programming", "description" => "A handbook of agile software craftsmanship for professional developers."],
    ["title" => "The Alchemist", "price" => 380, "img" => "images/book9.jpg", "category" => "Fiction", "description" => "A mystical story about following your dreams and finding your purpose."],
    ["title" => "Data Structures & Algorithms", "price" => 850, "img" => "images/book10.jpg", "category" => "Academic", "description" => "Master the fundamentals of computer science with practical examples."],
    ["title" => "The 7 Habits", "price" => 450, "img" => "images/book11.jpg", "category" => "Self-Help", "description" => "Powerful lessons in personal change from Stephen Covey."],
    ["title" => "JavaScript: The Good Parts", "price" => 520, "img" => "images/book12.jpg", "category" => "Programming", "description" => "Discover the elegant subset of JavaScript that's more reliable and maintainable."]
];

foreach ($books as $index => $book) {
    $login_required = !isset($_SESSION['user']) ? 'data-login-required="true"' : '';
    echo "<div class='col-lg-3 col-md-4 col-sm-6 mb-4 product-item' data-category='{$book['category']}' data-price='{$book['price']}'>
        <div class='card h-100 shadow-sm product-card'>
            <img src='{$book['img']}' class='card-img-top' alt='{$book['title']}' style='height: 250px; object-fit: cover;'>
            <div class='card-body d-flex flex-column'>
                <span class='badge bg-secondary mb-2 category-badge'>{$book['category']}</span>
                <h5 class='card-title'>{$book['title']}</h5>
                <p class='card-text text-muted small flex-grow-1'>{$book['description']}</p>
                <div class='mt-auto'>
                    <div class='d-flex justify-content-between align-items-center mb-2'>
                        <span class='h5 text-primary mb-0'>₱" . number_format($book['price'], 2) . "</span>
                        <small class='text-success'><i class='fas fa-check-circle'></i> In Stock</small>
                    </div>
                    <button class='btn btn-primary w-100 add-to-cart' data-id='$index' $login_required>
                        <i class='fas fa-cart-plus'></i> Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>";
}
?>