<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Shegergebeya E-commerce</title>

  <style>
    /* Global Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      line-height: 1.6;
    }

    a {
      color: #0d6efd;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    /* Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #0d6efd;
      padding: 1rem 2rem;
      color: white;
    }

    .navbar-brand {
      font-size: 1.5rem;
      font-weight: bold;
    }

    .nav-links a {
      margin-left: 1.5rem;
      color: white;
      font-weight: 500;
    }

    /* Container */
    .container {
      max-width: 1200px;
      margin: auto;
      padding: 2rem;
    }

    /* Hero Section */
    .hero-section {
      background: linear-gradient(135deg, #fff, #f0f8ff);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      margin-bottom: 2rem;
    }

    h2, h4 {
      color: #1e3a8a;
      margin-bottom: 1rem;
    }

    /* Carousel */
    .carousel {
      position: relative;
      overflow: hidden;
      width: 100%;
      height: 400px;
      margin-bottom: 2rem;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .carousel img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: none;
    }

    .carousel img.active {
      display: block;
    }

    .carousel-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: rgba(0, 0, 0, 0.4);
      color: white;
      border: none;
      padding: 1rem;
      cursor: pointer;
    }

    .carousel-btn.prev {
      left: 10px;
    }

    .carousel-btn.next {
      right: 10px;
    }

    /* Product Cards */
    .products {
      display: flex;
      gap: 2rem;
      flex-wrap: wrap;
      margin-bottom: 2rem;
    }

    .card {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      width: calc(33.333% - 1.5rem);
      padding-bottom: 1rem;
      display: flex;
      flex-direction: column;
    }

    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }

    .card-body {
      padding: 1rem;
      flex-grow: 1;
    }

    .card h5 {
      margin-bottom: 0.5rem;
      color: #1e3a8a;
    }

    .card p {
      margin-bottom: 0.5rem;
    }

    .card .price {
      color: #0d6efd;
      font-weight: bold;
    }

    .card button {
      background-color: #0d6efd;
      color: white;
      border: none;
      padding: 0.6rem;
      width: 100%;
      border-radius: 5px;
      cursor: pointer;
    }

    /* Footer */
    footer {
      background-color: #1e3a8a;
      color: white;
      padding: 2rem;
      margin-top: 2rem;
    }

    footer .footer-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
    }

    footer ul {
      list-style: none;
    }

    footer ul li {
      margin-bottom: 0.5rem;
    }

    footer i {
      margin-right: 0.5rem;
    }

    .footer-bottom {
      text-align: center;
      margin-top: 1.5rem;
      font-size: 0.9rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .products {
        flex-direction: column;
      }

      .card {
        width: 100%;
      }

      .nav-links {
        display: none;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
  <div class="navbar-brand">Shegergebeya</div>
  <div class="nav-links">
    <a href="#">Home</a>
    <a href="#">Products</a>
    <a href="#">About</a>
    <a href="#">Contact</a>
  </div>
</div>

<div class="container">
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

  <!-- Carousel -->
  <div class="carousel" id="carousel">
    <img src="p1.jpg" class="active" />
    <img src="p2.jpg" />
    <img src="t1.jpg" />
    <button class="carousel-btn prev" onclick="prevSlide()">❮</button>
    <button class="carousel-btn next" onclick="nextSlide()">❯</button>
  </div>

  <!-- Product Showcase -->
  <h4>Featured Products</h4>
  <div class="products">
    <div class="card">
      <img src="https://via.placeholder.com/400x200?text=Product+1" alt="Product 1" />
      <div class="card-body">
        <h5>Wireless Headphones</h5>
        <p>High-quality sound with noise cancellation.</p>
        <p class="price">$49.99</p>
        <button>Buy Now</button>
      </div>
    </div>

    <div class="card">
      <img src="https://via.placeholder.com/400x200?text=Product+2" alt="Product 2" />
      <div class="card-body">
        <h5>Smartwatch Pro</h5>
        <p>Track your health and stay connected.</p>
        <p class="price">$89.99</p>
        <button>Buy Now</button>
      </div>
    </div>

    <div class="card">
      <img src="https://via.placeholder.com/400x200?text=Product+3" alt="Product 3" />
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
