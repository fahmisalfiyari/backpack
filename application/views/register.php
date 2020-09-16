<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo isset($title)?$title:'Backpack Register';?></title>

  <!-- Custom fonts for this template-->
  <link href="<?=base_url().'assets/bootstrap/vendor';?>/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?=base_url().'assets/bootstrap/css';?>/sb-admin-2.min.css" rel="stylesheet">
 
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
					<?php 
						if(@$_GET['status'] == 'failed'){ ?>
							<h1 class="h4 text-gray-900 mb-4">Password Missmatch</h1>
					<?php } 
						else if(@$_GET['status'] == 'fail'){ ?>
							<h1 class="h4 text-gray-900 mb-4">User already registered</h1>
					<?php }
						else if(@$_GET['status'] == 'failure'){ ?>
							<h1 class="h4 text-gray-900 mb-4">Please tick the "Agreement" checkbox</h1>
					<?php }
						else { ?>                 
							<h1 class="h4 text-gray-900 mb-4">Hello There!</h1>
					<?php } ?>
                  </div>
                  <form method="post" action="actRegister" class="user">
					<div class="form-group">
                      <input pattern="([A-z0-9À-ž\s]){2,}" type="text" class="form-control form-control-user" id="exampleInputFullName" name="inputFullName" aria-describedby="emailHelp" placeholder="Enter Your Name..">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="inputPassword" placeholder="Password">
                    </div>
					<div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputRetypePassword" name="inputRetypePassword" placeholder="Retype Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="customCheck">
                        <label class="custom-control-label" for="customCheck">Agree to Our <a href="https://www.google.com">Terms and Conditions</a></label>
                      </div>
                    </div>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button class="btn btn-primary btn-user btn-block" type="submit" name="registerbtn" id="registerbtn">
                      Sign Up!
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgotPassword">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="login">Have an Account?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?=base_url().'assets/bootstrap/vendor';?>/jquery/jquery.min.js"></script>
  <script src="<?=base_url().'assets/bootstrap/vendor';?>/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=base_url().'assets/bootstrap/vendor';?>/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=base_url().'assets/bootstrap/js';?>/sb-admin-2.min.js"></script>

</body>

</html>
