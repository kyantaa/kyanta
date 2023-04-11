
<?php
define('TRUNKSJJ',true);
include_once('includes/configurations.php');
if(isset($_POST['filmid'])) {
    $film_id	=	intval($_POST['filmid']);
    if(isset($_SESSION["user_id"])){
	$userid = $_SESSION['user_id'];
	
    $column = 'user_filmbox';
	$phimcheck = ','.$film_id.',';
	$check_f = $mysql->query("SELECT user_id,".$column." FROM ".DATABASE_FX."user WHERE ".$column." LIKE '%".$phimcheck."%' AND user_id = '".$userid."' ORDER BY user_id ASC");
	$fbox = $check_f->fetch(PDO::FETCH_ASSOC);
	$phimadd = $film_id.",";	
    if(!$fbox['user_id']){ 
	    echo 2;
	}else{
// ,123,123,123,
	    $delphim = $fbox[$column];
		$frep = str_replace(','.$film_id,'',$delphim);
		$mysql->query("UPDATE ".DATABASE_FX."user SET ".$column." = '".$frep."' WHERE user_id = '".$userid."'");
	       echo 1;
	}	  
	      
	}else{
	echo 3;
	}
	
	exit();
}