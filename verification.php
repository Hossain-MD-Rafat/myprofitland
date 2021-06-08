<?php
include 'Admin/inc/db.php';
if(isset($_GET['vCode'])){
    $code = $_GET['vCode'];
    $vCode = mysqli_query($db, "select vCode from user where vCode = '$code' and email_varification='0';");
    $vCode = mysqli_fetch_assoc($vCode);
    if($code===$vCode['vCode'])
    {
        $update = mysqli_query($db, "update user set email_varification='1' where vCode = '$code' and email_varification='0';");
        if($update){
            header("location:index.php");
        }
    }
    else{
        echo "<h3>Something went wrong</h3>";
    }
}
?>