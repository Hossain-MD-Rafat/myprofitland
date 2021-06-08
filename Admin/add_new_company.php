<?php
  include "inc/header.php";
  include "inc/db.php";

  if(isset($_POST['add_new_company']))
  {
    $name              = mysqli_real_escape_string($db, $_POST['company_name']);
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
    $image             = $_FILES['image']['name'];
    $image_path        = $_FILES['image']['tmp_name'];
    move_uploaded_file($image_path, "image/".$image);
    $entry_fee = (float)$entry_fee;
    $query = "INSERT INTO `company`(`company_name`, `category`, `raw_material`, `product`, `measurement_unit`, `unit_price`, `entry_fee`, `image`, `member`) VALUES ('$name','$category','$raw_material','$product','$measurement_unit','$unit_price',$entry_fee,'image/$image',$member)";
    if(mysqli_query($db, $query)){
      header("Location: dashboard.php");
    }


    //echo $name." ".$category." ".$raw_material." ". $product ." ". $measurement_unit." ".
   // $unit_price." ". $entry_fee." ". $image." ".$image_path;
  }





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
              <li class="breadcrumb-item active">Add New Company</li>
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
            <form action="add_new_company.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input type="text" name="company_name" placeholder="Company Name" class="form-control">
              </div>
              <div class="form-group">
                <label>Set New Company Parameter</label>
                <select name="company_category" class="form-control">
                  <option value="Utility">Utility</option>
                  <option value="Service">Service</option>
                  <option value="Consumer">Consumer</option>
                  <option value="Gathering">Gathering</option>
                </select>
              </div>
              <div class="form-group">
                <input type="text" name="company_raw_material" placeholder="Raw Material" class="form-control">
              </div>
              <div class="form-group">
                <input type="text" name="company_product" placeholder="Product" class="form-control">
              </div>
              <div class="form-group">
                <input type="text" name="measurement_unit" placeholder="Measurement Unit" class="form-control">
              </div>
              <div class="form-group">
                <input type="text" name="unit_price" placeholder="Unit Price" class="form-control">
              </div>
              <div class="form-group">
                <input type="text" name="entry_fee" placeholder="Entry Fee" class="form-control">
              </div>
              <div class="form-group">
                <input type="text" name="member"class="form-control" placeholder="set maximum member capacity">
              </div>
              <div class="form-group">
                <input type="file" name="image"class="form-control">
              </div>
              

              <div class="form-group">
                <input type="submit" value="submit" name="add_new_company"class="btn btn-md btn-primary">
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