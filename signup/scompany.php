<div class="container d-flex justify-content-center align-items-center"> 
   <div class="card p-3 shadow-sm" style="max-width: 700px;">
      <h4 class="text-center mb-4">Company Sign Up</h4>
      <form action="./csignup.php" method="POST" class="row" >
          <div class="col-md-6 mb-3">
            <label for="name-id" class="form-label">Company Name</label>
            <input type="text" name="name" class="form-control" id="name-id" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="phone-id" class="form-label">Phone</label>
            <input type="tel" name="phone" class="form-control" id="phone-id" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="address-id" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="address-id" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="username-id" class="form-label">Username</label>
            <input type="email" name="username" class="form-control" id="username-id" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="newpassword" class="form-label">New Password</label>
            <input type="password" name="newpassword" class="form-control" id="newpassword-id" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="checkpassword-id" class="form-label">Confirm Password</label>
            <input type="password" name="checkpassword" class="form-control" id="checkpassword-id" required>
          </div>
          <div class="col-md-9 mb-3">
          <?php 
            if(isset($error_message)){
              echo $error_message;
            }
            ?>
          </div>
          <div class="col-md-2 mb-3 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mt-2" name="signup">Signup</button>
          </div>
      </form>
    </div>
          </div>
