<?php
include('funkcie.php');
if (isset($_SESSION['login'])) {
  

    $section_name = "New Client";
    $button = "Create";

    include('hlavicka.php');
    include('navigacia.php');
    include('section.php');
    include('pata.php');
} else{
    header('Location: index.php');  
}
?>
