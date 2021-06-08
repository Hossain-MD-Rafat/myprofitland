<?php
include "include/header.php";
if(isset($_POST['submit'])){
  $company = $_GET['company'];
  $cmpm    = $_GET['cmpMail'];
  $bid = $_POST['bid'];
  $bid = (float)$bid;
  //echo $company.$bid.$cmpm;
  $res=mysqli_query($db,"update user_company_list set bid_price=$bid, bid_email='$email' where company_name='$company' and email='$cmpm';"); 
  if($res){
    echo "bid success";
  }
}
?>

<div class="row">
<label for="cars">Choose a catagory:</label>

<select name="cars" id="cars">
  <option value="Utility">Utility</option>
  <option value="Service">Service</option>
  <option value="Consumer">Consumer</option>
  <option value="Gathering">Gathering</option>
</select>
<div class="col-sm-6">
  <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Company name</th>
      <th scope="col">Category</th>
      <th scope="col">Raw Material</th>
      <th scope="col">Product</th>
      <th scope="col">Last Bid</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $q = mysqli_query($db, "select email,company_name,bid_price from user_company_list where is_bidding=1");
    while($row = mysqli_fetch_assoc($q)){
      $cmpName = $row['company_name'];
      $bid_price = $row['bid_price'];
      $cmpMail = $row['email'];
      $cmp = mysqli_query($db, "select * from company where company_name='$cmpName';");
      $cmp = mysqli_fetch_assoc($cmp);
    ?>
    <tr>
      <td><?php echo $cmp['company_name']; ?></td>
      <td><?php echo $cmp['category']; ?></td>
      <td><?php echo $cmp['raw_material']; ?></td>
      <td><?php echo $cmp['product'];?></td>
      <td><?php echo $bid_price; ?></td>
      <td><form action="<?php echo 'bidding.php?company='.$cmpName."&cmpMail=".$cmpMail;?>" method="POST">
        <input type="text" name="bid" placeholder="enter your bidding">
        <button type="submit" name="submit">bid</button>
        </form>
      </td>
    </tr>
   <?php
    }
    ?>
  </tbody>
</table>

</div>
</div>


<?php
include "include/footer.php";
?>