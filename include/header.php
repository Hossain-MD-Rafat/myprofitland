<?php
include "db.php";
include "config.php";
session_start();
ob_start();
$email = "";
$now =  time();
if (isset($_SESSION['email']) && $now <= $_SESSION['expire']) {
  $email          = $_SESSION['email'];
  $query          = "select * from user where email='$email'";
  $results        = mysqli_query($db, $query);
  $user           = mysqli_fetch_assoc($results);
  $name           = $user['user_name'];
  $uEmail         = $user['email'];
  $nationality    = $user['nationality'];
  $gold           = $user['gold'];
  $energy         = $user['energy'];
  $euro           = $user['euro'];
  $image          = $user['image'];
  $_SESSION['expire'] = time() + (10 * 60);
} else {
  session_unset();
  session_destroy();
  ob_flush();
  header("location: index.php");
}
?>



<!DOCTYPE HTML>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <title>NEWEST</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <div id="banner">
    <p><a href=" "><img src="image/home.gif" alt="homepage"></a></p>
    <a class="navbar-brand" href="#"><img src="images/logo-site.png" alt=""></a>
  </div>
  <div id="menu">
    <ul id="nav">
      <li id="home"class="activelink"><a href="index.php">Home</a></li>
      <!--<li id="who" ><a href="#">About</a></li>
      <li id="prod"><a href="#">Product</a></li>
      <li id="serv"><a href="#">Services</a></li>
      <li id="cont"><a href="#">Contact us</a></li>-->
    </ul>
  </div>

  <div class="leftbar">
    <div class="image">
      <img src="<?php echo $image; ?>" class="img-circle elevation-2" alt="User Image">
    </div>
    <div style="position:relative; padding-left:85px; height:78px">
      <div style="position:absolute; left:0; top:0; ">
        <a href="">
          <img title="" width="75" height="75" class="img-circle" src="">
        </a>
      </div>
      <p class="nw" style="margin-left: 40px;">
        <b style="font-size: 18px"><?php echo $name ?></b>
        <br>
        <!-- <img width="13" height="13" src=""-->
        <span class="small" style="font-size: 12px"><?php echo $nationality ?>
      </p>
    </div>
    <div class="text-center small">
      <b>Energy:</b> <?php echo $energy ?><a class="icon icon-circle-info" data-toggle="modal tooltip" title="" href=""></a> </div>
    <div class="progress progress-xs mb-sm-10">
      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="12.22" aria-valuemin="0" aria-valuemax="100" style="width: 12.22%;">
      </div>
    </div>
    <div class="text-center small">
      <b>XP Level:</b> 9 </div>
    <div class="progress progress-xs mb-sm-10" data-toggle="tooltip" title="" data-original-title="Progress: 333/1342&nbsp;&nbsp;&nbsp;24%">
      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100" style="width: 24%;"></div>
    </div>
    <div class="text-center">
    </div>
    <p><img width="16" height="16" src="image/euro.png"> <?php echo $euro ?></p>
    <p><img width="16" height="16" src="image/gold.png"> <?php echo $gold ?> <a class="icon icon-line-chart" href=""></a></p>
    <a href="settings.php">Edit Profile</a><br>

    <ul class="list-group">
      <li class="list-group-item"><a href="myCompanies.php">My Companies</a></li>
    </ul>
    <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Market
        <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="bidding.php">Bidding</a></li>
        <li><a href="currency_exchange.php">Currency Exchange</a></li>
      </ul>
    </div>

    <a href="log_out.php">log out</a>

  </div>
  <div class="invest">
    <?php
    // Fetch products from the database 
    //$email = "rafat.rafathasan18@gmail.com";
    ?>
    <div class="pro-box">
      <div class="body">
        <h5><?php echo "Invest"; ?></h5>
        <!-- PayPal payment form for displaying the buy button -->
        <form action="<?php echo PAYPAL_URL; ?>" method="post">
          <!-- Identify your business so that you can collect the payments. -->
          <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
          <!-- Specify a Buy Now button. -->
          <input type="hidden" name="cmd" value="_xclick">
          <!-- Specify details about the item that buyers will purchase. -->
          <!--<input type="hidden" name="item_name" value=" //echo $row['name'];s">-->
          <input type="hidden" name="email" value="<?php echo $email; ?>">
          <input type="hidden" name="amount" value="<?php echo $amount; ?>">
          <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
          <!-- Specify URLs -->
          <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
          <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
          <input type="hidden" name="notify_url" value="<?php echo PAYPAL_NOTIFY_URL; ?>">
          <!-- Display the payment button. -->
          <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif">
        </form>
      </div>
    </div>
  </div>
  <div class="withdraw">
     <button type="button" class="btn btn-dark"><a href="withdraw.php">Request For Withdraw</a></button>
  </div>
  <?php
  ob_end_flush();
  ?>