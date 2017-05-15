<?php

include('funkcie.php');

include("charts4php/lib/inc/chartphp_dist.php");

if(isset($_POST['action']) && !empty($_POST['action']) && isset($_SESSION['login'])) {
    echo "asjdasdjaksjdkasdasdasd";
    create_graph();
}

?>