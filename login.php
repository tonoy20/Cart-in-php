<?php
  session_start();
  if(isset($_SESSION['uname'])) {
    header("location:user/orderCart.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="css/login.css">
  <style>
    .error{
      color:#FF6347;
    }
  </style>
</head>
<body>
<div class="container-fluid ps-md-0">
  <div class="row g-0">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
              <h3 class="login-heading mb-4">Welcome back!</h3>

              <!-- Sign In Form -->
              <form id="login_form" class="login_form" action="login_func.php" method="POST">
                <div class=" mb-3">
                <label for="">username</label>
                  <input type="text" class="form-control"   name="username">
                </div>
                <div class=" mb-3">
                  <label for="">Password</label>
                  <input type="password" class="form-control"  name="password">
                </div>

                <div class="d-grid">
                  <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit" value="Login">Sign in</button>
                  <div class="text-center">
                    <p> not a member?<a class="small btn-login text-uppercase fw-bold mb-2" href="./user/registerUser.php">Register</a></p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="js/login_validation.js"></script>
</body>
</html>


