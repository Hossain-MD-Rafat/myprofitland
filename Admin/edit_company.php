<?php
  //include "inc/header.php";
  include "inc/db.php";
  $name  = $_GET['name'];
  //echo $name;
  if(isset($_POST['update_company']))
  {
    $category          = mysqli_real_escape_string($db, $_POST['company_category']);
    $raw_material      = mysqli_real_escape_string($db, $_POST['company_raw_material']);
    $product           = mysqli_real_escape_string($db, $_POST['company_product']);
    $measurement_unit  = mysqli_real_escape_string($db, $_POST['measurement_unit']);
    $unit_price        = mysqli_real_escape_string($db, $_POST['unit_price']);
    $entry_fee         = mysqli_real_escape_string($db, $_POST['entry_fee']);
    $member            = mysqli_real_escape_string($db, $_POST['member']);
    $member            = (int)$member; 
    $unit_price        = (int)$unit_price;
    $entry_fee         = (int)$entry_fee;
    // $image             = $_FILES['image']['name'];
    // $image_path        = $_FILES['image']['tmp_name'];
    // move_uploaded_file($image_path, "image/".$image);
    $query = "UPDATE company SET category='$category',raw_material='$raw_material',product='$product',measurement_unit='$measurement_unit',unit_price=$unit_price,entry_fee=$entry_fee, member=$member WHERE company_name='$name'";;
    if(mysqli_query($db, $query)){
    header("Location: companyList.php");
    }
    //echo $name." ".$category." ".$raw_material." ". $product ." ". $measurement_unit." ".
   // $unit_price." ". $entry_fee." ". $image." ".$image_path;
}
    $sQuery = "select * from company where company_name='$name';";
    $res = mysqli_query($db, $sQuery);
    $res = mysqli_fetch_assoc($res);
?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Company Info</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <form action="<?php echo 'edit_company.php?name='.$name;?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                   <h5> <?php echo $res['company_name'];?> </h5>
              </div>
              <div class="form-group">
                <label>Edit Company Parameter</label>
                <select name="company_category" class="form-control">
                  <option value="Utility">Utility</option>
                  <option value="Service">Service</option>
                  <option value="Consumer">Consumer</option>
                  <option value="Gathering">Gathering</option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" name="company_raw_material" placeholder="Raw Material" class="form-control" value="<?php echo $res['raw_material'];?>">
              </div>
              <div class="form-group">
                <input type="text" name="company_product" placeholder="Product" class="form-control" value="<?php echo $res['product'];?>">
              </div>
              <div class="form-group">
                <input type="text" name="measurement_unit" placeholder="Measurement Unit" class="form-control" value="<?php echo $res['measurement_unit'];?>">
              </div>
              <div class="form-group">
                <input type="text" name="unit_price" placeholder="Unit Price" class="form-control" value="<?php echo $res['unit_price'];?>">
              </div>
              <div class="form-group">
                <input type="text" name="entry_fee" placeholder="Entry Fee" class="form-control" value="<?php echo $res['entry_fee'];?>">
              </div>
              <div class="form-group">
                <input type="text" name="member"class="form-control" placeholder="set maximum member capacity" value="<?php echo $res['member'];?>">
              </div>
              
              <div class="form-group">
                <input type="submit" value="update" name="update_company"class="btn btn-md btn-primary">
              </div>
            
            </form>
          </div>            
        </div><!-- /.row -->

    <?php 

      
    ?>

      </div><!-- /.container-fluid -->
    </div><!-- /.content -->
  </div><!-- /.content-wrapper -->
  

<?php
  include "inc/footer.php";
?>