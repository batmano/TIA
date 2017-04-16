<?php

include('funkcie.php');


if(isset($_GET['id'])) {
    deleteEmployee($_GET['id']);
    header("Refresh:1; url=updateemployees.php");
}

?>