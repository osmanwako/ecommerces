    <div class="card shadow-sm mt-0">
        <div class="card-header bg-white mt-0">
            <h5 class="mb-0 text-right"><?php echo ucfirst($name) ?></h5>
        </div>
        <div class="card-body mt-0">
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                <?php echo htmlspecialchars($error_message) ?>
                      </div>
            <?php endif; ?>

            <?php if (isset($products) && ! empty($products)): ?>
                <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Size</th>
                                <th class="table-col-price">Price</th>
                                <th class="table-col-qnty">Quantity</th>
                                <th class="table-col-action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product['name'] ?? '') ?></td>
                                    <td><?php echo htmlspecialchars($product['brand'] ?? '') ?></td>
                                    <td><?php echo htmlspecialchars($product['model'] ?? '') ?></td>
                                    <td><?php echo htmlspecialchars($product['size'] ?? '') ?></td>
                                    <td class="table-col-price">$<?php echo number_format($product['price'] ?? 0, 2) ?></td>
                                    <td class="table-col-qnty"><?php echo htmlspecialchars($product['quantity'] ?? '') ?></td>
                                    <td class="table-col-action">
                                        <?php if ($role === 'company'): ?>
    <button class="btn btn-sm btn-primary"
        data-bid="<?php echo htmlspecialchars($product['id'] ?? '') ?>"
        data-bname="<?php echo htmlspecialchars($product['name'] ?? '') ?>"
        data-bqty="<?php echo htmlspecialchars($product['quantity'] ?? '0') ?>"
        data-bprice="<?php echo htmlspecialchars($product['price'] ?? '0') ?>"
        onclick="editModal(this)"> Edit </button>
  <?php elseif ($role === 'customer'): ?>
  <button class="btn btn-sm btn-primary order-product"
  data-id="<?php echo htmlspecialchars($product['id'] ?? '') ?>"
  data-name="<?php echo htmlspecialchars($product['name'] ?? '') ?>"
  data-qty="<?php echo htmlspecialchars($product['quantity'] ?? '0') ?>"
  data-price="<?php echo htmlspecialchars($product['price'] ?? '0') ?>"
  onclick="ordermodel(this)">Order
  </button>
  <?php else: ?>
  <button class="btn btn-sm btn-primary edit-product" disabled>
  <i class="fas fa-edit"></i> Edit
  </button>
  <?php endif; ?>
  </td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>
  </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No registered products found.
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div id="productmodal" class="modal">
    <div class="modal-content mt-0">
    <h4 class="modal-title mt-0 mb-0"><span><?php echo htmlspecialchars($title ?? '') ?></span> <span class="close" onclick="closemodal()">&times;</span></h4>

  <form class="row" action="<?php echo htmlspecialchars($address?? './database/addorder.php')?>" method="POST">
  <div class="col-md-12 mb-3">
            <label for="productname-id" class="form-label">Product Name</label>
            <input type="text" name="product" class="form-control" id="productname-id" readonly required>
          </div>
          <div class="col-md-12 mb-3">
            <label for="productprice-id" class="form-label">Unit Price</label>
            <input type="number" name="price" class="form-control" id="productprice-id" min="0.01" max="100000000000" step="0.01" required>
          </div>
          <div class="col-md-12 mb-3">
            <label for="productquantity-id" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="productquantity-id" step="1" value="1" min="1" max="10000000"  required>
          </div>

  <div class="col-md-12 mb-3">
      <div class="align-left">
      <?php if ($role === 'company'): ?>
        <button type="submit" name="productdelid" id="productdelid-id" value="" class="btn btn-danger">Delete</button>
        <?php endif; ?>
        <button type="submit" name="productid" id="productid-id" value="" class="btn btn-primary"><?php echo htmlspecialchars($update ?? 'Order') ?></button>
      </div>
    </div>
  </form>
    </div>
  </div>
    <script>
 document.addEventListener("DOMContentLoaded", function () {
  const productmodal = document.getElementById("productmodal");
  const productid = document.getElementById("productid-id");
  const productdelid = document.getElementById("productdelid-id");
  const productname = document.getElementById("productname-id");
  const productprice = document.getElementById("productprice-id");
  const productquantity = document.getElementById("productquantity-id");

  window.editModal = function (button) {
    const id = button.dataset.bid;
    const name = button.dataset.bname;
    const quantity = button.dataset.bqty;
    const price = button.dataset.bprice;
    console.log(id,name,quantity,price);
    productname.value = name;
    productquantity.value = quantity;
    productprice.value = price;
    productid.value = id;
    productdelid.value = id;
    productmodal.style.display = "block";
  };

  window.ordermodel = function (button) {
    const id = button.dataset.id;
    const name = button.dataset.name;
    const quantity = button.dataset.qty;
    const price = button.dataset.price;
    productname.value = name;
    productquantity.value = 1;
    productquantity.setAttribute("max", quantity);
    productprice.value = price;
    productprice.readOnly = true;
    productid.value = id;
    productmodal.style.display = "block";
  };

  window.closemodal = function () {
    productmodal.style.display = "none";
  };

  window.addEventListener("click", function (event) {
    if (event.target === productmodal) {
      productmodal.style.display = "none";
    }
  });
});
    </script>
