<?php
include "include/header.php";
?>
<!-- <script>
  var str = "Utility"
  function showCompany(str){
    console.log(str);
    var xhttp = new XMLHttpRequest();
    xhttp.onreaadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById("companyData").innerHTML =
            this.responseText;
       }
    }
    xhttp.open("GET", "companyData.php?category="+str, true);
    xhttp.send();
  }
</script> -->
<div class="container">
<div class="row">
<div class="col-md-12">
  <h3>All Company List</h3>
<!-- <label for="cars">Choose a catagory:</label>
<select name="cars" id="cars" onchange="showCompany(this.value)">
  <option value="Utility">Utility</option>
  <option value="Service">Service</option>
  <option value="Consumer">Consumer</option>
  <option value="Gathering">Gathering</option>
</select> -->
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Name</th>
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
    //$companies = mysqli_query($db, "select company_name from company where member>shareHolder;");
    $companyList = mysqli_query($db, "SELECT * from company;");
    while($cmp = mysqli_fetch_assoc($companyList)){
      //$company_name = $rw['company_name'];
      //$cmpDetails = mysqli_query($db, "select * from company where company_name!='$company_name';");
      //$cmp = mysqli_fetch_assoc($cmpDetails);
    ?>
    <tr>
      <th scope="col"><?php $name = $cmp['company_name']; echo $name;?></th>
      <th scope="col"><?php echo $cmp['raw_material'];?></th>
      <th scope="col"><?php echo $cmp['product'];?></th>
      <th scope="col"><?php echo $cmp['measurement_unit'];?></th>
      <th scope="col"><?php echo $cmp['unit_price'];?></th>
      <th scope="col"><?php echo $cmp['entry_fee'];?></th>
      <th scope="col"><img style="width:40px; height:30px;" src="<?php echo $cmp['image'];?>" alt=""></th>
      <th scope="col"><?php echo $cmp['shareHolder'];?></th>
      <th scope="col"><?php echo $cmp['member'];?></th>
      <th><a href=<?php echo "./buyCompany.php?name=".$name ;?>>buy company</a></th>
    </tr>
   <?php
    }
    ?>
  </tbody>
</table>
</div>
</div>
</div>

<?php
include "include/footer.php";
?>