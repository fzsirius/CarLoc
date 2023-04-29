<?php 
require_once('include.php');

if(isset($_GET['supCar']))
{
    $supID=$_GET['supCar'];
    $reqsup="delete from voiture where ID_voiture=".$supID;
    mysqli_query($cncarloc,$reqsup);
    header('location: LesVoitures.php');
}
?>
