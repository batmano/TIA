<?php

include('funkcie.php');
echo "____ ";
echo $_POST['id'] + "  ";
echo "  ";
echo $_POST['action'] + "  " ;
echo "  ";
echo $_POST['amount'];

if(isset($_POST['action']) && !empty($_POST['action']) && isset($_SESSION['login'])) {
    echo "ti";
    addMorgage($_POST['id'],$_POST['amount']);
}

?>