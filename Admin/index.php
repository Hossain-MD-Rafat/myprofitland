<?php
include 'inc/db.php';
if(isset($_POST['signin'])){
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, $_POST['pass']);
    $res  = mysqli_query($db, "select password from admin where email='$email' and isApproved = 1;");
    $ress = mysqli_fetch_assoc($res);
    $main_pass = $ress['password'];
    if ($pass == $main_pass)
    {
        session_start();
        ob_start();
        $_SESSION['admin'] = $email;
        header("location: dashboard.php");
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <title></title>
</head>

<body>
    <div class="global-container col-md-8 offset-md-2">
        <div class="card login-form">
            <div class="card-body">
                <h3 class="card-title text-center">Log in to Codepen</h3>
                <div class="card-text">
                    <!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                    <form action="index.php" method="POST">
                        <!-- to error: add class "has-danger" -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <a href="#" style="float:right;font-size:12px;">Forgot password?</a>
                            <input type="password" name="pass" class="form-control form-control-sm" id="exampleInputPassword1">
                        </div>
                        <button type="submit" name="signin" class="btn btn-primary btn-block">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>