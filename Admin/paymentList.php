<?php
include "inc/header.php";
if(isset($_POST['complete'])){
  $i = $_GET['ID'];
  mysqli_query($db, "update withdraw set isPaid=1 where ID=$i;");
}
?>
<div class="row col-md-8 offset-md-2">
<div class="col-sm-6">
  <h3>Payment Pending List</h3>
  <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Request ID</th>
      <th scope="col">Paypal Email</th>
      <th scope="col">Amount</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $res = mysqli_query($db, "select ID, email, amount from withdraw where isPaid=0");
    while($pl=mysqli_fetch_assoc($res)){
      $ID = $pl['ID'];
      $em = $pl['email'];
      $amn = $pl['amount']
    ?>
    <tr>
      <th scope="row"><?php echo $ID; ?></th>
      <td><?php echo $em; ?></td>
      <td><?php echo $amn;?></td>
      <td>
        <form action="<?php echo 'paymentList.php?ID='.$ID?>" method="POST">
        <button type="submit" name="complete">completed</button></td>
        </form>
    </tr>
    <?php }?>
  </tbody>
</table>
<br>
<h3>Completed Payment List</h3>
  <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Request ID</th>
      <th scope="col">Paypal Email</th>
      <th scope="col">Amount</th>
      <th scope="col">status</th>
      <th scope="col"></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $cnt = 1;
    $res = mysqli_query($db, "select ID, email, amount from withdraw where isPaid=1");
    while($pl=mysqli_fetch_assoc($res)){
      $iid = $pl['ID'];
    ?>
    <tr>
      <th scope="row"><?php echo $iid;?></th>
      <td><?php echo $pl['email'];?></td>
      <td><?php echo $pl['amount'];?></td>
      <td>Completed</td>
    </tr>
    <?php }?>
  </tbody>
</table>

</div>
</div>


<?php
include "inc/footer.php";
?>