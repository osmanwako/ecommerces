<div class="container d-flex justify-content-center align-items-center"> 
    <div class="card shadow-sm" style="max-width: 700px;">
      <h3 class="text-center">Add Company Products</h3>
      <form action="./product.php" method="POST" class="row">
          <div class="col-md-6 mb-3">
            <label for="name-id" class="form-label">Product</label>
            <input type="text" name="name" class="form-control" id="name-id" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="brand-id" class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" id="brand-id" required >
          </div>
          <div class="col-md-6 mb-3">
            <label for="model-id" class="form-label">Model</label>
            <input type="text" name="model" class="form-control" id="model-id"  required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="size-id" class="form-label">Size</label>
            <input type="text" name="size" class="form-control" id="size-id"  required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="price-id" class="form-label">Unit Price</label>
            <input type="number" name="price" class="form-control" id="price-id" min="0" max="100000000000" step="0.01" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="quantity-id" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="quantity-id" step="1" min='1' max="10000000"  required>
          </div>
          <div class="col-md-9 mb-3">
            <?php 
            if(isset($error_message)){
              echo $error_message;
            }
            ?>
          </div>
          <div class="col-md-2 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="signup" >Save</button>
          </div>
      </form>
    </div>
          </div>