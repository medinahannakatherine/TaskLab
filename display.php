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

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Schedule</title>
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
                <a class="nav-link" href="clock timer.php">
                  <i class="fas fa-clock me-2"></i>
                  <span class="linklabel">Clock</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
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
              <a class="nav-link" href="#">
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
          <h2>Schedule</h2>
        </div>
        <div class="rounded p-5 pinkbgcolor mt-4 col-lg-10">

          <?php
          require __DIR__ . '/vendor/autoload.php';
          include('connection.php');

          // Get the current week's dates
          $week_start = strtotime('monday this week');
          $week_end = strtotime('saturday this week');

          // Generate the day labels
          $day_labels = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

          // Output the schedule table
          echo '<table class="mx-auto">';
          echo '<thead><tr><th>Time</th>';

          // Output the day labels
          foreach ($day_labels as $day_label) {
            echo '<th>' . $day_label . '</th>';
          }

          echo '</tr></thead><tbody>';

          // Loop through each hour from 8:00 AM to 7:00 PM
          for ($hour = 7; $hour <= 21; $hour++) {
            for ($minute = 0; $minute <= 30; $minute += 30) {
              // Format the hour and minute
              $time = sprintf('%02d:%02d', $hour, $minute);
              // Output the time row
              echo '<tr><td>' . $time . '</td>';
              // Loop through each day of the week
              for ($day = 0; $day <= 5; $day++) {
                // Calculate the date for the current day
                $date = date('Y-m-d', strtotime('+' . $day . ' days', $week_start));
                // Retrieve the class schedule for the current date and time
                $ref_table = "schedule";
                $fetch_data = $database->getReference($ref_table)
                  ->orderByChild('date')
                  ->equalTo($date)
                  ->getValue();
                echo '<td>';
                foreach ($fetch_data as $key => $row) {
                  if ($row['start_time'] <= $time && $row['end_time'] > $time && $_SESSION['user'] == $row['user']) {
                    echo '<b>' .  $row['course_title'] . '</b><br>' . 'Room ' . '<b>' . $row['room'] . '</b><br>' . 'Section - <b>' . $row['section'] . '</b>';
                  }
                }

                echo '</td>';
              }
              echo '</tr>';
            }
          }
          echo '</tbody></table>';
          ?>
        </div>
        <div class="action text-center">
          <a href="add_class.php"><button class="action-button">Add Class</button></a>
          <a href="manage_class.php"><button class="action-button">Manage Class</button></a>
        </div>



      </main>


    </div>

</body>

</html>