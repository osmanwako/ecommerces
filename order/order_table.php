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
                                <th class="table-col-qnty">Quantity</th>
                                <th class="table-col-price">Total Price</th>
                                <th class="table-col-action">Status</th>
                                <th class="table-col-action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product['name'] ?? '') ?></td>
                                    <td><?php echo htmlspecialchars($product['brand'] ?? '') ?></td>
                                    <td><?php echo htmlspecialchars($product['model'] ?? '') ?></td>
                                    <td class="table-col-qnty"><?php echo htmlspecialchars($product['quantity'] ?? '') ?></td>
                                    <td class="table-col-price">$<?php echo number_format($product['price'] ?? 0, 2) ?></td>
                                    <td class="table-col-action"><?php echo htmlspecialchars($product['status'] ?? '') ?></td>
                                    <td class="table-col-action">
                                        <?php if ($role === 'company'): ?>
    <button class="btn btn-sm btn-primary"
        data-bname="<?php echo htmlspecialchars($product['name'] ?? '') ?>"
        data-borderid="<?php echo htmlspecialchars($product['orderid'] ?? '0') ?>"
        onclick="replayModal(this)">Replay</button>
  <?php elseif ($role === 'customer'): ?>
  <button class="btn btn-sm btn-danger order-product"
  data-orderid="<?php echo htmlspecialchars($product['orderid'] ?? '') ?>"
  data-name="<?php echo htmlspecialchars($product['name'] ?? '') ?>"
  onclick="removeModel(this)">Remove
  </button>
  <?php else: ?>
  <button class="btn btn-sm btn-primary edit-product" disabled>
  <i class="fas fa-edit"></i> Modify
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

  <form class="row" action="<?php echo htmlspecialchars($address?? './database/updateorder.php')?>" method="POST">
  <div class="col-md-12 mb-3">
            <label for="productname-id" class="form-label">Product Name</label>
            <input type="text" name="product" class="form-control" id="productname-id" readonly required>
          </div>

  <div class="col-md-12 mb-3">
      <div class="align-left">
      <?php if ($role === 'company'): ?>
        <button type="submit" name="orderid" id="orderid-id" value="" class="btn btn-primary">Approve</button>
        <?php endif; ?>
        <button type="submit" name="orderdelid" id="orderdelid-id" value="" class="btn btn-danger"><?php echo htmlspecialchars($update ?? 'Delete') ?></button>
      </div>
    </div>
  </form>
    </div>
  </div>
    <script>
 document.addEventListener("DOMContentLoaded", function () {
  const productmodal = document.getElementById("productmodal");
  const orderid = document.getElementById("orderid-id");
  const orderdelid = document.getElementById("orderdelid-id");
  const productname = document.getElementById("productname-id");

  window.replayModal = function (button) {
    const name = button.dataset.bname;
    const id = button.dataset.borderid;
    productname.value = name;
    orderid.value = id;
    orderdelid.value = id;
    productmodal.style.display = "block";
  };

  window.removeModel = function (button) {
    const name = button.dataset.name;
    const id = button.dataset.orderid;
    productname.value = name;
    orderdelid.value = id;
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
