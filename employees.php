<?php
include('funkcie.php');
if (isset($_SESSION['login'])) {
  

    $section_name = "New Employee";
    $button = "Create";

    include('hlavicka.php');
    include('navigacia.php');
    include('section_employee.php');
    include('pata.php');
} else{
    header('Location: index.php');  
}
?>
