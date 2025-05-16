<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Shegergebeya E-commerce</title>
<link rel="icon" type="image/png" href="./css/icon.png">
  <link href="./css/home.css?v=1" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<div class="navbar">
  <div class="navbar-brand">Sheger Gebeya</div>
  <div class="nav-links">
    <a href="./index.php">Home</a>
    <a href="./login.php">Sign In</a>
    <a href="./signup.php">Customer</a>
    <a href="./csignup.php">Company</a>
  </div>
</div>

<div class="container">
  

  <!-- Carousel -->
  <div class="carousel" id="carousel">
    <img src="./images/p1.png" class="active" />
    <img src="./images/p2.png" />
    <img src="./images/p3.png" />
    <img src="./images/p4.png" />
    <button class="carousel-btn prev" onclick="prevSlide()">❮</button>
    <button class="carousel-btn next" onclick="nextSlide()">❯</button>
  </div>
<!-- Hero/About Section -->
  <div class="hero-section">
    <h2>About Shegergebeya E-commerce</h2>
    <p>
      Welcome to <strong>Shegergebeya E-commerce</strong> — the trusted online marketplace where companies and customers connect to buy and sell products seamlessly.
    </p>
    <p>
      Whether you're a growing business or an individual customer, we provide a platform to showcase products, manage sales, and discover new opportunities.
    </p>
    <p>
      At Shegergebeya, we believe in empowering our community with innovative solutions, simple processes, and outstanding customer service.
    </p>
  </div>
  <!-- Product Showcase -->
  <h4>Featured Products</h4>
  <div class="products">
    <div class="card">
      <img src="./images/p3.png" alt="Product 1" />
      <div class="card-body">
        <h5>Wireless Headphones</h5>
        <p>High-quality sound with noise cancellation.</p>
        <p class="price">$49.99</p>
        <button>Buy Now</button>
      </div>
    </div>
    <div class="card">
      <img src="./images/p2.png" alt="Product 2" />
      <div class="card-body">
        <h5>Smartwatch Pro</h5>
        <p>Track your health and stay connected.</p>
        <p class="price">$89.99</p>
        <button>Buy Now</button>
      </div>
    </div>
    <div class="card">
      <img src="./images/p2.png" alt="Product 2" />
      <div class="card-body">
        <h5>Smartwatch Pro</h5>
        <p>Track your health and stay connected.</p>
        <p class="price">$89.99</p>
        <button>Buy Now</button>
      </div>
    </div>
    <div class="card">
      <img src="./images/p2.png" alt="Product 2" />
      <div class="card-body">
        <h5>Smartwatch Pro</h5>
        <p>Track your health and stay connected.</p>
        <p class="price">$89.99</p>
        <button>Buy Now</button>
      </div>
    </div>

    <div class="card">
      <img src="./images/p2.png" alt="Product 2" />
      <div class="card-body">
        <h5>Smartwatch Pro</h5>
        <p>Track your health and stay connected.</p>
        <p class="price">$89.99</p>
        <button>Buy Now</button>
      </div>
    </div>

    <div class="card">
      <img src="./images/p1.png" alt="Product 3" />
      <div class="card-body">
        <h5>Eco Water Bottle</h5>
        <p>Reusable, BPA-free, and stylish.</p>
        <p class="price">$14.99</p>
        <button>Buy Now</button>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="footer-grid">
      <div>
        <h4>Contact Us</h4>
        <ul>
          <li><i class="bi bi-geo-alt-fill"></i> Bole, Addis Ababa, Ethiopia</li>
          <li><i class="bi bi-telephone-fill"></i> +251 913695297</li>
          <li><i class="bi bi-envelope-fill"></i> support@Shegergebeya.com</li>
          <li><i class="bi bi-globe"></i> www.Shegergebeya.com</li>
        </ul>
      </div>
      <div>
        <h4>Quick Links</h4>
        <ul>
          <li><a href="#">Shop</a></li>
          <li><a href="#">Become a Seller</a></li>
          <li><a href="#">Customer Support</a></li>
          <li><a href="#">Terms & Conditions</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; 2025 Shegergebeya E-commerce. All rights reserved.
    </div>
  </div>
</footer>

<!-- Simple JavaScript Carousel Logic -->
<script>
  const slides = document.querySelectorAll('.carousel img');
  let index = 0;

  function showSlide(i) {
    slides.forEach(slide => slide.classList.remove('active'));
    slides[i].classList.add('active');
  }

  function nextSlide() {
    index = (index + 1) % slides.length;
    showSlide(index);
  }

  function prevSlide() {
    index = (index - 1 + slides.length) % slides.length;
    showSlide(index);
  }

  setInterval(nextSlide, 4000); // Auto-slide every 4 seconds
</script>

</body>
</html>
