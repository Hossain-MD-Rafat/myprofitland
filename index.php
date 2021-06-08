<?php
error_reporting(0);
include "Admin/inc/db.php";
session_start();
ob_start();
$_SESSION['expire'];
$_SESSION['email'];
if (isset($_SESSION['email']) && time() <= $_SESSION['expire']) {
  header("location: home.php");
} else {
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $hashPass = md5($pass);
    $query = "select password,email_varification from user where email='$email'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result);
    if ($row[0] == $hashPass && $row[1] == 1) {
      $_SESSION['email'] = $email;
      $_SESSION['expire'] = time() + (10 * 60);
      header("location: home.php");
    }
  }
}

?>

<html>

<head>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

<style>
html,body { 
	height: 100%; 
}

.global-container{
	height:100%;
	display: flex;
	align-items: center;
	justify-content: center;
	background-color: #f5f5f5;
}

form{
	padding-top: 10px;
	font-size: 14px;
	margin-top: 30px;
}

.card-title{ font-weight:300; }

.btn{
	font-size: 14px;
	margin-top:20px;
}


.login-form{ 
	width:330px;
	margin:20px;
}

.sign-up{
	text-align:center;
	padding:20px 0 0;
}

.alert{
	margin-bottom:-30px;
	font-size: 13px;
	margin-top:20px;
}
</style>
</head>
<body>
  <div class="global-container">
    <div class="card login-form">
      <div class="card-body">
        <h3 class="card-title text-center">Log in</h3>
        <div class="card-text">
          <!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
          <form action="index.php" method="POST">
            <!-- to error: add class "has-danger" -->
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" name="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" required="1">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <!--a href="#" style="float:right;font-size:12px;">Forgot password?</a-->
              <input type="password" name="password" class="form-control form-control-sm" id="exampleInputPassword1">
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign in</button>

            <div class="sign-up">
              Don't have an account? <a href="user_register.php">Create One</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>