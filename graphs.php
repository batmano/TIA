<?php
include("funkcie.php");
include("charts4php/lib/inc/chartphp_dist.php");


if (isset($_SESSION['login'])) {
  


include('hlavicka.php');
include('navigacia.php');
include('graphs-section.php');
include('pata.php');
}else{
    header('Location: index.php');  
}
?>






