<div class="container d-flex justify-content-center align-items-center"> 
<div class="card p-4 mb-4 shadow-sm" style="width: 100%; max-width: 450px">
        <h4 class="mb-3 text-center">Login</h4>
        <form action="login.php",autocomplete="off" class="row" method="POST">
          <div class="col-md-12 mb-3">
            <label for="username-id" class="form-label">Username</label>
            <input
              type="email"
               name="username"
              class="form-control"
              id="username-id"
            />
          </div>
          <div class="col-md-12 mb-3">
            <label for="password-id" class="form-label">Password</label>
            <input
              type="password"
              name="password"
              class="form-control"
              id="password-id"
            />
          </div>
          <div class="col-md-9 mb-3">
          <small>
              <?php
                  if (isset($error_message)) {
                      echo $error_message;
                  }
              ?>
            </small>
          </div>
          <div class="col-md-2 mb-3">
            <button type="submit" class="btn btn-primary px-3" name="login" value="Login">Login</button>
          </div>
        </form>
      </div>
                </div>