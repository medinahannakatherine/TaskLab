<?php
require_once('./process-login.php');
if (session_id() == "") {
    session_start();
}

$test = new DateTime('NOW', new DateTimeZone('Asia/Singapore'));
$h = $test->format('H');
$m = $test->format('i');
$s = $test->format('s');
if ($h == 0 && $m == 0 && $s == 0) {
    require_once("message_users.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="secondarybgcolor">
    <div class="row m-0">
        <div class="col-lg-6 d-lg-block d-none p-0">
            <div class="d-flex justify-content-center align-items-center vh-100">
                <img src="imgwelcome.png" class="img-fluid p-5" style=";">
            </div>
        </div>
        <div class="col-lg-6 offset-lg-0 bgcolor vh-lg-100">
            <div class="d-flex justify-content-center mt-5">
                <h1 class="my-5 title">Welcome to <span class="secondarycolor">Task Lab</span>!</h1>
            </div>
            <div class="col-md-10 offset-md-1 p-5">
                <h3>Login</h3>
                <span>Please enter your information</span>
                <?php if (isset($alert)) { ?>
                    <div class="alert alert-success mt-4">
                        <?php echo $alert; ?>
                    </div>
                <?php } ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="row mt-4">
                        <div class="form-group col">
                            <input id="uinput2" type="text" name="user" class="form-control" value="" required
                                placeholder="Username" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <input id="uinput5" type="password" name="pass" class="form-control mt-4" value="" required
                                placeholder="Password" />
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <!--<small class="d-block mt-2">
                            <a href="#" class="text-muted">Forgot Password</a>
                        </small>-->
                    </div>
                    <button name="submit" type="submit" class="btn mt-5 py-2 w-100 buttonbg">
                        Login
                    </button>
                    <small class="d-block mt-3 text-muted">
                        Don't have an account? <a href="onboard.php" class="text-muted">Sign up for free</a>
                    </small>
                </form>
            </div>
        </div>
        <div class="d-lg-none p-0 gradient">
            <div class="d-flex justify-content-center align-items-center">
                <img src="imgwelcome.png" class="img-fluid p-5">
            </div>
        </div>
    </div>
</body>

</html>