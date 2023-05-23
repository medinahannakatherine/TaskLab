<?php
require './process-verify.php';

$phone = (isset($_GET['phone'])) ? $_GET['phone'] : '+000000';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Verify Page</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>

  <body class="bgcolor">
    <div class="col-lg-12 d-lg-block d-none p-0">
      <div class="row m-0">
        <img src="imgotp.png" class="img-fluid p-5 w-50 mx-auto">
      </div>
    </div>
    <div class="row m-0">
      <div class="d-lg-none p-0">
            <div class="d-flex justify-content-center align-items-center m-2">
                <img src="imgotp.png" class="img-fluid p-5 mx-auto" style="width:90%;">
            </div>
      </div>
      <div class="col-lg-4 offset-lg-4">
        <div class="p-5">
          <h3>Complete verification!</h3>
              <?php if (isset($alert)) { ?>
                  <div class="alert alert-success mt-4"><?php echo $alert; ?></div>
              <?php } ?>
          <form action="#" method="POST">
            <div class="form-group">
              <label for="code" class="mt-3 mb-1 text-muted">
                A verification code has been sent to
                <b><?php echo $phone; ?></b>, <br />
                enter the code below to continue.
              </label>
              <input
                id="code"
                type="text"
                name="code"
                class="form-control"
                required
              />
              <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
              <button
                type="submit"
                name="submit"
                class="btn buttonbg mt-2 w-100">
                Submit
              </button>
              <small class="d-block mt-3">
                <a href="onboard.php" class="text-muted">Wrong number?</a>
              </small>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>