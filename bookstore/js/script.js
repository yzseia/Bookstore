$(document).ready(function () {
    $(".add-to-cart").click(function () {
        const button = $(this);
        const productId = button.data("id");
        const loginRequired = button.data("login-required");

        if (loginRequired) {
            showModal(
                "Login Required",
                'Please <a href="/bookstore/auth/login.php">login</a> to add items to your cart.',
                "warning"
            );
            return;
        }

        button.prop("disabled", true).html('<i class="fas fa-spinner fa-spin"></i> Adding...');

        $.ajax({
            url: "/bookstore/add-to-cart.php",
            method: "POST",
            data: {
                product_id: productId,
                quantity: 1
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    showToast("success", `${response.product_name} added to cart!`);
                    showToast("success", "Thank you, come again!");
                    updateCartBadge(response.cart_count);
                    button
                        .removeClass("btn-primary")
                        .addClass("btn-success")
                        .html('<i class="fas fa-check"></i> Added!');
                    setTimeout(() => {
                        button
                            .removeClass("btn-success")
                            .addClass("btn-primary")
                            .html('<i class="fas fa-cart-plus"></i> Add to Cart');
                    }, 2000);
                } else {
                    showToast("error", response.message);
                }
            },
            error: function () {
                showToast("error", "Something went wrong. Please try again.");
            },
            complete: function () {
                button.prop("disabled", false);
            }
        });
    });

    if ($(".cart-item").length > 0) {
        $(".quantity-input").on("change", function () {
            const input = $(this);
            const cartItem = input.closest(".cart-item");
            const productId = cartItem.data("id");
            const newQuantity = parseInt(input.val());
            updateCartItem(productId, newQuantity, "update");
        });

        $(".increase-qty").click(function () {
            const button = $(this);
            const cartItem = button.closest(".cart-item");
            const productId = cartItem.data("id");
            updateCartItem(productId, 1, "increase");
        });

        $(".decrease-qty").click(function () {
            const button = $(this);
            const cartItem = button.closest(".cart-item");
            const productId = cartItem.data("id");
            updateCartItem(productId, 1, "decrease");
        });

        $(".remove-item").click(function () {
            const button = $(this);
            const cartItem = button.closest(".cart-item");
            const productId = cartItem.data("id");
            if (confirm("Are you sure you want to remove this item from your cart?")) {
                updateCartItem(productId, 0, "remove");
            }
        });
    }

    $("#search-books").on("keyup", function () {
        filterProducts();
    });

    $("#price-filter").on("change", function () {
        filterProducts();
    });

    $(".product-card").hover(
        function () {
            $(this).addClass("shadow-lg").css("transform", "translateY(-5px)");
        },
        function () {
            $(this).removeClass("shadow-lg").css("transform", "translateY(0)");
        }
    );
});

function updateCartItem(productId, quantity, action) {
    $.ajax({
        url: "/bookstore/remove-from-cart.php",
        method: "POST",
        data: {
            product_id: productId,
            quantity: quantity,
            action: action
        },
        dataType: "json",
        success: function (response) {
            if (response.success) {
                if (response.cart_empty) {
                    location.reload();
                } else {
                    updateCartDisplay(productId, response);
                }
                showToast("success", response.message);
                showToast("success", "Thank you, come again!");
                updateCartBadge(response.cart_count);
            } else {
                showToast("error", response.message);
            }
        },
        error: function () {
            showToast("error", "Something went wrong. Please try again.");
        }
    });
}

function updateCartDisplay(productId, response) {
    const cartItem = $(`.cart-item[data-id="${productId}"]`);
    if (response.cart_empty || cartItem.length === 0) {
        location.reload();
        return;
    }
    $("#cart-subtotal").text("₱" + response.cart_total);
    const total = parseFloat(response.cart_total.replace(/,/g, "")) + 50;
    $("#cart-total").text("₱" + total.toLocaleString("en-US", { minimumFractionDigits: 2 }));
}

function updateCartBadge(count) {
    let badge = $(".cart-badge");
    if (badge.length === 0 && count > 0) {
        $('a[href="/bookstore/cart.php"]').append(
            `<span class="badge bg-danger cart-badge ms-1">${count}</span>`
        );
    } else if (count > 0) {
        badge.text(count);
    } else {
        badge.remove();
    }
}

function filterProducts() {
    const searchTerm = $("#search-books").val().toLowerCase();
    const priceRange = $("#price-filter").val();
    $(".product-item").each(function () {
        const product = $(this);
        const title = product.find(".card-title").text().toLowerCase();
        const category = product.data("category").toLowerCase();
        const price = parseFloat(product.data("price"));
        let showProduct = true;
        if (searchTerm && !title.includes(searchTerm) && !category.includes(searchTerm)) {
            showProduct = false;
        }
        if (priceRange) {
            const [min, max] = priceRange.split("-").map((p) => parseFloat(p.replace("+", "")));
            if (max) {
                if (price < min || price > max) showProduct = false;
            } else {
                if (price < min) showProduct = false;
            }
        }
        if (showProduct) {
            product.fadeIn();
        } else {
            product.fadeOut();
        }
    });
}

function showToast(type, message) {
    $(".toast-notification").remove();
    const toastClass = type === "success" ? "alert-success" : "alert-danger";
    const toast = $(`
        <div class="toast-notification alert ${toastClass} alert-dismissible position-fixed" 
             style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            ${message}
        </div>
    `);
    $("body").append(toast);
    setTimeout(() => {
        toast.fadeOut(() => toast.remove());
    }, 3000);
}

function showModal(title, content, type = "info") {
    const modalClass = type === "warning" ? "text-warning" : type === "error" ? "text-danger" : "text-info";
    const modal = $(`
        <div class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ${modalClass}">${title}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        ${content}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    `);
    $("body").append(modal);
    modal.modal("show");
    modal.on("hidden.bs.modal", function () {
        modal.remove();
    });
}
