<?php
include("funkcie.php");
if (isset($_SESSION['login'])) {
  


include('hlavicka.php');
include('navigacia.php');
include('tran-section.php');
include('pata.php');
}else{
    header('Location: index.php');  
}
?>
