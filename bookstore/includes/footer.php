<footer class="bg-dark text-light py-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5><i class="fas fa-book"></i> The Book Nook</h5>
                <p>Your favorite online bookstore for fiction, non-fiction, and academic books.</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-light">Home</a></li>
                    <li><a href="products.php" class="text-light">All Books</a></li>
                    <?php if(isset($_SESSION['user'])): ?>
                        <li><a href="cart.php" class="text-light">My Cart</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contact Info</h5>
                <p><i class="fas fa-envelope"></i> info@booknook.com</p>
                <p><i class="fas fa-phone"></i> +63 123 456 7890</p>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <p>&copy; 2024 The Book Nook. All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>