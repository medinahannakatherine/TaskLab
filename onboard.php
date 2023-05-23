<?php
require_once('./process-onboard.php');
if (session_id() == "") {
	session_start();
}

  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Welcome Page</title>
  <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body class="secondarybgcolor">
  <div class="row m-0">
      <div class="col-lg-6 offset-lg-0 bgcolor vh-lg-100">
          <div class="d-flex justify-content-center mt-5">
            <h1 class="my-5 title">Create an <span class="secondarycolor">Account</span></h1>
          </div>
          <div class="col-md-10 offset-md-1 p-5">
            <h3>Sign up</h3>
            <span>Start managing your productivity efficiently</span>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <div class="row mt-4 mb-3">
                <div class="form-group col">
                  <input id="uinput" type="text" name="fname" class="form-control" value="<?php echo $fname; ?>" required placeholder="First Name"/>
                  <input id="mobile" type="text" name="mobile" class="form-control mt-4" value="<?php echo $phone; ?>" required placeholder="Mobile Number"/>
                  <input id="uinput2" type="text" name="user" class="form-control mt-4" value="<?php echo $user; ?>" required placeholder="Username"/>
                </div>
                <div class="form-group col">
                  <input id="uinput3" type="text" name="lname" class="form-control" value="<?php echo $lname; ?>" required placeholder="Last Name"/>
                  <input id="uinput4" type="email" name="email" class="form-control mt-4" value="<?php echo $email; ?>" required placeholder="Email"/>
                  <input id="uinput5" type="password" name="pass" class="form-control mt-4" value="<?php echo $pass; ?>" required placeholder="Password"/>
                </div>
              </div>
              <button name="submit" type="submit" class="btn buttonbg mt-5 py-2 w-100">
                Sign Up
              </button>
              <div class="text-center">
                <small class="d-block mt-3 text-muted">
                  Already have an account? <a href="login.php" class="text-muted">Login</a>
                </small>
              </div>

            </form>
          </div>
      </div>
        <div class="col-lg-6 d-lg-block d-none p-0">
          <div class="d-flex justify-content-center align-items-center vh-100 p-5">
              <img src="imglogin.png" class="img-fluid p-5">
          </div>
        </div>
      <div class="d-lg-none p-0 gradient">
            <div class="d-flex justify-content-center align-items-center">
                <img src="imglogin.png" class="img-fluid p-5" style="width:80%;">
            </div>
      </div>
    </div>
</body>

</html>