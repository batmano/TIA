<?php

include('funkcie.php');
/*echo "____ ";
echo $_POST['eid'];
echo $_POST['fn'];
echo $_POST['ln'];
echo $_POST['branch'];
echo $_POST['pos'];*/

if(isset($_POST['action']) && !empty($_POST['action']) && isset($_SESSION['login'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'Create' : insertEmployee($_POST['fn'], $_POST['ln'],$_POST['pos'],$_POST['branch'] );break;
        case 'Save' : updateEmployee($_POST['eid'], $_POST['fn'], $_POST['ln'],$_POST['pos'],$_POST['branch'] );break;
    }
}

?>