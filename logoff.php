<?php

include('funkcie.php');
echo 'tuitut';
if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    if ($action == 'logoff') {
            session_unset();
            session_destroy(); 
       
            
    }

}

?>