<?php
include("funkcie.php");
if (isset($_SESSION['login'])) {
  

include('hlavicka.php');
include('navigacia.php');
include('index-section.php');
include('pata.php');
include('javascript.php');
} else{
    header('Location: index.php');  
}
?>
