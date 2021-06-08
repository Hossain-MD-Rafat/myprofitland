<?php
include "include/header.php";
if(isset($_POST['sell'])){
  $em = $_GET['email'];
  $cn = $_GET['cn'];
  $bid = $_GET['bid'];
  echo $em.$cn.$bid;
  $bid = (float)$bid;
  $rs = mysqli_query($db, "select euro from user where email='$email'");
  $rs = mysqli_fetch_assoc($rs);
  $eur = $rs['euro'];
  $bid = (float)$bid;
  $eur = (float)$eur;
  $eur += $bid; 
  $rs = mysqli_query($db, "update user set euro=$eur where email='$email'");
  if($rs){
    $rss = mysqli_query($db, "select bid_email FROM user_company_list WHERE email='$email' and 
    company_name='$cn'");
    $rss = mysqli_fetch_assoc($rss);
    $newEmail = $rss['bid_email'];
    $rss = mysqli_query($db, "DELETE FROM `user_company_list` WHERE email='$email' and 
    company_name='$cn'");
    if($rss){
      $res = mysqli_query($db, "INSERT INTO `user_company_list`(`email`, `company_name`) VALUES ('$newEmail', '$cn')");
      if($res){
        echo "Your share hes been sold for ".$bid;
      }
    }
  
  }
}
?>

<div class="row">
<div class="col-sm-6">
  <h3>My Companies</h3><br>
  <p>In the list below you will find the companies that you own right now. To manage a company press the Manage button next to it. In order to produce goods, you need to have raw materials and a valid and active license. Always check the status of your license when you activate the workplaces. Use the menu above to start a new company.</p>
  <?php
  $companyList= mysqli_query($db, "SELECT company_name FROM user_company_list WHERE email = '$email'");
  while($rw = mysqli_fetch_assoc($companyList)){
    $company_name = $rw['company_name'];
    $cmpDetails = mysqli_query($db, "select * from company where company_name = '$company_name';");
    $compRes = mysqli_fetch_assoc($cmpDetails);
  ?>
  <div class="col-sm-6" style="float: left;">
  <img src="Admin/image <?php echo  $compRes['image'] ?>" alt="companylogo">
  <h5><?php echo $compRes['company_name']?></h5>
  <h6><?php echo $compRes['entry_fee']?></h6>
  <?php
  $q = mysqli_query($db, "select is_bidding from user_company_list WHERE email = '$email' and company_name='$company_name';");
  $mem = mysqli_query($db, "select shareHolder,member from company WHERE company_name='$company_name';");
  $r = mysqli_fetch_assoc($q);
  $mem = mysqli_fetch_assoc($mem);
  $sh = $mem['shareHolder'];
  $mmbr = $mem['member'];
  $sh = (int)$sh;
  $mmbr = (int)$mmbr;
  $is_bidding = $r['is_bidding'];
  if($is_bidding==0 && $sh==$mmbr){
  ?>
  <a href= <?php echo "sellShare.php?email='$email'&company_name='$company_name'";?>>send to bid</a>
  <p>bid start at 70% of your current investment.</p>
<?php
  }
  elseif($is_bidding==0 && $sh<$mmbr){
  ?>
  <h4>Share Holder: <?php echo $mmbr;?></h4>
<?php
  }
  else{
    $result = mysqli_query($db, "select bid_price from user_company_list where email='$email' and company_name='$company_name' and is_bidding=1");
    $result = mysqli_fetch_assoc($result);
    $bid = $result['bid_price'];
?>
    <h4><?php echo "Last Bid: ".$bid;?></h4>
    <form action="<?php echo 'myCompanies.php?cn='.$company_name."&email=".$email."&bid=".$bid;?>" method="POST">
      <button type="submit" name="sell">Sell</button>
    </form>
  
<?php
  }?>
  </div>
  <?php
  }
  ?>
</div>
</div>

<?php
include "include/footer.php";
?>