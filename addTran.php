<?php

include('funkcie.php');
echo "____ ";
echo $_POST['id'];
echo $_POST['eid'];
echo $_POST['rec'];
echo $_POST['amount'];

if(isset($_POST['action']) && !empty($_POST['action']) && isset($_SESSION['login'])) {

    addTransaction($_POST['id'], $_POST['eid'], $_POST['rec'],$_POST['amount']);
}

?>