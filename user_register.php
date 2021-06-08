<?php
ob_start();
  include 'Admin/inc/db.php';
  $p = "";
  if(isset($_POST['register']))
  {
    $email = mysqli_real_escape_string($db, $_POST['new_email']);
    $pass = mysqli_real_escape_string($db, $_POST['new_pass']);
    $con_pass = mysqli_real_escape_string($db, $_POST['new_con_pass']);
    if($pass === $con_pass){
      $password = md5($pass);
      $vCode     = md5(time().$email);
      if(mysqli_query($db,"INSERT INTO user(email,password,vCode) VALUES ('$email','$password','$vCode')")){
        //echo "yes2";
        $to       = $email;
        $subject  = "MyProfitLand Email varification";
        $message  = "<a href='project.rafathasan.com/verification.php?vCode=".$vCode."'>Please click here to confirm registration</a>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";
        $p        = "Please check your email to confirm the registration";
        //echo $to.$subject.$message.$headers;
        if(mail($to, $subject, $message, $headers)){
          header("location: thankyou.php");
        }
        else{
            echo "mail problem";
        }
      }
      else
      {
        $p = "There is error occured";
      }
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

    <title>Register</title>
  </head>
  <body>
  <form action="user_register.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="new_email" id="exampleInputEmail1"
     aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">
    We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="new_pass" id="exampleInputPassword1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control" name="new_con_pass" id="exampleInputPassword1">
  </div>
 
  <button type="submit" name="register" class="btn btn-primary">Register</button>
  </form>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </body>
</html>
<?php
?>