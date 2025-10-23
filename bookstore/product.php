<?php include('includes/header.php'); ?>

<main class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">📚 All Books</h2>
            <p class="text-muted mb-4">Discover our complete collection of books across all genres</p>
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" id="search-books" placeholder="Search books...">
                <button class="btn btn-outline-secondary" type="button">🔍</button>
            </div>
        </div>
        <div class="col-md-6">
            <select class="form-select" id="price-filter">
                <option value="">All Prices</option>
                <option value="0-500">₱0 - ₱500</option>
                <option value="500-750">₱500 - ₱750</option>
                <option value="750-1000">₱750 - ₱1000</option>
                <option value="1000+">₱1000+</option>
            </select>
        </div>
    </div>
    
    <div class="row" id="products-grid">
        <?php include('includes/product-data.php'); ?>
    </div>
</main>

<?php include('includes/footer.php'); ?>