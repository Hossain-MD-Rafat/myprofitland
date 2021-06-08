<?php
include "inc/header.php";
$cnt = 1;
?>
<div class="row col-md-10 offset-md-2">
<div class="col-md-12">
  <h3>Company List</h3>
  <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Count</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Raw material</th>
      <th scope="col">Product</th>
      <th scope="col">Measurement unit</th>
      <th scope="col">Unit Price</th>
      <th scope="col">Entry fee</th>
      <th scope="col">Image</th>
      <th scope="col">Share Holders</th>
      <th scope="col">Maximum Member</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $res = mysqli_query($db, "select * from company");
    while($cmp=mysqli_fetch_assoc($res)){
    ?>
    <tr>
      <th scope="row"><?php echo $cnt; $cnt++?></th>
      <th scope="col"><?php $name = $cmp['company_name']; echo $name;?></th>
      <th scope="col"><?php echo $cmp['category'];?></th>
      <th scope="col"><?php echo $cmp['raw_material'];?></th>
      <th scope="col"><?php echo $cmp['product'];?></th>
      <th scope="col"><?php echo $cmp['measurement_unit'];?></th>
      <th scope="col"><?php echo $cmp['unit_price'];?></th>
      <th scope="col"><?php echo $cmp['entry_fee'];?></th>
      <th scope="col"><img style="width:40px; height:30px;" src="<?php echo $cmp['image'];?>" alt=""></th>
      <th scope="col"><?php echo $cmp['shareHolder'];?></th>
      <th scope="col"><?php echo $cmp['member'];?></th>
      <th><a href="<?php echo 'edit_company.php?name='.$name; ?>">Edit</a></th>
    </tr>
    <?php }?>
  </tbody>
</table>
</div>
</div>


<?php
include "inc/footer.php";
?>