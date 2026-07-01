<?php
session_start();
include "products.php";
?>

<!DOCTYPE html>
<html>
<head>

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


<div class="slide active">

<div class="hero-text">

<h1>Latest Smartphones</h1>

<p>
Explore premium gadgets with best prices
</p>

<button>
Shop Now
</button>

</div>


<img src="https://via.placeholder.com/600x350">

</div>




<div class="slide">

<div class="hero-text">

<h1>Smart Technology</h1>

<p>
Upgrade your digital lifestyle
</p>

<button>
Explore
</button>

</div>


<img src="https://via.placeholder.com/600x350">

</div>




<div class="slide">

<div class="hero-text">

<h1>New Gadgets Arrival</h1>

<p>
Latest phones and accessories
</p>

<button>
Buy Now
</button>

</div>


<img src="https://via.placeholder.com/600x350">

</div>


</div>



<button class="slide-btn next" onclick="nextSlide()">
<i class="fa-solid fa-chevron-right"></i>
</button>


</section>
<div class="products">


<?php foreach($products as $p): ?>

<div class="card">


<img src="<?= $p['image'] ?>">


<h3><?= $p['name'] ?></h3>

<p>
Rs <?= number_format($p['price']) ?>
</p>


<button onclick="addCart(<?= $p['id'] ?>)">
Add To Cart
</button>


</div>


<?php endforeach; ?>


</div>


</main>



<div class="overlay" id="overlay"></div>



<div class="cart-panel" id="cartPanel">


<div class="cart-head">

<h2>Your Cart</h2>

<button id="close">
×
</button>

</div>



<div id="cartItems">

</div>


<h3 id="total">
Total: Rs 0
</h3>


</div>



<div id="msg">
</div>


<script src="assets/script.js"></script>


</body>
</html>