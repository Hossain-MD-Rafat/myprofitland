<?php
include './include/header.php';
$quer = mysqli_query($db, "select equivalent_euro from admin");
$quer = mysqli_fetch_assoc($quer);
$eqEuro = $quer['equivalent_euro'];
if(isset($_POST['submit'])){
    $gold = $_POST['gold'];
    $gold = (int)$gold;
    $qu = mysqli_query($db, "select gold, euro from user where email='$email'");
    $qu = mysqli_fetch_assoc($qu);
    $aGold = $qu['gold'];
    $aGold = (int)$aGold;
    if($aGold>=$gold){
        $euro = $qu['euro'];
        $euro = (float)$euro;
        $eqEuro = (float)$eqEuro;
        $euro = $euro + ($gold*$eqEuro);
        $aGold -=$gold;
        $qu = mysqli_query($db, "update user set gold=$aGold, euro=$euro where email='$email'");
        if($qu)
        {
            echo "converted succesfully";
        }
    }
}
?>
<div class="global-container">
	<div class="card login-form">
	<div class="card-body">
		<h3 class="card-title text-center"><?php echo $eqEuro." for 1 gold coin" ?></h3>
		<div class="card-text">
			<!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
			<form action="currency_exchange.php" method="POST">
				<!-- to error: add class "has-danger" -->
				<div class="form-group">
					<label for="exampleInputEmail1">Enter Gold to convert</label>
					<input type="text" name="gold" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
				</div>
				<button type="submit" name="submit" class="btn btn-primary btn-block">convert</button>
			</form>
		</div>
	</div>
</div>
</div>
<?php
include 'include/footer.php';
?>