<?php
include 'inc/db.php';
include 'inc/header.php';
if(isset($_POST['ok'])){
    $eu    = mysqli_real_escape_string($db, $_POST['euro']);
    $euro  = number_format((float)$eu, 2);
    $email = $_SESSION['admin'];
    $res   = mysqli_query($db, "update admin set equivalent_euro = $euro where email = '$email'");
    if($res)
    {
        echo "updated";
    }

}


?>
<div class="global-container col-md-8 offset-md-2">
        <div class="card login-form">
            <div class="card-body">
                <h3 class="card-title text-center">set the price for One Gold Coin</h3>
                <div class="card-text">
                    <!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                    <form action="gold_euro.php" method="POST">
                        <!-- to error: add class "has-danger" -->
                        <div class="form-group">
                            <input type="text" name="euro" class="form-control form-control-sm" id="euroid" placeholder="set euro for one gold coin example: 15.00" aria-describedby="emailHelp">
                        </div>
                       
                        <button type="submit" name="ok" class="btn btn-primary btn-block">ok</button>
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