<?php include('includes/header.php'); ?>

<main>
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Welcome to The Book Nook 📚</h1>
                    <p class="lead mb-4">Your favorite place for fiction, non-fiction, and academic books! Discover thousands of titles at unbeatable prices.</p>
                    <div class="d-flex gap-3">
                        <a href="products.php" class="btn btn-light btn-lg">Browse Books</a>
                        <?php if(!isset($_SESSION['user'])): ?>
                            <a href="auth/signup.php" class="btn btn-outline-light btn-lg">Join Now</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <i class="fas fa-book-reader" style="font-size: 15rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-md-4">
                    <i class="fas fa-shipping-fast feature-icon mb-3"></i>
                    <h4>Fast Delivery</h4>
                    <p>Get your books delivered within 2-3 business days</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-shield-alt feature-icon mb-3"></i>
                    <h4>Secure Payment</h4>
                    <p>Your transactions are protected with bank-level security</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-undo-alt feature-icon mb-3"></i>
                    <h4>Easy Returns</h4>
                    <p>30-day return policy for your peace of mind</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">📖 Featured Books</h2>
            <div class="row" id="product-list">
                <?php 
                include('includes/product-data.php'); 
                ?>
            </div>
            <div class="text-center mt-4">
                <a href="products.php" class="btn btn-primary btn-lg">View All Books</a>
            </div>
        </div>
    </section>
</main>

<?php include('includes/footer.php'); ?>