<?php
ob_start();
include 'include/header.php';
$nm = $_GET['name'];
$tst = mysqli_query($db, "select * from user_company_list where email='$email' and company_name='$nm'");
$tst = mysqli_fetch_assoc($tst);
if (isset($_POST['confirm']) && is_null($tst)==1) {
    $eu = mysqli_query($db, "select euro from user where email='$email';");
    $companyData = mysqli_query($db, "select entry_fee, shareHolder, member from company where company_name='$nm';");
    $eu = mysqli_fetch_assoc($eu);
    $companyData = mysqli_fetch_assoc($companyData);
    $euro = $eu['euro'];
    $entry_fee = $companyData['entry_fee'];
    $sh = $companyData['shareHolder'];
    $mem = $companyData['member'];
    $euro = (float) $euro;
    $entry_fee = (float) $entry_fee;
    $sh = (int) $sh;
    $mem = (int) $mem;
    if ($euro > $entry_fee && $mem > $sh) {
        $euro -= $entry_fee;
        $sh += 1;
        $fr = mysqli_query($db, "update user set euro=$euro where email='$email'");
        if ($fr) {
            $sr = mysqli_query($db, "update company set shareHolder=$sh where company_name='$nm'");
            if ($sr) {
                $tr = mysqli_query($db, "insert into user_company_list(email,company_name) values ('$email', '$nm')");
                if ($tr) {
                    header("location: myCompanies.php");
                }
            }
        }
    }
}
elseif(isset($_POST['cancel'])){
    header("location: home.php");
}

?>
<div class="container">
    <h4>Confirm to buy new company</h>
        <div class="row">
            <form action="<?php echo 'buyCompany.php?name='.$nm; ?>" method="POST">
                <button type="submit" name="confirm">confirm</button>
                <button type="submit" name="cancel">cancel</button>
            </form>
        </div>
</div>
<?php
include 'include/footer.php';
ob_end_flush();
?>