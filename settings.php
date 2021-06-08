<?php
ob_start();
include "include/header.php";
$mes = "";
if(isset($_POST['save_changes']))
{
   $name           = $_POST['name'];
   $nationality    = $_POST['nationality'];
   $newPass        = $_POST['new_password'];
   $conPass        = $_POST['confirm_password'];
   $image          = $_FILES['image']['name'];
   $image_path     = $_FILES['image']['tmp_name'];
   move_uploaded_file($image_path, "image/".$image);
   if($newPass==$conPass){
     $newPass = md5($newPass);
      $query = "UPDATE `user` SET `user_name`='$name',`image`='image/$image',`nationality`='$nationality',`password`='$newPass' WHERE email='$email'";
    if(mysqli_query($db, $query)){
     header("location: home.php");
   }
   }
   else
   {

   }
}
?>

<div class="row">
<div class="col-sm-6">
  <h3>My Settings</h3>
    <p>Here you can change your account and profile settings. If you would like to change your email please contact support. Changing your username is not allowed.<?php echo $mes;?></p><br>
    <p><?php echo $mes;?></p><br><br>
      <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
      <h6>Personal Details</h6>
      <div class="form-cols-row">
      <input type="text" name="name"class="form-control" placeholder="update name" required="1">
      </div>
      <br>
      <div class="form-cols-row">
      <input type="text" name="nationality" class="form-control" placeholder="update nationality" required="1">
      </div>
      <br>
      <h6>Password Change</h6>
      <p>If you have no password because you used facebook login, please use the <a href="">recover password</a> function to generate a new one.</p>
      <div class="form-cols-row">
      <label for="new_password" class="form-col-sm-3 control-label">New Password</label>
      <div class="form-col-sm-5">
      <input type="password" class="form-control" name="new_password" required="1">
      </div>
      </div>
      <div class="form-cols-row">
      <label for="confirm_password" class="form-col-sm-3 control-label">Confirm Password</label>
      <div class="form-col-sm-5">
      <input type="password" class="form-control" name="confirm_password" required="1">
      </div>
      </div>
      <br>
      <h6>Profile Image</h6>
      <div class="picture">
      <div class="col-sm-6">
      <div class="form-cols-row">
         <label class="control-label">Select Profile Image</label>
            <div class="form-group">
                <input type="file" name="image"class="form-control" required="1">
           </div><br><br>
           
       </div>
      </div>
      </div>
      <button type="submit" name="save_changes" class="btn btn-primary"><i class=""></i>Save Changes</button>
      </form>
</div>
</div>

<?php
include "include/footer.php";
ob_end_flush();
?>


