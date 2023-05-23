<?php
require __DIR__ . '/vendor/autoload.php';
include('connection.php');

if (session_id() == "") {
  session_start();
}
if (!isset($_SESSION['user'])) {
  session_destroy();
  echo '<script>alert("You are not logged in!");
    window.location = "login.php";
    </script>';
}


// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the form data
  $course_code = $_POST["course_code"] ?? "";
  $course_title = $_POST["course_title"] ?? "";
  $schedule_date = $_POST["schedule_date"] ?? "";
  $start_time = $_POST["start_time"] ?? "";
  $end_time = $_POST["end_time"] ?? "";
  $room = $_POST["room"] ?? "";
  $section = $_POST["section"] ?? "";

  try {
    // Validate start time and end time
    if ($start_time >= $end_time) {
      throw new Exception("Start time should not be later than end time. Please try Again");
    }

    // Validate start time
    if ($start_time < '07:00:00' || $start_time > '21:30:00') {
      throw new Exception("Start time cannot be earlier than 7:00 am or later than 9:30 pm. Please try again");
    }

    // Validate end time
    if ($end_time < '07:00:00' || $end_time > '21:30:00') {
      throw new Exception("End time cannot be earlier than 7:00 am or later than 9:30 pm. Please try again");
    }

    //validate course title length
    if (strlen($course_title) > 255) {
      throw new Exception("Course title cannot be more than 255 characters.");
    }

    //validate course code length
    if (strlen($course_code) > 50) {
      throw new Exception("Course code cannot be more than 50 characters.");
    }

    //validate room length
    if (strlen($room) > 20) {
      throw new Exception("Room cannot be more than 20 characters.");
    }

    //validate section length
    if (strlen($section) > 20) {
      throw new Exception("Section cannot be more than 20 characters.");
    }

    // Check if the course title already exists with a different course code
    $ref_table = "schedule";
    $fetch_data = $database->getReference($ref_table)
      ->orderByChild('course_title')
      ->equalTo($course_title)
      ->getValue();
    if ($fetch_data > 0) {
      foreach ($fetch_data as $key => $row) {
        if ($_SESSION['user'] == $row['user']) {
          throw new Exception("The course title already exists with a different course code. Please try again.");
        }

      }
    }


    // Check if the course code already exists with a different course code
    $fetch_data = $database->getReference($ref_table)
      ->orderByChild('course_code')
      ->equalTo($course_code)
      ->getValue();
    if ($fetch_data > 0) {
      foreach ($fetch_data as $key => $row) {
        if ($_SESSION['user'] == $row['user']) {
          throw new Exception("Course code already exists with a different course title. Please try again with a different course code.");
        }

      }
    }
    // Check if the schedule date and time already exist
    $fetch_data = $database->getReference($ref_table)
      ->orderByChild('date')
      ->equalTo($schedule_date)
      ->getValue();
    foreach ($fetch_data as $key => $row) {
      if ($row['start_time'] <= $start_time && $row['end_time'] >= $start_time && $_SESSION['user'] == $row['user'])
        throw new Exception("A class schedule already exists at the specified date and time. Please try again.");

      if ($row['start_time'] <= $end_time && $row['end_time'] >= $end_time && $_SESSION['user'] == $row['user'])
        throw new Exception("A class schedule already exists at the specified date and time. Please try again.");

      if ($row['start_time'] >= $start_time && $row['end_time'] <= $end_time && $_SESSION['user'] == $row['user'])
        throw new Exception("A class schedule already exists at the specified date and time. Please try again.");
    }
    $fetch_data = $database->getReference($ref_table)
      ->orderByChild('id')
      ->limitToLast(1)
      ->getValue();
    if ($fetch_data > 0) {
      foreach ($fetch_data as $key => $row) {
        $id = $row['id'] + 1;
      }
    } else {
      $id = 1;
    }
    // Insert the new class schedule into the database
    $postData = [
      'course_code' => $course_code,
      'course_title' => $course_title,
      'date' => $schedule_date,
      'start_time' => $start_time,
      'end_time' => $end_time,
      'room' => $room,
      'section' => $section,
      'user' => $_SESSION['user'],
      'id' => $id
    ];
    $database->getReference($ref_table)->push($postData);
    echo '<script>alert("New class schedule added successfully"); window.location.href="display.php";</script>';

  } catch (Exception $e) {
    echo '<div style="background-color: #ff9999; padding: 10px; border: 1px solid #cc0000; margin-top: 10px; text-align: center;">Error: ' . $e->getMessage() . '</div>';
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

    < !-- Form styles-->input {
      appearance: none;
      border-radius: 0;

    }

    input #schedule_date .input-field {
      color: #fff;
    }

    .input {
      color: #fff;
      display: flex;
      flex-direction: column-reverse;
      position: relative;
      padding-top: 1.5rem;

      &+.input {
        margin-top: 1.5rem;
      }
    }

    .input-label {
      color: #fff;
      position: absolute;
      top: 1.5rem;
      transition: .25s ease;
    }

    .input-field {
      color: black;
      border: 0;
      z-index: 1;
      background-color: transparent;
      border-bottom: 2px solid #eee;
      font: inherit;
      font-size: 1.125rem;
      padding: .25rem 0;

      &:focus,
      &:valid {
        outline: 0;
        border-bottom-color: #523F73;

        &+.input-label {
          color: #523F73;
          transform: translateY(-1.5rem);
        }
      }
    }

    .action {
      margin-top: 2rem;
    }

    .action-button {
      font: inherit;
      font-size: 1.25rem;
      padding: 1em;
      width: 100%;
      font-weight: 500;
      background-color: #523F73;
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

    .input-box input {

      position: relative;
      height: 50px;
      width: 100%;
      outline: none;
      font-size: 1rem;
      color: black;
      margin-top: 8 px;
      border: 1px solid #ddd;
      border-radius: 6px;
      padding: 0 15px;
    }

    .input-box label {
      padding-top: 1.5rem;
      color: #fff;
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
          <h2>Add Schedule</h2>
        </div>
        <div class="rounded p-5 pinkbgcolor mt-4" style="width: 80%">

          <form method="post" action="add_class.php">
            <div class="input">
              <input type="text" class="input-field" name="course_code" required>
              <label class="input-label">Course Code:</label>
            </div>

            <div class="input">
              <input class="input-field" type="text" name="course_title" required>
              <label class="input-label">Course Title:</label>
            </div>


            <?php
            // Get the current day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
            $day_of_week = date('w');

            if ($day_of_week == 0) {
              $Current = Date('N');
              $DaysToSunday = 7 - $Current;
              $DaysFromMonday = $Current - 1;
              $saturday_date = Date('Y-m-d', strtotime("+ {$DaysToSunday} Days"));
              $monday_date = Date('Y-m-d', strtotime("- {$DaysFromMonday} Days"));
            } else {
              // Calculate the date of the closest Monday
            
              $monday_date = date('Y-m-d', strtotime('-' . ($day_of_week - 1) . ' days'));

              // Calculate the date of the closest Saturday
              $saturday_date = date('Y-m-d', strtotime('+' . (6 - $day_of_week) . ' days'));
            }


            // Output the form input for schedule date
            echo '<div class="input-box">';
            echo '<label  for="schedule_date">Schedule Date:</label>';
            echo '<input  type="date" id="schedule_date" name="schedule_date" min="' . $monday_date . '" max="' . $saturday_date . '" required >';

            echo '</div>';
            ?>


            <div class="input-box">
              <label>Start Time:</label>
              <input type="time" name="start_time" required>

            </div>

            <div class="input-box">
              <label>End Time:</label>
              <input type="time" name="end_time" required>

            </div>

            <div class="input">
              <input class="input-field" type="text" name="room" required>
              <label class="input-label">Room:</label>
            </div>

            <div class="input">
              <input class="input-field" type="text" name="section" required>
              <label class="input-label">Section:</label>
            </div>

            <div class="action">
              <input class="action-button" type="submit" value="Add Schedule">
            </div>

            <div class="action">
              <button class="action-button"><a href="display.php">View Schedule</a></button>
            </div>
          </form>

        </div>
      </main>


    </div>

</body>

</html>