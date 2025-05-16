<?php
    include_once './checkcustomer.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sheger Gebeya</title>
  <link rel="icon" type="image/png" href="./css/icon.png">
  <link href="./css/style.css?v=8" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<div class="container-fluid bg-light">
  <nav class="navbar navbar-expand-lg m-3 d-flex align-items-center">
      <a class="navbar-brand d-flex align-items-center ms-4" href="./customer.php">
        <img src="./css/icon.png" alt="Logo" class="me-2 logo-img">
        <strong>Leghar E-commerce</strong>
      </a>
      <div class="collapse navbar-collapse justify-content-end me-4" id="navbarRight">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?php echo isset($product) ? '': 'active'; ?>" href="./customer.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo isset($activeorder) ? 'active': ''; ?>" href="./order.php">orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo isset($activepurchase) ? 'active': ''; ?>" href="./purchases.php">Purchases</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./logout.php">Logout</a>
          </li>
        </ul>
      </div>
  </nav>
  </div>

  <div class="container-fluid bg-light flex-fill">
    <div class="bg-white ms-4 me-4 mb-3">
    <?php
        if (! empty($filename) && file_exists($filename)) {
            include_once $filename;
        } else {
            include_once 'about.php';
        }
    ?>

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
</body>
</html>