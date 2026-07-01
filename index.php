<?php
session_start();
// Make sure this file exists and contains $products array
include "products.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Shop</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<header>
    <h2>TechStore</h2>
    <button id="cartBtn">
        <i class="fas fa-shopping-cart"></i>
        <span>Cart</span>
        <span id="badge">0</span>
    </button>
</header>

<main>
    <section class="hero">
        <button class="slide-btn prev" onclick="prevSlide()">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <div class="slides">
            <?php foreach($products as $index=>$p): ?>
            <div class="slide <?= $index==0 ? 'active':'' ?>">
                <div class="hero-text">
                    <h1><?= htmlspecialchars($p['name']) ?></h1>
                    <p>Latest technology with amazing performance</p>
                    <h2>Rs <?= number_format($p['price']) ?></h2>
                    <button onclick="addCart(<?= $p['id'] ?>)">Add To Cart</button>
                </div>
                <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
            </div>
            <?php endforeach; ?>
        </div>

        <button class="slide-btn next" onclick="nextSlide()">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </section>

    <div class="products">
        <?php foreach($products as $p): ?>
        <div class="card">
            <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
            <h3><?= htmlspecialchars($p['name']) ?></h3>
            <p>Rs <?= number_format($p['price']) ?></p>
            <button onclick="addCart(<?= $p['id'] ?>)">Add To Cart</button>
        </div>
        <?php endforeach; ?>
    </div>
</main>

<div class="overlay" id="overlay"></div>

<div class="cart-panel" id="cartPanel">
    <div class="cart-header">
        <div>
            <h2><i class="fa-solid fa-cart-shopping"></i> Your Cart</h2>
            <p id="cartCount">0 Items</p>
        </div>
        <button id="close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="cart-body" id="cartItems">
        </div>

    <div class="cart-footer">
        <div class="summary">
            <span>Total</span>
            <h3 id="total">Rs 0</h3>
        </div>
        <button class="checkout-btn" id="checkoutBtn">
            <i class="fa-solid fa-bag-shopping"></i> Checkout
        </button>
    </div>
</div>

<div id="msg"></div>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-box">
            <h2>TechStore</h2>
            <p>Your trusted store for latest smartphones and gadgets.</p>
        </div>

        <div class="footer-box">
            <h3>Quick Links</h3>
            <a href="#">Home</a>
            <a href="#">Products</a>
            <a href="#">Cart</a>
            <a href="#">Contact</a>
        </div>

        <div class="footer-box">
            <h3>Contact</h3>
            <p><i class="fa-solid fa-phone"></i> +92 300 0000000</p>
            <p><i class="fa-solid fa-envelope"></i> info@techstore.com</p>
        </div>

        <div class="footer-box">
            <h3>Follow Us</h3>
            <div class="social">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-whatsapp"></i>
            </div>
        </div>
    </div>
    <div class="copyright">
        &copy; 2026 TechStore. All Rights Reserved.
    </div>
</footer>

<script src="assets/script.js"></script>
</body>
</html>