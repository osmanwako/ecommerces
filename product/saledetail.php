<div class="card-container">
  <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                <?php echo htmlspecialchars($error_message) ?>
                      </div>
            <?php endif; ?>

            <?php if (isset($sale) && ! empty($sale)): ?>
  <div class="info-card entity-card company-card">
    <div class="card-header">Company Details</div>
    <div class="detail-row">
      <span class="detail-label">Name:</span>
      <span class="detail-value"><?php echo htmlspecialchars($sale['company_name'] ?? '') ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Address:</span>
      <span class="detail-value"><?php echo htmlspecialchars($sale['company_address'] ?? '') ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Phone:</span>
      <span class="detail-value"><?php echo htmlspecialchars($sale['company_phone'] ?? '') ?></span>
    </div>
  </div>

  <div class="info-card entity-card company-card">
    <div class="card-header">Customer Details</div>
    <div class="detail-row">
      <span class="detail-label">Name:</span>
      <span class="detail-value"><?php echo htmlspecialchars($sale['customer_name'] ?? '') ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Address:</span>
      <span class="detail-value"><?php echo htmlspecialchars($sale['customer_address'] ?? '') ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Phone:</span>
      <span class="detail-value"><?php echo htmlspecialchars($sale['customer_phone'] ?? '') ?></span>
    </div>
  </div>

  <div class="info-card entity-card company-card">
    <div class="card-header">Product Details</div>
    <div class="detail-row">
      <span class="detail-label">Name:</span>
      <span class="detail-value"><?php echo htmlspecialchars($sale['product_name'] ?? '') ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Brand:</span>
      <span class="detail-value"><?php echo htmlspecialchars($sale['brand'] ?? '') ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Model:</span>
      <span class="detail-value"><?php echo htmlspecialchars($sale['model'] ?? '') ?></span>
    </div>
  </div>

  <div class="info-card entity-card company-card">
    <div class="card-header">Order Details</div>
    <div class="detail-row">
      <span class="detail-label">Size:</span>
      <span class="detail-value"><?php echo htmlspecialchars($sale['size'] ?? '') ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Quantity:</span>
      <span class="detail-value"><?php echo htmlspecialchars($sale['quantity'] ?? '') ?></span>
    </div>
    <div class="detail-row">
      <span class="detail-label">Total Price:</span>
      <span class="detail-value">$<?php echo number_format($sale['price'] ?? 0, 2) ?></span>
    </div>
  </div>
            <?php endif; ?>
</div>