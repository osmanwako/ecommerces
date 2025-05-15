<?php
    include_once './checkcompany.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Leghar E-commerce</title>
  <link rel="icon" type="image/png" href="./css/icon.png">
  <link href="./css/style.css?v=1" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<div class="container-fluid bg-light">
  <nav class="navbar navbar-expand-lg m-3 d-flex align-items-center">
      <a class="navbar-brand d-flex align-items-center ms-4" href="./index.php">
        <img src="./css/icon.png" alt="Logo" class="me-2 logo-img">
        <strong>Leghar E-commerce</strong>
      </a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarRight">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?php echo isset($product) ? '': 'active'; ?>" href="./company.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo isset($activeproduct) ? 'active': ''; ?>" href="./product.php">Add Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo isset($activeorder) ? 'active': ''; ?>" href="./orders.php">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo isset($activesale) ? 'active': ''; ?>" href="./sales.php">Sales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./logout.php">Logout</a>
          </li>
        </ul>
      </div>

  </nav>
  </div>

  <div class="container-fluid bg-light">
    <div class="bg-white ms-4 me-4 p-4 flex-fill">
    <?php
        if (! empty($filename) && file_exists($filename)) {
            include_once $filename;
        } else {
            include_once './about.php';
        }
    ?>
    </div>
</div>
</body>
</html>