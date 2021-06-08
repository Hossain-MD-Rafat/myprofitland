<?php
include 'include/header.php';
if (isset($_POST['request'])) {
    $paypalEmail = mysqli_real_escape_string($db, $_POST['email']);
    $amount      = mysqli_real_escape_string($db, $_POST['amount']);
    
    if (preg_match('/^[0-9]+(\.[0-9]{2})?$/', $amount)) {
        $userAmount  = mysqli_query($db, "select euro from user where email='$email';");
        $userAmount  = mysqli_fetch_assoc($userAmount);
        $totalAmount = $amount + $amount * .1;
        if ($userAmount['euro'] >= $totalAmount) {
            $avAmount = $userAmount['euro'] - $totalAmount;
            $amount = (float)$amount;
            //echo $amount;
            //echo $paypalEmail;
            $sql = "insert into withdraw (email, amount) values ('$paypalEmail', $amount);";
            if(mysqli_query($db,$sql))
            {
                if(mysqli_query($db,"update user set euro = $avAmount where email='$email';")){
                    echo "<h2 class='alert alert-success'>Request sent</h2>";
                }
                else
                {
                    echo "<h2 class='alert alert-danger'>cond 2</h2>";
                }
            }
            else
            {
                echo "<h2 class='alert alert-danger'>cond 1</h2>";
            }
        }
        else
        {
            echo "<h2 class='alert alert-danger'>Not suffcient balance</h2>";
        }
    }
    else
    {
        echo "<h2 class='alert alert-danger'>Enter valid amount</h2>";
    }
}
?>

<div class="global-container col-md-6 offset-md-2">
    <div class="card login-form">
        <div class="card-body">
            <h3 class="card-title text-center">Request For Withdraw</h3>
            <p class="card-title text-center">For Every withdraw, there will be 10% charge</p>
            <div class="card-text">
                <!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                <form action="withdraw.php" method="POST">
                    <!-- to error: add class "has-danger" -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Paypal Email</label>
                        <input type="email" name="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter your paypal account email" required="1">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" name="amount" class="form-control form-control-sm" id="amount" placeholder="eg: 100.50" required="1">
                    </div>
                    <button type="submit" name="request" class="btn btn-primary btn-block">Request</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include 'include/footer.php';
?>