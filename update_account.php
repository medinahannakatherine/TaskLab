<?php
if (session_id() == "") {
    session_start();
}
if (isset($_SESSION["user"])) {

} else {
    echo '<script>alert("You should not be here!");
    window.location = "login.php";
    </script>';
    session_destroy();
}

require('process-update.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script src="https://kit.fontawesome.com/79a2e49394.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <style>
    /* view proj page ONLY css*/
    @media (min-width: 767px) and (max-width: 992px) {
      
    }
    /*end of view proj page ONLY css*/
    .fas {
        color: #392759;
    }
    .buttonbg {
        background-color: #392759;
        color: white;
    }
    .buttonbg:hover {
      background-color: #523F73;
      color: white;
    }
    .linklabel {
        color: black;
        font-weight: 500;
    }
    body {
        font-family: 'Poppins', sans-serif;
    }
    .profileimage {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        margin: auto;
        margin-bottom: 10px;
    }
    .sidebar-profile {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        text-align: center;
    }
    .bgcolor {
        background-color: #E8F0FF;
    }
    .pinkbgcolor {
        background-color: #F7ACCF;
        margin-right: 10%;
        margin-left: 10%;
    }
    .secondarypinkbgcolor {
      background-color: #e768a4;
    }
  </style>
</head>

<body class="bgcolor">
<div class="container-fluid">
  <div class="row h-100">
    <!--NAVBAR START-->
    <nav class="d-lg-none navbar navbar-expand-lg bgcolor m-0">
      <div class="container-fluid">
        <a class="navbar-brand" href="Homepage.php">TaskLab</a>
        <button class="navbar-toggler buttonbg" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa-solid fa-bars p-2"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="Homepage.php">
                <i class="fas fa-rectangle-list me-2"></i>
                <span class="linklabel">Projects</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="clock timer.php">
                <i class="fas fa-clock me-2"></i>
                <span class="linklabel">Clock</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="display.php">
                <i class="fas fa-calendar-alt me-2"></i>
                <span class="linklabel">Schedule</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-user-circle me-2"></i>
                <span class="linklabel">Account</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">
                <i class="fas fa-right-from-bracket me-2"></i>
                <span class="linklabel">Logout</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!--NAVBAR END-->
    <!--SIDEBAR START-->
    <nav class="col-lg-2 d-lg-block d-none bgcolor"> <!--lg breakpoint : 992 px-->
      <div class="sidebar-profile">
          <img src="imguser.png" alt="User picture" class="profileimage mt-5">
          <h4 style="margin: auto; font-size: 20px; font-weight: bold;" class="mb-5">
            <?php echo $_SESSION['user']; ?>
          </h4>
      </div>
      <div class="">
        <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="Homepage.php">
                <i class="fas fa-rectangle-list me-2"></i><span class="linklabel">Projects</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="clock timer.php">
                <i class="fas fa-clock me-2"></i><span class="linklabel">Clock</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="display.php">
                <i class="fas fa-calendar-alt me-2"></i><span class="linklabel">Schedule</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-user-circle me-2"></i><span class="linklabel">Account</span>
              </a>
            </li>
            <li class="nav-item mt-5">
              <a class="nav-link" href="logout.php">
                <i class="fas fa-right-from-bracket me-2"></i><span class="linklabel">Logout</span>
              </a>
            </li>
          </ul>
      </div>
    </nav>
    <!--SIDEBAR END-->
    <main class="col-lg-10 px-4">
      <div class="text-end">
        <h2 class="my-4 mx-5 d-lg-block d-none">Manage Account Information</h2>
      </div>
      <div class="d-lg-none">
        <div class="d-flex justify-content-center my-4">
          <h2>Manage Account Information</h2>
        </div>
      </div>
        <div class="d-flex mt-5 justify-content-center align-items-center">
            <div class=" p-5">
                <h3>User Information</h3>
                <span>Edit the information below. You can change it anytime you want</span>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group ">
                        <label for="mobile" class="mt-3 mb-1 text-muted">
                            Mobile Number
                        </label>
                        <input id="mobile" type="text" name="mobile" class="form-control"
                            value="<?php echo $_SESSION["phone"]; ?>" required />
                        <label for="uinput2" class="mt-3 mb-1 text-muted">
                            Username
                        </label>
                        <input id="uinput2" type="text" name="user" class="form-control"
                            value="<?php echo $_SESSION["user"]; ?>" required />
                        <label for="uinput5" class="mt-3 mb-1 text-muted">
                            Password
                        </label>
                        <input id="uinput5" type="password" name="pass" class="form-control"
                            value="<?php echo $_SESSION["pass"]; ?>" required />
                    </div>

                    <button name="submit" type="submit" class="btn buttonbg mt-2 w-100">
                        Update Account
                    </button>
                    <small class="d-block mt-3">
                        <a href="Homepage.php" class="text-muted">Return to Home</a>
                    </small>
                </form>
            </div>
        </div>
    </main>
    </div></div>
</body>

</html>