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
$ref_table = "schedule";
// Retrieve the class schedules from the database
$fetch_data = $database->getReference($ref_table)
  ->orderByChild('date')
  ->getValue();


// Initialize an array to hold the class schedules grouped by schedule date
$schedules_by_date = array();

// Group the class schedules by schedule date
if ($fetch_data > 0) {
  foreach ($fetch_data as $key => $row) {
    if ($row['user'] == $_SESSION['user']) {
      $schedule_date = date('l, F j, Y', strtotime($row["date"]));
      $schedules_by_date[$schedule_date][] = $row;
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Create Project</title>
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
    * {
      box-sizing: border-box;
    }

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
      background-color: #523F73;
      margin-right: 10%;
      margin-left: 10%;
    }

    .rounded {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    table {
      border-collapse: separate;
      border-spacing: 10px;
      margin: auto;
      width: 100%;
    }

    th,
    td {
      border: none;
      padding: 10px;
      border-radius: 20px;
      background-color: #E8F0FF;
      text-align: center;
    }

    .delete {
      background-color: #F7ACCF;
      color: #fff;
      border: none;
      padding: 8px 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.2s ease-in-out;
      margin-bottom: 5px;
      /* add some margin-right */
    }

    .delete:hover {
      background-color: #cc0000;
    }

    .edit {
      background-color: #523F73;
      color: #fff;
      border: none;
      padding: 8px 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.2s ease-in-out;
    }

    .edit:hover {
      background-color: #392759;
    }

    .action {
      margin-top: 2rem;
    }

    .action-button {
      font: inherit;
      font-size: 1.25rem;
      padding: 1em;
      width: 30%;
      font-weight: 500;
      background-color: #F7ACCF;
      border-radius: 6px;
      color: #FFF;
      border: 0;

      &:focus {
        outline: 0;
      }
    }

    .action-button a {
      color: #FFF;
      text-decoration: none;
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
                <a class="nav-link" href="clock timer.html">
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
              <a class="nav-link" href="clock timer.html">
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
          <h2> Manage Schedule</h2>
        </div>
        <div class="rounded p-5 pinkbgcolor mt-4" style="width: 80%">

          <table>
            <thead>
              <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Room</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($schedules_by_date as $schedule_date => $schedules): ?>
                <tr>
                  <th colspan="8">
                    <?= $schedule_date ?>
                  </th>
                </tr>
                <?php foreach ($schedules as $schedule): ?>
                  <tr>
                    <td>
                      <?= $schedule["course_code"] ?>
                    </td>
                    <td>
                      <?= $schedule["course_title"] ?>
                    </td>
                    <td>
                      <?= date('g:i A', strtotime($schedule["start_time"])) ?>
                    </td>
                    <td>
                      <?= date('g:i A', strtotime($schedule["end_time"])) ?>
                    </td>
                    <td>
                      <?= $schedule["room"] ?>
                    </td>

                    <td>
                      <form action="delete_class.php" method="get" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?= $schedule['id'] ?>">
                        <button class="delete" type="submit">Delete</button>
                      </form>
                      <form action="edit_class.php" method="get" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?= $schedule['id'] ?>">
                        <button class="edit" type="submit">Edit</button>
                      </form>
                    </td>

                  </tr>
                <?php endforeach; ?>
              <?php endforeach; ?>
            </tbody>
          </table>


        </div>
        <div class="action text-center">
          <button class="action-button"><a href="add_class.php">Add Class</a></button>
          <button class="action-button"><a href="display.php"> View Schedule</a></button>
        </div>



      </main>


    </div>

</body>

</html>