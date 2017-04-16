<?php

include('funkcie.php');

if(isset($_POST['action']) && !empty($_POST['action']) && isset($_SESSION['login'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'Create' : insertclient($_POST['fn'], $_POST['ln'],$_SESSION['login']);break;
        case 'Save' : updateclient($_POST['id'],$_POST['fn'],$_POST['ln'] );break;
    }
}

?>