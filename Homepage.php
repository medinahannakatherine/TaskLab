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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <meta charset="UTF-8">
    <title>View Projects</title>
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
        /* view proj page ONLY css*/
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
                    <a class="navbar-brand" href="#">TaskLab</a>
                    <button class="navbar-toggler buttonbg" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars p-2"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
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
                            <a class="nav-link active" href="#">
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
            <main class="col-lg-10 px-4">
                <div class="text-end">
                    <h2 class="my-4 mx-5 d-lg-block d-none">View Projects</h2>
                </div>
                <div class="d-lg-none">
                    <div class="d-flex justify-content-center my-4">
                        <h2>View Projects</h2>
                    </div>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto mb-5">
                    <a href="create.php" class="btn btn-lg buttonbg" role="button">Create Project</a>
                </div>
                <!--SINGLE PROJECT INSTANCE-->
                <?php
                //retrieve the collection for the specific key
                require __DIR__ . '/vendor/autoload.php';
                include('connection.php');
                $count = 0;
                $ref_table = "act";
                $fetch_data = $database->getReference($ref_table)->getValue();
                if ($fetch_data > 0) {
                    foreach ($fetch_data as $key => $row) {
                        //only post the activities with the same user key! 
                        if ($row['user'] == $_SESSION['key']) {
                            $count = $count + 1;
                            ?>
                            <div class="rounded p-3 mb-4 pinkbgcolor">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">
                                        <?php
                                        echo $row['Title'];
                                        ?>
                                    </h5>
                                    <span class="badge statustext rounded-pill <?php
                                    if ($row['Status'] == "Past Deadline")
                                        echo "bg-danger";
                                    if ($row['Status'] == "In progress")
                                        echo "bg-secondary";
                                    if ($row['Status'] == "Finished")
                                        echo "bg-success";
                                    if ($row['Status'] == "On Hold")
                                        echo "bg-secondary";
                                    ?>">
                                        <?php
                                        echo $row['Status'];
                                        ?>
                                    </span>
                                </div>
                                <div>
                                    <span class="badge secondarypinkbgcolor projectcat rounded">
                                        <?php
                                        echo $row['Category'];
                                        ?>
                                    </span>
                                    <a href="editproj.php?key=<?php
                                    echo $key;
                                    ?>" class="text-decoration-none ms-3">
                                        <i class="fa-regular fa-pen-to-square fas"></i>
                                    </a>
                                    <a href="deleteproj.php?key=<?php
                                    echo $key;
                                    ?>" class="text-decoration-none ms-3 delete">
                                        <i class="fa-regular fa-trash fas"></i>
                                    </a>
                                </div>
                                <p class="mb-2 mt-1">Project Deadline:
                                    <?php
                                    echo $row['deadline'];
                                    ?>
                                </p>
                                <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#<?php
                                echo $key;
                                ?>" aria-expanded="false" aria-controls="<?php
                                echo $key;
                                ?>" id="view-tasks-btn-1">
                                    View Tasks
                                </button>
                                <div class="collapse mt-3" id="<?php
                                echo $key;
                                ?>" data-bs-parent=".rounded">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Subtasks</h6>
                                        <button class="btn btn-outline-dark btn-sm mb-2" type="button" data-bs-toggle="modal"
                                            data-bs-target="#create-<?php
                                            echo $key;
                                            ?>">
                                            Create Subtask <i class="bi bi-plus-circle"></i>
                                        </button>
                                        <!--POPUP START-->
                                        <div class="modal fade" id="create-<?php
                                        echo $key;
                                        ?>" tabindex="-1" aria-labelledby="create-<?php
                                        echo $key;
                                        ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="create-subtask-modal-label">Create Subtask</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="process-subtask.php" method="POST">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="subtask-name" class="form-label">Subtask Name</label>
                                                                <input type="text" class="form-control" id="subtask-name"
                                                                    name="subtask-name" required>
                                                                <input type="text" class="form-control" id="task_id" name="task_id"
                                                                    value="<?php echo $key; ?>" required hidden>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn buttonbg">Create</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--POPUP END-->
                                    </div>
                                    <div class="card card-body">
                                        <ul class="list-group">
                                            <?php
                                            if (is_array($row['Subtasks'])) {
                                                foreach ($row['Subtasks'] as $key2 => $sub) {
                                                    if ($sub == "") {
                                                    } else {
                                                        ?>
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-center <?php echo ($sub['status'] == "finished") ? "finished" : "" ?>">
                                                            <?php
                                                            echo $sub['name'];
                                                            ?>
                                                            <button id=<?php echo $key . '.' . $key2; ?>
                                                                class="btn <?php echo ($sub['status'] == "finished") ? "btn-secondary" : "btn-success" ?> btn-sm"
                                                                onClick="toggleTaskStatus(this);">
                                                                <i
                                                                    class="bi <?php echo ($sub['status'] == "finished") ? "bi-arrow-clockwise" : "bi-check" ?>"></i>
                                                            </button>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                            } else {
                                                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>No Subtasks For the projects</li>";
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END OF SINGLE PROJECT INSTANCE-->
                            <?php
                        }


                    }
                } else {
                    echo "<h3>No Saved Projects</h3>";
                }
                if ($count == 0) {
                    echo "<h3>No Saved Projects</h3>";
                }
                ?>

            </main>
        </div>
    </div>

    <script>
        function toggleTaskStatus(button) {
            const myArray = button.id.split(".");
            var n1 = myArray[0];
            var s1 = myArray[1];
            const listItem = button.parentNode;
            const isFinished = listItem.classList.contains('finished');
            if (isFinished) {
                button.classList.remove('btn-secondary');
                button.classList.add('btn-success');
                listItem.classList.remove('finished');
                button.innerHTML = '<i class="bi bi-check"></i>';
                jQuery.ajax({
                    type: "POST",
                    url: 'subtask-update.php',
                    dataType: 'json',
                    data: { functionname: 'add', arguments: [n1, s1] },
                });
            } else {
                button.classList.remove('btn-success');
                button.classList.add('btn-secondary');
                listItem.classList.add('finished'); //strikethrough class
                button.innerHTML = '<i class="bi bi-arrow-clockwise"></i>';
                jQuery.ajax({
                    type: "POST",
                    url: 'subtask-update.php',
                    dataType: 'json',
                    data: { functionname: 'min', arguments: [n1, s1] },
                });
            }
        }
        $('.delete').click(function () { return confirm("Are you sure you want to delete this project?"); });
    </script>

</body>

</html>