<div class="container d-flex justify-content-center align-items-center"> 
    <div class="card shadow-sm" style="max-width: 700px;">
      <h4 class="text-center">Customer Sign Up</h4>
      <form action="" method="POST" class="row">
          <div class="col-md-6 mb-3">
            <label for="firstname-id" class="form-label">First Name</label>
            <input type="text" name="firstname" class="form-control" id="firstname-id" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="middlename-id" class="form-label">Middle Name</label>
            <input type="text" name="middlename" class="form-control" id="middlename-id" required >
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastname-id" class="form-label">Last Name</label>
            <input type="text" name="lastname" class="form-control" id="lastname-id"  required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="phone-id" class="form-label">Phone</label>
            <input type="tel" name="phone" class="form-control" id="phone-id"  required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="address-id" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="address-id" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="username-id" class="form-label">Username</label>
            <input type="email" name="username" class="form-control" id="username-id"  required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="newpassword-id" class="form-label">New Password</label>
            <input type="password" name="newpassword" class="form-control" id="newpassword-id"  required >
          </div>
          <div class="col-md-6 mb-3">
            <label for="checkpassword-id" class="form-label">Confirm Password</label>
            <input type="password" name="checkpassword" class="form-control" id="checkpassword-id"  required>
          </div>
          <div class="col-md-9 mb-3">
            <?php 
            if(isset($error_message)){
              echo $error_message;
            }
            ?>
          </div>
          <div class="col-md-2 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="signup" >Signup</button>
          </div>
      </form>
    </div>
          </div>