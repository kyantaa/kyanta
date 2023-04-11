<?php
ob_start();
session_start();
define('TRUNKSJJ',true);
include_once('../includes/configurations.php');

if(isset($_POST["id"])){
    $film_id	=	intval($_POST['id']);
}


?>