<?php
ob_start();
include "include/header.php";

$user = $_GET['email'];
$company = $_GET['company_name'];
if(isset($_POST['confirm'])){
$bid = mysqli_query($db, "select bid_price from user_company_list where email=$user and company_name=$company;");
$bid  = mysqli_fetch_assoc($bid);
$bid  = $bid['bid_price'];
if($bid==0){
    $bid = mysqli_query($db, "select entry_fee from company where company_name=$company;"); 
    $bid  = mysqli_fetch_assoc($bid);
    $bid  = $bid['entry_fee'];
}
    $bid  = (float)$bid;
    echo $bid;
    $bid = $bid*(0.7);
    //echo $bid;
    $rs = mysqli_query($db, "update user_company_list set bid_price=$bid, is_bidding=1 where email=$user and company_name=$company");
    if($rs) 
    {
        header("location: bidding.php");
    }
}
if(isset($_POST['cancel'])){
    header("location: home.php");
    ob_end_flush();
}
?>

<div class="container">
    <div class="row">
        <form action="<?php echo 'sellShare.php?email='.$user.'&company_name='.$company;?>" method="POST">
        <div class="col-md-2">
            <button type="submit" name="confirm">confirm</button>
        </div>
        <div class="col-md-2">
            <button type="submit" name="cancel">cancel</button>
        </div>
        </form>
    </div>

</div>


<?php
include "include/footer.php";
ob_end_flush();
?>