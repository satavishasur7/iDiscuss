<?php 
    echo '
    <div class="modal fade" id="SigninModal" tabindex="-1" aria-labelledby="SigninModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="SigninModalLabel">Sign In</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="container my-2">
          <form action="_signin.php" method="POST">
              <div class="mb-3">
                  <label for="username" class="form-label">Email:</label>
                  <input type="email" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                  
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="mb-3">
                  <label for="cpassword" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword">
                  <div id="emailHelp" class="form-text">Please Enter the same password</div>
              </div>
              
              <button type="submit" class="btn btn-success">Sign In</button>
          </form>
      </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>';

?>