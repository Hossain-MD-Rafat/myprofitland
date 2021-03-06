<!DOCTYPE html>
<html lang="en">

<?php
  include "inc/header.php"; 
      // Turn off error reporting
      error_reporting(0);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage All Category</li>
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
          <div class="col-lg-6">
            <!--Add New Category Start-->
                         <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Category</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="display: block;">
                <form action="" method="POST">
                  <div class="from-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" class="form-control" required="required" autocomplete="off">
                  </div>

                  <div class="from-group">
                    <label for="description">Category Description</label>
                     <textarea class="form-control" name="description" rows="5"></textarea>
                  </div>

                  <div class="from-group">
                    <input type="submit" name="add_cat" value="Add New" class="btn btn-primary btn-flat btn-sm">
                  </div>              
                </form>
                <?php
                 //Adding New Category
                  if(isset($_POST['add_cat'])){

                    $name=                 $_POST['name'];
                    $description=          $_POST['description'];

                    $query="INSERT INTO category (name,description) VALUES ('$name','$description')";

                    $add_cat=mysqli_query($db, $query);
                    if($add_cat){
                      header("Location: category.php");
                    }
                    else{
                      die("Mysqli Query Failed -".mysqli_error($db));
                    }
                  }
                ?>
              </div>
              <!-- /.card-body -->
            </div>

            <!--Add New Category End-->


            <!--EDIT Category Start-->
            <?php
              if(isset($_GET['edit'])){
                 $edit_id = $_GET['edit'];
                 $query="SELECT * FROM category WHERE id='$edit_id'";
                 $selected_id= mysqli_query($db, $query);
                   while($row=mysqli_fetch_assoc($selected_id)){
                      $editId=             $row['id'];
                      $editName =          $row['name'];
                      $editDescription=    $row['description'];
                 } 
              }?>
                 <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">EDIT Category</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body" style="display: block;">
                    <form action="" method="POST">
                      <div class="from-group">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" class="form-control" required="required" autocomplete="off" value="<?php echo $editName; ?>">
                      </div>

                      <div class="from-group">
                        <label for="description">Category Description</label>
                         <textarea class="form-control" name="description" rows="5"> <?php echo $editDescription; ?></textarea>
                      </div>

                      <div class="from-group">
                        <input type="submit" name="update_cat" value="Update Category" class="btn btn-primary btn-flat btn-sm">
                      </div>              
                    </form>
                    
                  </div>
                  <!-- /.card-body -->
                </div><?php 
                ?>
           
            <!--EDIT Category End-->

            <!--Update Category Start-->
            <?php
            if(isset($_POST['update_cat'])){

                    $name=                 $_POST['name'];
                    $description=          $_POST['description'];

                    $query="UPDATE category SET name='$name', description='$description' WHERE id='$edit_id'";

                    $update_cat=mysqli_query($db, $query);
                    if($update_cat){
                      header("Location: category.php");
                    }
                    else{
                      die("Mysqli Query Failed -".mysqli_error($db));
                    }
                  }
                ?>
             
             <!--Update Category End-->   

          </div>

          <div class="col-lg-6">
             <!--All Category List Start  -->
             <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">All Category</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="display: block;">
                <!--Table Start-->
                <table class="table table-striped table-dark">
                  <thead>
                    <tr>
                      <th scope="col">SL</th>
                      <th scope="col">Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $query="SELECT * FROM category";
                      $all_Connect=mysqli_query($db, $query);
                      $count=0;

                      while($row=mysqli_fetch_assoc($all_Connect)){
                        $Id            =$row['id'];
                        $Name          =$row['name'];
                        $Description   =$row['description'];
                            $count++;
                      ?>

                        <tr>
                      <th scope="row"><?php echo $count; ?></th>
                      <td><?php echo $Name; ?></td>
                      <td><?php echo $Description; ?></td>  
                      <td>
                        <div class="action-perform">
                          <ul>
                            <li><a href="category.php?edit=<?php echo $Id;?>"><i class="fa fa-edit"></i></a></li>
                            <li><a href="" data-toggle="modal" data-target="#delete<?php echo $id ?>"><i class="fa fa-trash"></i></a></li>
                          </ul>
                        </div>
                      </td>                  
                    </tr>
                     <!-- Category Delete Modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="delete<?php echo $cat_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you confirm to delete?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body text-center">
                                <div class="delete-option">
                                  <ul>
                                    <li><a href="category.php?delete=<?php echo $cat_id; ?>" class="btn btn-success btn-lg btn-flat">Yes</a></li>
                                    <li><button type="button" class="btn btn-danger btn-lg btn-flat" data-dismiss="modal">No</button></li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php }
                    ?>
                  
                   
                  </tbody>
                </table>
                <!--Table End-->
              </div>
              <!-- /.card-body -->
            </div>
             <!--All Category List End -->   
          </div>

            <!--Delete Category -->
                        <?php

                    if ( isset($_GET['delete']) ){
                      $delete_cat = $_GET['delete'];
                      $query = "DELETE FROM category WHERE id = '$delete_cat'";
                      $delete_cat = mysqli_query($db, $query);
                      if ( $delete_cat ){
                        header("Location: category.php");
                      }
                      else{
                        die("Mysqli Query Failed - ". mysqli_error($db));
                      }
                    }

                  ?> 

        </div><!-- /.row -->

      </div><!-- /.container-fluid -->

    </div><!-- /.content -->

  </div><!-- /.content-wrapper -->

<?php
  include "inc/footer.php"; 
?>  


