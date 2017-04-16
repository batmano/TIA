<?php
include("funkcie.php");
if (isset($_SESSION['login'])) {
  


include('hlavicka.php');
include('navigacia.php');
include('clients_info- section.php');
include('pata.php');
}else{
    header('Location: index.php');  
}
?>
