<?php
if (session_id() == "") {
  session_start();
}
if (!isset($_SESSION['user'])) {
  session_destroy();
  echo '<script>alert("You are not logged in!");
    window.location = "login.php";
    </script>';
}
require __DIR__ . '/vendor/autoload.php';
include('connection.php');
require_once('process-editproj.php');
if (isset($_GET['key']))
  $_SESSION['act_key'] = $_GET['key'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Edit Project</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/79a2e49394.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
  <style>
    /* edit proj page ONLY css*/
    @media (min-width: 767px) and (max-width: 992px) {}

    .statustext {
      font-size: 22px;
    }

    .projectcat {
      font-size: 15px;
    }

    .finished {
      text-decoration: line-through;
    }

    /*end of edit proj page ONLY css*/
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
  </style>
</head>

<body class="bgcolor">


  <?php
  require __DIR__ . '/vendor/autoload.php';
  include('connection.php');
  $ref_table = "act";
  $getdata = $database->getReference($ref_table)->getChild($_SESSION['act_key'])->getValue();

  $Title = $getdata['Title'];
  $Category = $getdata['Category'];
  $Status = $getdata['Status'];
  $Deadline = $getdata['deadline'];



  ?>
  <div class="container-fluid">
    <div class="row h-100">
      <!--NAVBAR START-->
      <nav class="d-lg-none navbar navbar-expand-lg bgcolor m-0">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">TaskLab</a>
          <button class="navbar-toggler buttonbg" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                <a class="nav-link" href="update_account.php">
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
              <a class="nav-link" href="update_account.php">
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
      <main class="col-lg-8 ml-md-auto px-4 offset-lg-1 mb-5">
        <div class="d-flex justify-content-center mt-5">
          <h2>Edit Project</h2>
        </div>
        <div class="rounded p-5 pinkbgcolor mt-4" style="width: 80%">
          <div class="col-lg-8 offset-lg-2">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <div class="mb-5">
                <label for="project-title" class="form-label">Project Title</label>
                <input type="text" class="form-control" id="project-title" name="project-title"
                  value="<?php echo $Title; ?>" required>
              </div>
              <div class="mb-5">
                <label for="project-category" class="form-label">Project Category</label>
                <select class="form-select" id="project-category" name="project-category" required>
                  <option value="" Select a category</option>
                  <option value="Quiz" <?php echo ($Category == "Quiz") ? "selected" : "";?>>Quiz</option>
                  <option value="Readings" <?php echo ($Category == "Readings") ? "selected" : "";?>>Readings</option>
                  <option value="Research" <?php echo ($Category == "Research") ? "selected" : "";?>>Research</option>
                  <option value="Presentation" <?php echo ($Category == "Presentation") ? "selected" : "";?>>Presentation</option>
                  <option value="Case Study" <?php echo ($Category == "Case Study") ? "selected" : "";?>>Case Study</option>
                  <option value="Essay" <?php echo ($Category == "Essay") ? "selected" : "";?>>Essay</option>
                  <option value="Project Report" <?php echo ($Category == "Project Report") ? "selected" : "";?>>Project Report</option>
                  <option value="Others" <?php echo ($Category == "Others") ? "selected" : "";?>>Others</option>
                </select>
              </div>
              <div class="mb-5">
                <label for="project-status" class="form-label">Project Status</label>
                <select class="form-select" id="project-status" name="project-status" required>
                  <option value="">Select a status</option>
                  <option value="In progress" <?php echo ($Status == "In progress") ? "selected" : "";?>>In progress</option>
                  <option value="Finished" <?php echo ($Status == "Finished") ? "selected" : "";?>>Completed</option>
                  <option value="On Hold" <?php echo ($Category == "Quiz") ? "selected" : "";?>>On Hold </option>
                </select>
              </div>
              <div class="mb-5">
                <label for="project-deadline" class="form-label">Project Deadline</label>
                <input type="date" class="form-control" id="project-deadline" name="project-deadline" min="<?php
                echo date('Y-m-d');
                ?>" value=<?php echo $Deadline; ?> required>
              </div>
              <div class="row justify-content-center">
                <div class="col-auto">
                  <button type="submit" class="btn buttonbg mb-3">Save Project Details</button>
                </div>
                <div class="col-auto">
                  <a href="Homepage.php" class="btn btn-secondary mb-3">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </main>


    </div>

</body>

</html>